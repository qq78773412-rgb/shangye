<?php /*a:3:{s:59:"/www/wwwroot/guang.ailiutang.cn/app/view/shd_set/index.html";i:1762426633;s:56:"/www/wwwroot/guang.ailiutang.cn/app/view/public/css.html";i:1762426633;s:55:"/www/wwwroot/guang.ailiutang.cn/app/view/public/js.html";i:1762426633;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>送货单设置</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" type="text/css" href="/static/admin/layui/css/layui.css?v=20200519" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/layui/css/modules/formSelects-v4.css?v=20200516" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/css/admin.css?v=202406" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/css/font-awesome.min.css?v=20200516" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/webuploader/webuploader.css?v=<?php echo time(); ?>" media="all">
<link rel="stylesheet" type="text/css" href="/static/admin/css/designer.css?v=202410" media="all">
<link rel="stylesheet" type="text/css" href="/static/fonts/iconfont.css?v=20201218" media="all">
</head>
<body>
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-card layui-col-md12">
        <div class="layui-card-header"><i class="fa fa-cog"></i> 送货单设置</div>
        <div class="layui-card-body" pad15>
          <div class="layui-form form-label-w8" lay-filter="">
            <input type="hidden" name="info[id]" value="<?php echo $info['id']; ?>">
            <div class="layui-form-item">
              <label class="layui-form-label">打印标题：</label>
              <div class="layui-input-inline">
                <input type="text" name="info[shipping_pagetitle]" class="layui-input" value="<?php echo $info['shipping_pagetitle']; ?>">
              </div>
              <div class="layui-form-mid" >
                <div class="layui-popover layui-default-link layui-inline">
                  示例
                  <div class="layui-popover-div">
                    <img src="/static/admin/img/dianda_shd.png" style="width: 600px" />
                  </div>
                </div>
              </div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">每页行数：</label>
              <div class="layui-input-inline">
                <input type="text" name="info[shipping_pagenum]" class="layui-input" value="<?php echo $info['shipping_pagenum']; ?>">
              </div>
              <div class="layui-form-mid" >仅支持商城送货单，控制每页显示和打印行数（根据纸张大小修改），0为不限制</div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">品名及规格行数：</label>
              <div class="layui-input-inline">
                <input type="text" name="info[shipping_linenum]" class="layui-input" value="<?php echo $info['shipping_linenum']; ?>">
              </div>
              <div class="layui-form-mid" >仅支持商城送货单，控制“品名及规格”文字显示几行，多出的用省略号表示，0为不限制</div>
            </div>
            <?php if(getcustom('shd_print') ||  getcustom('shop_shd_print2')): ?>
            <div class="layui-form-item">
              <label class="layui-form-label">批量打印金额：</label>
              <div class="layui-input-inline">
                <input type="radio" name="info[printmoney]" value="0" <?php if($info['printmoney']==0): ?>checked<?php endif; ?> title="隐藏"/>
                <input type="radio" name="info[printmoney]" value="1" <?php if($info['printmoney']==1): ?>checked<?php endif; ?> title="显示"/>
              </div>
              <div class="layui-form-mid" >仅支持商城送货单</div>
            </div>
            <div class="layui-form-item">
              <label class="layui-form-label">批量打印第几联：</label>
              <div class="layui-input-inline">
                <input type="radio" name="info[printlian]" value="0" <?php if($info['printlian']==0): ?>checked<?php endif; ?> title="隐藏"/>
                <input type="radio" name="info[printlian]" value="1" <?php if($info['printlian']==1): ?>checked<?php endif; ?> title="显示"/>
              </div>
              <div class="layui-form-mid">仅支持商城送货单</div>
            </div>
            <?php endif; ?>
            <div class="layui-form-item">
              <label class="layui-form-label"></label>
              <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formsubmit">提 交</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="/static/admin/layui/layui.all.js?v=20210226"></script>
<script type="text/javascript" src="/static/admin/layui/lay/modules/flow.js?v=1"></script>
<script type="text/javascript" src="/static/admin/layui/lay/modules/formSelects-v4.js"></script>
<script type="text/javascript" src="/static/admin/js/jquery-ui.min.js?v=20200228"></script>
<script type="text/javascript" src="/static/admin/ueditor/ueditor.js?v=20220707"></script>
<script type="text/javascript" src="/static/admin/ueditor/135editor.js?v=20200228"></script>
<script type="text/javascript" src="/static/admin/webuploader/webuploader.js?v=2024"></script>
<script type="text/javascript" src="/static/admin/js/qrcode.min.js?v=20200228"></script>
<script type="text/javascript" src="/static/admin/js/dianda.js?v=2022"></script>
<script type="text/javascript" src="/static/admin/js/inputTags.js?v=2026"></script>

<div id="NewsToolBox"></div>
<script type="text/javascript">
		// 解释文字浮层展示
		$('.layui-text-popover').mouseenter(function(){
			let pageHeight = $(window).height() + $(document).scrollTop();
			let bottom = pageHeight - $(this).offset().top
			let topNum = ($(this).offset().top - $(document).scrollTop()).toFixed(2);
			let Height = $(this).find('.layui-textpopover-div').outerHeight();
			$(this).find('.layui-textpopover-div').show()
			let that = this;
			setTimeout(function(){
				if(topNum < (Height/2-15)){
					$(that).find('.layui-textpopover-div').css({'top':-topNum+10+'px','opacity':1,'transition':'opacity .3s'})	
				}else if(bottom < (Height/2-15)){
					$(that).find('.layui-textpopover-div').css({'top': bottom-Height-10 +'px','opacity':1,'transition':'opacity .3s'})	
				}else{
					$(that).find('.layui-textpopover-div').css({'top':-(Height/2-15)+'px','opacity':1,'transition':'opacity .3s'})	
				}
			},100)
		}) 
		$('.layui-text-popover').mouseleave(function(){
			$(this).find('.layui-textpopover-div').css({'opacity':0})	
			$(this).find('.layui-textpopover-div').hide()
		}) 
		$('.layui-textpopover-div').mouseenter(function(){
			$(this).find('.layui-textpopover-div').show()
		})
		$('.layui-textpopover-div').mouseleave(function(){
			$(this).find('.layui-textpopover-div').css({'opacity':0})
			$(this).find('.layui-textpopover-div').hide()
		})
		// 图片浮层展示 示例
		$('.layui-popover').mouseenter(function(){
			let pageHeight = $(window).height() + $(document).scrollTop();
			let bottom = pageHeight - $(this).offset().top
			let topNum = ($(this).offset().top - $(document).scrollTop()).toFixed(2);
			let Height = $(this).find('.layui-popover-div').outerHeight();
			$(this).find('.layui-popover-div').show()
			let that = this;
			setTimeout(function(){
				if(topNum < (Height/2-15)){
					$(that).find('.layui-popover-div').css({'top':-topNum+10+'px','opacity':1,'transition':'opacity .3s'})	
				}else if(bottom < (Height/2-15)){
					$(that).find('.layui-popover-div').css({'top': bottom-Height-10 +'px','opacity':1,'transition':'opacity .3s'})	
				}else{
					$(that).find('.layui-popover-div').css({'top':-(Height/2-15)+'px','opacity':1,'transition':'opacity .3s'})	
				}
			},100)
		}) 
		$('.layui-popover').mouseleave(function(){
			$(this).find('.layui-popover-div').css({'opacity':0})	
			$(this).find('.layui-popover-div').hide()
		}) 
    function copyText(text) {
        var top = document.documentElement.scrollTop;
        var textarea = document.createElement("textarea"); //创建input对象
        var currentFocus = document.activeElement; //当前获得焦点的元素
        var toolBoxwrap = document.getElementById('NewsToolBox'); //将文本框插入到NewsToolBox这个之后
        toolBoxwrap.appendChild(textarea); //添加元素
        textarea.value = text;
        textarea.focus();
        document.documentElement.scrollTop = top;
        if (textarea.setSelectionRange) {
            textarea.setSelectionRange(0, textarea.value.length); //获取光标起始位置到结束位置
        } else {
            textarea.select();
        }
        try {
            var flag = document.execCommand("copy"); //执行复制
        } catch (eo) {
            var flag = false;
        }
        toolBoxwrap.removeChild(textarea); //删除元素
        currentFocus.focus();
        if(flag) layer.msg('复制成功');
        return flag;
    }
		// 查看链接
		function viewLink(path,url=''){
			var pagepath = path;
			if(!url){
				var url = "<?php echo m_url('"+pagepath+"'); ?>"; //拼接 H5 链接
			}
			<?php if(!in_array('mp',$platform)): ?>
				showwxqrcode(pagepath);
				return;
			<?php endif; ?>
			var html = '';
			html+='<div style="margin:20px">';
			html+='	<div style="width:100%;margin:10px 0" id="urlqr"></div>';
			<?php if(in_array('wx',$platform)): ?>
			html+='	<div style="width:100%;text-align:center"><button class="layui-btn layui-btn-sm layui-btn-primary" onclick="showwxqrcode(\''+pagepath+'\')">查看小程序码</button></div>';
			<?php endif; ?>
			html+='	<div style="line-height:25px;"><div><span style="width: 70px;display: inline-block;">链接地址：</span><button class="layui-btn layui-btn-xs layui-btn-primary" onclick="copyText(\''+url+'\')">复制</button></div><div>'+url+'</div></div>';
			html+='	<div style="height:50px;line-height:25px;"><div><span style="width: 70px;display: inline-block;">页面路径：</span><button style="box-sizing: border-box;" class="layui-btn layui-btn-xs layui-btn-primary" onclick="copyText(\'/'+pagepath+'\')">复制</button></div><div>/'+pagepath+'</div></div>';
			html+='</div>';
			layer.open({type:1,'title':'查看链接',area:['500px','430px'],shadeClose:true,'content':html})
			var qrcode = new QRCode('urlqr', {
					text: 'your content',
					width: 200,
					height: 200,
					colorDark : '#000000',
					colorLight : '#ffffff',
					correctLevel : QRCode.CorrectLevel.L
				});
				qrcode.clear();
				qrcode.makeCode(url);
		}
		// 查看小程序码
		function showwxqrcode(pagepath){
			var index = layer.load();
			$.post("<?php echo url('DesignerPage/getwxqrcode'); ?>",{path:pagepath},function(res){
				layer.close(index);
				if(res.status==0){
					layer.open({type:1,area:['300px','350px'],content:'<div style="margin:auto auto;text-align:center"><div style="color:red;width:280px;height:180px;margin-top:100px">'+res.msg+'</div><div style="height:25px;line-height:25px;">'+'/'+pagepath+'</div></div>',title:false,shadeClose:true})
				}else{
					layer.open({type:1,area:['300px','350px'],content:'<div style="margin:auto auto;text-align:center"><img src="'+res.url+'" style="margin-top:20px;max-width:280px;max-height:280px"/><div style="height:25px;line-height:25px;">'+'/'+pagepath+'</div></div>',title:false,shadeClose:true})
				}
			})
		}
</script>
<!-------使用js导出excel文件--------->
<script src="/static/admin/excel/excel.js?v=2024"></script>
<script src="/static/admin/excel/layui_exts/excel.js"></script>
<script>

    var excel = new Excel();
    var excel_name = '<?php echo $excel_name; ?>';
    excel.bind(function (data,title) {
        var excel_field = JSON.parse('<?php echo $excel_field; ?>');
        if(title && title!=undefined){
            //接口返回的title
            var excel_title = title;
        }else{
            //excel_field.php 配置的title
            var excel_title = JSON.parse('<?php echo $excel_title; ?>');
        }
        if(!excel_title || excel_title.length<=0){
            //上面两种都没有title,读取table表格cols中的title，同时filed也更新为table表格cols中的field
            excel_title = [];
            excel_field = [];
            var cols = tableIns.config.cols;
            cols.forEach(function (cols_item, cols_index) {
                console.log(cols_item);
                cols_item.forEach(function (cols_item2, cols_index2) {
                    console.log(cols_item2);
                    if(cols_item2.title){
                        excel_title.push(cols_item2.title)
                        excel_field.push(cols_item2.field)
                    }
                })
            })
        }
        // if(!excel_title || excel_title.length<=0){
        //     layer.msg('未设置标题');
        //     return;
        // }

        // 设置表格内容
        data.forEach(function (item, index) {
            var _data = [];
            excel_title.forEach(function (title, index2) {
                var field = excel_field[index2];
                if(item[field] && item[field]!=undefined){
                    //有filed 匹配field
                    var field_val = item[field];
                    //是整数 长度为10 字段名包含time 判定为时间戳
                    if(parseInt(field_val) == field_val && (field_val.toString()).length==10 && field.includes('time')){
                        field_val = date('Y-m-d H:i:s',field_val);
                    }
                }else{
                    //没有filed 根据顺序来
                    var field_val = item[index2];
                }
                _data.push(field_val);
            })
            data[index] = _data;
        });
        // 设置表头内容
        if(excel_title && excel_title.length>0){
            data.unshift(excel_title);
        }
        // 应用表格样式
        return this.withStyle(data);

    }, excel_name+layui.util.toDateString(Date.now(), '_yyyyMMdd_HHmmss'));

</script>

  <script>
    var express_ldata = <?php echo !empty($express_ldata) ? $express_ldata : "''"; ?>;
    var express_rdata = <?php echo !empty($express_rdata) ? $express_rdata : "''"; ?>;
    layui.use(['transfer'], function(){
      var transfer = layui.transfer
      //显示搜索框
      transfer.render({
        elem: "#express_data",
        id:"express_right",
        data: express_ldata,
        value: express_rdata,
        title: ['系统快递', '自定义快递'],
        height:500,
        showSearch: true,
        onchange: function(obj, index){
          var getData = transfer.getData('express_right'); //获取右侧数据
          var len = getData.length;
          if(getData && len>0){
            var data = {};
            for(var i=0;i<len;i++){
              data[getData[i].title] = getData[i].value;
            }
            $('#express_datas').val(JSON.stringify(data));
          }else{
            $('#express_datas').val('');
          }
        }
      })
    });
    // 调用
    $('.videoMoveBtn').click(function () {
        transfornMove({
            elem: '#express_data',
            direction: $(this).data('direction')
        })
    });
    function transfornMove(option) {
        var rightTransforn   = $($(option.elem + " ul")[1])
        var checkItem        = rightTransforn.find('.layui-form-checked').parent()
        var rightTransBottom = rightTransforn.children()
        var checkOneIndex    = rightTransBottom.index(option.direction == 'down' ? checkItem[checkItem.length - 1] : checkItem[0])
        var rightDataLength  = rightTransBottom.length
        if (!checkItem.length) {
            layer.msg("请选择数据后再操作");
            return;
        }
        if (checkOneIndex == (option.direction == 'down' ? rightDataLength - 1 : 0)) {
            layer.msg("已是首位");
            return;
        }
        if (option.direction == 'down') {
            for (var i = checkItem.length; i >= 0; i--) {
                checkItem.eq(i).next().after(checkItem.eq(i));
            }
        } else {
            for (var i = 0; i < checkItem.length; i++) {
                checkItem.eq(i).prev().before(checkItem.eq(i));
            }
        }
        var getData = layui.transfer.getData('express_right'); //获取右侧数据
        var len = getData.length;
        if(getData && len>0){
          var data = {};
          for(var i=0;i<len;i++){
            data[getData[i].title] = getData[i].value;
          }
          $('#express_datas').val(JSON.stringify(data));
        }else{
          $('#express_datas').val('');
        }
    }
    layui.form.on('submit(formsubmit)', function(obj){
      var field = obj.field
      var index = layer.load();
      $.post("<?php echo url('save'); ?>",field,function(data){
        layer.close(index);
        dialog(data.msg,data.status);
      })
    })
  </script>
</body>
</html>