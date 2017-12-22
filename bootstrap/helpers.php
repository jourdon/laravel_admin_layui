<?php

function getRoleOrPermissionApi($request,$model)
{
    $page=$request->page?:1;
    $limit=$request->limit?:config('config.limit');
    $data=$model->skip($limit*($page-1))->take($limit)->get();
    if($model->getTable()=='roles'){
        $multiplied = $data->map(function ($item, $key) {
            $item->permission = $item->permissions()->pluck('name')->implode('|');
            return $item;
        });
    }else{
        $multiplied = $data->map(function ($item, $key) {
            $item->roles = $item->roles()->pluck('name')->implode('|');
            return $item;
        });
    }
    return $multiplied;
}