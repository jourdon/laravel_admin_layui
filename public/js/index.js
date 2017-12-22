var element;
var $;
layui.use(['element','jquery','form', 'layedit'],function(){
    element = layui.element;
    $ = layui.jquery;
    var form = layui.form
        ,layer = layui.layer
        ,layedit = layui.layedit;


    // //自定义验证规则
    // form.verify({
    //     title: function(value){
    //         if(value.length < 5){
    //             return '标题至少得5个字符啊';
    //         }
    //     }
    //     ,pass: [/(.+){6,12}$/, '密码必须6到12位']
    //     ,content: function(value){
    //         layedit.sync(editIndex);
    //     }
    // });
    //
    // //监听指定开关
    // form.on('switch(switchTest)', function(data){
    //     if(this.checked){
    //         url='/admin/up';
    //     }else{
    //         url='/admin/down';
    //     }
    //     $.ajax({
    //         type: 'get',
    //         dataType: 'json',
    //         url: url,
    //         success: function(data) {
    //             layer.alert(data.msg,{icon: 1});
    //         },
    //         error: function(data) {
    //             layer.msg('异常错误', {icon: 2});
    //         }
    //     });
    //     layer.tips('温馨提示：请注意开关状态代表网站前台的状态，后台不受影响', data.othis)
    // });
    //
    // //监听提交
    // form.on('submit(config)', function(data){
    //     data.field.status=data.field.status ? '1': '0';//开关是否开启，true或者false
    //
    //     $.ajax({
    //         type: 'post',
    //         dataType: 'json',
    //         url: data.form.action,
    //         data: data.field,
    //         success: function(data) {
    //             if(data.code==1){
    //                 layer.alert(data.msg,{icon: 1});
    //             }else{
    //                 layer.alert(data.msg,{icon: 2});
    //
    //             }
    //         },
    //         error : function (msg) {
    //             var json=JSON.parse(msg.responseText);
    //             $.each(json.errors,function(index,error){
    //                 $.each(error,function(key,value){
    //                     layer.alert(value,{icon: 2});
    //                 });
    //             });
    //         },
    //     });
    //     return false;
    // });

    //左侧导航根据一级菜单关闭其它一级菜单
    $('ul.layui-nav li').click(function() {
        $('ul.layui-nav li').removeClass('layui-nav-itemed');
        $(this).addClass('layui-nav-itemed');
    });

    //监听左侧菜单点击
    element.on('nav(left-menu)', function(elem){
        addTab(elem[0].innerText,elem[0].attributes[1].nodeValue,elem[0].id);
    });
    //监听tab选项卡切换
    element.on('tab(tab-switch)', function(data){
        if(data.elem.context.attributes != undefined){
            var id = data.elem.context.attributes[0].nodeValue;
            layui.each($(".layui-nav-child"), function () {
                $(this).find("dd").removeClass("layui-this");
            });
            $("#"+id).attr("class","layui-this");
        }
    });
});

/**
 * 新增tab选项卡，如果已经存在则打开已经存在的，不存在则新增
 * @param tabTitle 选项卡标题名称
 * @param tabUrl 选项卡链接的页面URL
 * @param tabId 选项卡id
 */
function addTab(tabTitle,tabUrl,tabId){
    if ($(".layui-tab-title li[lay-id=" + tabId + "]").length > 0) {
        element.tabChange('tab-switch', tabId);
    }else{
        element.tabAdd('tab-switch', {
            title: tabTitle
            ,content: '<iframe src='+tabUrl+' width="100%" style="min-height: 500px;" frameborder="0" scrolling="auto" onload="setIframeHeight(this)"></iframe>' // 选项卡内容，支持传入html
            ,id: tabId //选项卡标题的lay-id属性值
        });
        element.tabChange('tab-switch', tabId); //切换到新增的tab上
    }
}

/**
 * ifrme自适应页面高度，需要设定min-height
 * @param iframe
 */
function setIframeHeight(iframe) {
    if (iframe) {
        var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
        if (iframeWin.document.body) {
            iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
        }
    }
};