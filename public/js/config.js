var element;
var $;
layui.use(['element','jquery','form', 'layedit'],function(){
    element = layui.element;
    $ = layui.jquery;
    var form = layui.form
        ,layer = layui.layer
        ,layedit = layui.layedit;


    //自定义验证规则
    form.verify({
        title: function(value){
            if(value.length < 5){
                return '标题至少得5个字符啊';
            }
        }
        ,pass: [/(.+){6,12}$/, '密码必须6到12位']
        ,content: function(value){
            layedit.sync(editIndex);
        }
    });

    //监听指定开关
    form.on('switch(switchTest)', function(data){
        if(this.checked){
            url='/admin/up';
        }else{
            url='/admin/down';
        }
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: url,
            success: function(data) {
                layer.alert(data.msg,{icon: 1});
            },
            error: function(data) {
                layer.msg('异常错误', {icon: 2});
            }
        });
        layer.tips('温馨提示：请注意开关状态代表网站前台的状态，后台不受影响', data.othis)
    });

    //监听提交
    form.on('submit(config)', function(data){
        data.field.status=data.field.status ? '1': '0';//开关是否开启，true或者false

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: data.form.action,
            data: data.field,
            success: function(data) {
                if(data.code==1){
                    layer.alert(data.msg,{icon: 1});
                }else{
                    layer.alert(data.msg,{icon: 2});
                }
            },
            error : function (msg) {
                var json=JSON.parse(msg.responseText);
                $.each(json.errors,function(index,error){
                    $.each(error,function(key,value){
                        layer.alert(value,{icon: 2});
                    });
                });
            },
        });
        return false;
    });

});