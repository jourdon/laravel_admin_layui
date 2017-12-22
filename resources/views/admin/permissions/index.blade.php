@extends('admin.layouts.app')
@section('title','权限列表')

@section('body')
    <blockquote class="layui-elem-quote layui-text">
        权限列表
        <a href="{{ route('permissions.create') }}"class="layui-btn" style="margin-left: 30px;">添加</a>
    </blockquote>
    <table id="permissions_table" lay-filter="permissions_table"></table>
    <script type="text/html" id="permissions_tools">
        <button class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>  编辑</button>
    </script>
@endsection
@section('scripts')
    <script src="{{ asset('/js/permissions.js?v=1.5') }}"></script>
@endsection

