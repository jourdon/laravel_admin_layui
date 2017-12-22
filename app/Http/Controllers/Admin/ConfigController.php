<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Exception;

class ConfigController extends Controller
{
    public function create()
    {
        $config=Config::find(1)->toArray();
        return view('admin.config.index',compact('config'));
    }

    public function store(Request $request)
    {
        //try{
            $config=Config::find(1);
            $this->validate($request,[
                'name'=>'required|max:10',
                'email'=>'email',
                'status'=>'required'
            ]);
            if($config->update($request->except('_token'))){
                return ['code'=>1,'msg'=>'站点资料更新成功'];
            }else{
                return ['code'=>0,'msg'=>'站点资料更新失败'];
            }
        //}catch (Exception $exception){
        //    return ['code'=>0,'msg'=>$exception->getMessage()];
        //}
    }

    public function  down(){
        @touch(storage_path().'/framework/down');
        Config::find(1)->update(['status'=>0]);
        return ['code'=>1,'msg'=>'网站处于维护模式'];
    }
    public function  up()
    {
        unlink(storage_path().'/framework/down');
        Config::find(1)->update(['status'=>1]);
        return ['code'=>1,'msg'=>'网站处于正常访问模式'];

    }
}
