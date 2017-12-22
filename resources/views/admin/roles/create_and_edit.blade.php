
@extends('admin.layouts.app')
@section('title',isset($roles->id)? '编辑角色':'添加角色')

@section('body')
    <blockquote class="layui-elem-quote layui-text">
        {{isset($roles->id)? '编辑角色':'添加角色'}}
        <a href="{{ route('roles.index') }}"class="layui-btn" style="margin-left: 30px;">返回列表</a>
    </blockquote>
    @if(isset($roles->id))
        <form class="layui-form" action="{{ route('roles.update', $roles->id) }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            @else
                <form class="layui-form" action="{{ route('roles.store') }}" method="POST">
                    @endif
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">角色名称</label>
            <div class="layui-input-inline">
                <input type="text" name="name" lay-verify="required|name" autocomplete="off" placeholder="请输入用户名称" class="layui-input" value="{{ old('name', $roles->name ) }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">权限名称</label>
            <div class="layui-input-block">
                @foreach($permissions as $permission)
                <input type="checkbox" name="permission[]" value="{{ $permission }}" title="{{ $permission }}" {{ (isset($roles->permission) && in_array($permission,$roles->permission))?'checked':'' }} lay-skin="primary">
                    @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="role">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('/js/roles.js') }}"></script>
@endsection


