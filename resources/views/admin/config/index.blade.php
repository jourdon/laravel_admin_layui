
@extends('admin.layouts.app')
@section('title','网站配置')

@section('body')
    <blockquote class="layui-elem-quote layui-text">
        网站配置
    </blockquote>

    <form class="layui-form" action="{{ route('config.store') }}">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">网站名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入网站名称" class="layui-input" value="{{ $config['name'] }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">网站关键词</label>
            <div class="layui-input-block">
                <input type="text" name="keywords"  placeholder="请输入网站关键词，以逗号隔开" autocomplete="off" class="layui-input" value="{{ $config['keywords'] }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">网站描述</label>
            <div class="layui-input-block">
                <input type="text" name="description"  placeholder="请输入网站描述" autocomplete="off" class="layui-input" value="{{ $config['description'] }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">网站域名</label>
            <div class="layui-input-inline">
                <input type="tel" name="url" lay-verify="url" autocomplete="off" class="layui-input" value="{{ $config['url'] }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">站长邮箱</label>
            <div class="layui-input-inline">
                <input type="text" name="email"  autocomplete="off" class="layui-input" value="{{ $config['email'] }}">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">网站状态</label>
            <div class="layui-input-block">
                <input type="checkbox" {{ $config['status']? 'checked': '' }} name="status" lay-skin="switch" lay-filter="switchTest" lay-text="正常|维护" value={{ $config['status'] }}>
            </div>
            <div class="layui-form-mid layui-word-aux">默认为开启</div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">站点统计代码</label>
            <div class="layui-input-block">
                <textarea name="statistics" placeholder="直接粘贴代码即可" class="layui-textarea">{{ $config['statistics'] }}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="config">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('/js/config.js') }}"></script>
@endsection


