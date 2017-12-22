layui.use(['table','element','form','jquery'], function(){
    var table = layui.table
        ,form = layui.form
        ,$ = layui.jquery;
    //第一个实例
    table.render({
        elem: '#roles_table'
        ,url: '/admin/api/roles' //数据接口
        ,limit: 5
        ,page: true //开启分页
        ,cols: [[ //表头
            {fixed: 'left',checkbox : true}
            ,{field: 'id', title: 'ID', width:50, align:'center',sort: true}
            ,{field: 'name', title: '角色名称', align:'center',width:150}
            ,{field: 'permission', title: '权限名称', align:'center'}
            ,{title: '操作', width:150, align:'center', toolbar: '#roles_tools'} //这里的toolbar值是模板元素的选择器
        ]]
    });
    //监听工具条
    table.on('tool(roles_table)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的DOM对象

        if (layEvent === 'del') { //删除
            console.log('detail');
            console.log(obj);
            layer.confirm('真的删除行么', function (index) {

                layer.close(index);
                //向服务端发送删除指令
                $.ajax({
                    type: 'DELETE',
                    dataType: 'json',
                    url: '/admin/roles/'+obj.data.id,
                    success: function(data) {
                        if(data.code==1){
                            layer.alert(data.msg,{icon: 1});
                            obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        }else{
                            layer.alert(data.msg,{icon: 2});
                        }
                    },
                    error : function (msg) {
                        console.log('error');
                        var json=JSON.parse(msg.responseText);
                        $.each(json.errors,function(index,error){
                            $.each(error,function(key,value){
                                layer.alert(value,{icon: 2});
                            });
                        });
                    }
                });
            });
        } else if (layEvent === 'edit') { //编辑
            //do something
            console.log(obj);
            location.href= '/admin/roles/'+obj.data.id+'/edit';

            // //同步更新缓存对应的值
            // obj.update({
            //     username: '123'
            //     , title: 'xxx'
            // });
        }
    });

    //自定义验证规则
    form.verify({
        name: function(value, item){ //value：表单的值、item：表单的DOM对象
            if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                return '用户名不能有特殊字符';
            }
            if(/(^\_)|(\__)|(\_+$)/.test(value)){
                return '用户名首尾不能出现下划线\'_\'';
            }
            if(/^\d+\d+\d$/.test(value)){
                return '用户名不能全为数字';
            }
        },
    });
    //监听提交
    form.on('submit(role)', function(data)  {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: data.form.action,
            data: data.field,
            success: function(data) {
                if(data.code==1){
                    layer.alert(data.msg,{icon: 1});
                    location.href = '/admin/roles';
                }else{
                    layer.alert(data.msg,{icon: 2});
                }
            },
            error : function (msg) {
                console.log('error');
                var json=JSON.parse(msg.responseText);
                $.each(json.errors,function(index,error){
                    $.each(error,function(key,value){
                        layer.alert(value,{icon: 2});
                    });
                });
            }
        });
        return false;
    });
});