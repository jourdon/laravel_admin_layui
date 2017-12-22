<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function index()
    {
        return view('admin.users.index');
    }

    public function users(User $users,Request $request)
    {
        $count=$users->count();
        $data=getRoleOrPermissionApi($request,$users);

        //$data=$user->skip($limit*($page-1))->take($limit)->get()->toArray();

        return [
            'code'  =>  0,
            'msg'   =>  '',
            'count' =>  $count,
            'data'  =>$data,
            ];
    }

    public function create(User $user)
    {
        $roles=Role::all()->pluck('name')->toArray();
        return view('admin.users.create_and_edit',compact('user','roles'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'  => 'required|min:3|max:15',
            'email' =>  'required|email|unique:users,email',
            'password'  =>  'required|min:6|max:20|confirmed'
        ]);
        $user=User::create([
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password'  =>  bcrypt($request->password),
        ]);
        if($request->role){
            $user->assignRole($request->role);
        }
        return ['code'=>1,'msg'=>'添加成功'];
    }

    public function edit(User $user)
    {
        $roles=Role::all()->pluck('name')->toArray();
        $role=$user->roles()->pluck('name')->first();
        return view('admin.users.create_and_edit',compact('user','roles','role'));
    }

    public function update(Request $request, User $user)
    {
        $data=array_filter($request->all());
        $this->validate($request,[
            'name'  => 'required|min:3|max:15',
            'email' =>  'required|email|unique:users,email,'.$user->id,
            'password'  =>  'required|min:6|confirmed'
        ]);
        $user->update($data);

        $role=$user->roles()->pluck('name')->first();
        if($role){
            $user->removeRole($role);
        }
        if($request->role){
            $user->assignRole($request->role);
        }
        return ['code'=>1,'msg'=>'修改成功'];
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return ['code'=>1,'msg'=>'删除成功'];
    }
}
