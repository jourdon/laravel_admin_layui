<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        return view('admin.roles.index');
    }

    public function roles(Role $roles,Request $request)
    {
        $count=$roles->count();
        $data=getRoleOrPermissionApi($request,$roles);

        return [
            'code'  =>  0,
            'msg'   =>  '',
            'count' =>  $count,
            'data'  =>$data,
        ];
    }

    public function create(Role $roles)
    {
        $permissions=Permission::all()->pluck('name')->toArray();
        return view('admin.roles.create_and_edit',compact('roles','permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required|unique:roles,name',
        ]);
        $role = Role::create(['name' => $request->name]);
        if($request->permission){
            $role->givePermissionTo($request->permission);
        }
        return ['code'=>1,'msg'=>'修改成功'];
    }

    public function edit($id)
    {
        $roles=Role::find($id);
        $roles->permission=$roles->permissions()->pluck('name')->toArray();
        $permissions=Permission::all()->pluck('name')->toArray();
        return view('admin.roles.create_and_edit',compact('roles','permissions'));
    }

    public function update(Request $request,$id)
    {
        $data=array_filter($request->all());
        $this->validate($request,[
            'name'  => 'required|min:3|max:15',
        ]);
        $role=Role::find($id);
        $role->update(['name'=>$data['name']]);


        $permissions=$role->permissions()->pluck('name')->toArray();

        if($permissions){
            foreach($permissions as $item){
                $role->revokePermissionTo($item);
            }
        }
        if(isset($data['permission'])){
            $role->givePermissionTo($data['permission']);
        }
        return ['code'=>1,'msg'=>'修改成功'];
    }
    public function destroy($id)
    {
        $roles=Role::find($id);
        $permissions=$roles->permissions()->pluck('name')->toArray();
        foreach($permissions as $item){
            $roles->revokePermissionTo($item);
        }
        $roles->delete();
        return ['code'=>1,'msg'=>'删除成功'];
    }
}
