@extends('admin.layouts.app')
@section('title','J-Admin')
@section('styles')
    <style>
        .layui-tab-title li:first-child > i {
            display: none;
        }
    </style>
@endsection
@section('body')
    <div class="layui-header">
        <div class="layui-logo">J-Admin</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        @include('admin.layouts._header')
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  lay-filter="left-menu">
                @include('admin.layouts._sidebar')
            </ul>
        </div>
    </div>

    <div class="layui-body">
        <div class="layui-tab" lay-allowClose="true" lay-filter="tab-switch">
            <ul class="layui-tab-title">
                <li class="layui-this" >后台首页</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">

                    <blockquote class="layui-elem-quote layui-text">
                        服务器环境
                    </blockquote>

                    @foreach($envs as $env)
                    <div class="layui-form-item">
                        <label class="layui-form-label">{{$env['name']}}</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" required  lay-verify="required"  class="layui-input" value="{{$env['value']}}">
                        </div>
                    </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        @include('admin.layouts._footer')
    </div>
    @endsection

@section('scripts')
    <script src="{{ asset('/js/index.js') }}"></script>
@endsection