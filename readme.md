### Laravel admin 后台权限管理系统 

基于 `Laravel 5.5` 的后端框架和 `layui 2.2.45` 的前端框架制作的一个后台管理系统，目前只做了权限管理和网站配置，可以在此基础上进行开发。

大楖上几张图吧

![laravel-admin](https://github.com/jourdon/laravel_admin_layui/blob/master/1.png)
![laravel-admin](https://github.com/jourdon/laravel_admin_layui/blob/master/2.png)
![laravel-admin](https://github.com/jourdon/laravel_admin_layui/blob/master/3.png)

### 安装方法
克隆github
```
git@github.com:jourdon/laravel_admin_layui.git
```
生成配置文件
``` 
cp .env.example .env
```
更新 `composer` 扩展包
```
composer update
```
迁移数据库
``` 
php artisan migrate:refresh --seed
```
默认会生成一些假数据，方便调试
首页使用 `Laravel` 的默认模板，登录后可通后 `admin` 目录登录后台
或者通后下图登录后台
![laravel-admin](https://github.com/jourdon/laravel_admin_layui/blob/master/4.png)
管理员邮箱：`admin@admin.com` 
密码：`password`
