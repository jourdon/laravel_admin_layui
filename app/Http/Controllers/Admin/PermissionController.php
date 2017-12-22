<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    public function index()
    {
        return view('admin.permissions.index');
    }
    public function permissions(Permission $permissions,Request $request)
    {

        $count=$permissions->count();
        $data=getRoleOrPermissionApi($request,$permissions);

        return [
            'code'  =>  0,
            'msg'   =>  '',
            'count' =>  $count,
            'data'  =>$data,
        ];
    }

    public function create(Permission $permissions)
    {
        $roles=Role::all()->pluck('name')->toArray();
        return view('admin.permissions.create_and_edit',compact('roles','permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required|unique:permissions,name',
        ]);
        $permission = Permission::create(['name' => $request->name]);

        if($request->roles){
            foreach($request->roles as $role){
                $role->givePermissionTo($permission);
            }
        }
        return ['code'=>1,'msg'=>'添加成功'];
    }

    public function edit($id)
    {
        $permissions=Permission::find($id);
        $permissions->role=$permissions->roles()->pluck('name')->toArray();
        $roles=Role::all()->pluck('name')->toArray();

        return view('admin.permissions.create_and_edit',compact('roles','permissions'));
    }

    public function update(Request $request,$id)
    {
        $data=array_filter($request->all());
        $this->validate($request,[
            'name'  => 'required|min:3|max:15',
        ]);
        $model=Permission::find($id);
        $permission=$model->name;
        $model->update(['name'=>$data['name']]);
        $roles=$model->roles()->get();
        if($roles){
            foreach($roles as $item){
                $item->revokePermissionTo($permission);
            }
        }
        if(isset($data['roles'])){
            foreach($data['roles'] as $item){
                $role=Role::findByName($item);
                //dd($data,$role);
                $role->givePermissionTo($permission);
            }
        }
        return ['code'=>1,'msg'=>'修改成功'];
    }
}
