<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title','Laravel-admin')</title>
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}">
    @yield('styles')
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <!-- 内容主体区域 -->
    @yield('body')

</div>
<script src="{{ asset('/layui/layui.js') }}"></script>
@yield('scripts')
</body>
</html>
