
@extends('admin.layouts.app')
@section('title',isset($permissions->id)? '编辑权限':'添加权限')

@section('body')
    <blockquote class="layui-elem-quote layui-text">
        {{isset($permissions->id)? '编辑权限':'添加权限'}}
        <a href="{{ route('permissions.index') }}"class="layui-btn" style="margin-left: 30px;">返回列表</a>
    </blockquote>
    @if(isset($permissions->id))
        <form class="layui-form" action="{{ route('permissions.update', $permissions->id) }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            @else
                <form class="layui-form" action="{{ route('permissions.store') }}" method="POST">
                    @endif
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">权限名称</label>
            <div class="layui-input-inline">
                <input type="text" name="name" lay-verify="required|name" autocomplete="off" placeholder="请输入用户名称" class="layui-input" value="{{ old('name', $permissions->name ) }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">角色名称</label>
            <div class="layui-input-block">
                @foreach($roles as $role)
                <input type="checkbox" name="roles[]" value="{{ $role }}" title="{{ $role }}" {{ (isset($permissions->role) && in_array($role,$permissions->role))?'checked':'' }} lay-skin="primary">
                    @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="permission">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('/js/permissions.js?v=1.7') }}"></script>
@endsection


