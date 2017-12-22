@extends('admin.layouts.app')
@section('title','角色列表')

@section('body')
    <blockquote class="layui-elem-quote layui-text">
        角色列表
        <a href="{{ route('roles.create') }}"class="layui-btn" style="margin-left: 30px;">添加</a>
    </blockquote>
    <table id="roles_table" lay-filter="roles_table"></table>
    <script type="text/html" id="roles_tools">
        <button class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>  编辑</button>
        <button class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon">&#xe640;</i>删除</button>
    </script>
@endsection
@section('scripts')
    <script src="{{ asset('/js/roles.js') }}"></script>
@endsection

