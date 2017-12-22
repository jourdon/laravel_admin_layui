layui.use(['table','element','form','jquery'], function(){
    var table = layui.table
        ,form = layui.form
        ,$ = layui.jquery;
    //第一个实例
    table.render({
        elem: '#permissions_table'
        ,url: '/admin/api/permissions' //数据接口
        ,limit: 5
        ,page: true //开启分页
        ,cols: [[ //表头
            {fixed: 'left',checkbox : true}
            ,{field: 'id', title: 'ID', width:50, align:'center',sort: true}
            ,{field: 'name', title: '权限名称', align:'center',width:150}
            ,{field: 'roles', title: '角色名称', align:'center'}
            ,{title: '操作', width:150, align:'center', toolbar: '#permissions_tools'} //这里的toolbar值是模板元素的选择器
        ]]
    });
    //监听工具条
    table.on('tool(permissions_table)', function (obj) { //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
        var data = obj.data; //获得当前行数据
        var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
        var tr = obj.tr; //获得当前行 tr 的DOM对象

        if (layEvent === 'edit') { //编辑
            //do something
            console.log(obj);
            location.href= '/admin/permissions/'+obj.data.id+'/edit';
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
    form.on('submit(permission)', function(data)  {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: data.form.action,
            data: data.field,
            success: function(data) {
                if(data.code==1){
                    layer.alert(data.msg,{icon: 1});
                    location.href = '/admin/permissions';
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