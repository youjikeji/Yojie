<?php if (!defined('THINK_PATH')) exit();?><script>
function DynamicnavTabDone(json) {
	var a = '<?php echo ($tpltype); ?>';
	DWZ.ajaxDone(json);
	if (json.statusCode == DWZ.statusCode.ok) {
		var type = json.data.type;			// 跳转类型
		var tpltype = json.data.tpltype;	// 模板生成方式， 是基础档案、普通模板 、 审批模板 
		var nodename = json.data.nodename;	// 当前生成action名称 
		var isaudit = json.data.isaudit;	// 是否为审批流程 
		var tablename = json.data.tablename; // 真实生成主表的表名 
		var previewtype = json.data.previewtype; // index模板布局方式 
		$(this).logs('type'+type+'_模板生成方式tpltype:'+tpltype+'__action名nodename:'+nodename+'___审批状态isaudit:'+isaudit+'___表名tablename:'+tablename+'__布局预览previewtype:'+previewtype);
		var params = [{
			name : 'nodename',
			value : nodename
		},{
			name : 'tablename',
			value : tablename
		},{
			name : 'tpltype',
			value : tpltype
		},{
			name : 'isaudit',
			value : isaudit
		},{
			name : 'previewtype',
			value : previewtype
		}];
		
		// 打开拖动编辑页面 
		navTab.closeCurrentTab();
		var tabids = "__MODULE__add";
		var urls = "__URL__/quickedit";
		var titles = "拖动布局";
		var postdata =params;
		navTab.openTab(tabids, urls, {title : titles,fresh : true,data:postdata});
		return false;
	}else{
		navTab.closeCurrentTab();
	}
}
function addbindval(obj){
	var $box=navTab.getCurrentPanel();
	var datasoureItem = $('div.datasoure:last', $box);
	var cloneTab = datasoureItem.clone();
	cloneTab.find('a.icon-plus').attr("class","icon-remove");
	cloneTab.find('a.icon-remove').attr("onclick","removebindval(this)");
	
	
	/*cloneTab.find('div.tml-form-col').each(function(k , v){
		var _this = this;
		var selObj = $(_this).find('a.icon-plus').remove();
		
	});*/
	//cloneTab.find('select.chosen').initChosen();
	datasoureItem.after(cloneTab); 
}
function removebindval(obj){
	var $box=navTab.getCurrentPanel();
	$(obj).parent("div.datasoure").remove();
}
</script>
<style>
.tml-form-row label.tmp_label{margin-left:0px;width: 120px;float: none;font: 14px/30px "Microsoft Yahei","微软雅黑",sans-serif;}
.tml-form-row label.tmp_label:hover{color:#006699;}
</style>

<link href="__PUBLIC__/Css/tmlstyle/model.css" rel="stylesheet" type="text/css" media="screen" />
<div class="page">
	<div class="pageContent" layoutH="40">
		<div class="tml_nqq_page">
			<form method="post" action="__URL__/setindextpl/type/setindextpl" class="pageForm" method="post"  onsubmit="return iframeCallback(this,DynamicnavTabDone);">
			<input type="hidden" name="bindresult"  value=""/>
			 	<div class="new_list_title">
					index页面生成预览
				</div>
				 <script>
				 var box = navTab.getCurrentPanel();
				 $(function(){
					 $('div.tpltypelist' , box).find('input[type="radio"]').click(function(){
						 $('div.tpl_preview > div.preview_item' , box).hide();
						 $('div.tpl_preview > div.preview_item' , box).find('input[type="radio"]').attr('checked',false);
						 $('div.tpl_preview > div.item_'+$(this).val() , box).show();
						 $('div.tpl_preview > div.item_'+$(this).val() , box).find('input[type="radio"]').last().attr('checked',true);
					 });
					 $('div.tpltypelist' , box).find('input[type="radio"]').last().click();
				 });
				 </script>
				 <div class="tml-row depict_warp">
                	<div class="tml-form-row tpltypelist">
                	 <label>模板生成方式：</label>
                	 <?php
 $tpldata = $tpltypeArr[$tpltype][0]['item']; ?>
						<!-- 模板生成类型   -->
						<?php if(is_array($tpldata)): $i = 0; $__LIST__ = $tpldata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i; echo createTags($item); endforeach; endif; else: echo "" ;endif; ?>
                	</div>
                	<div class="tml-form-row datasoure">
						<?php if($tpltype == 'zuhetpl'): ?><label>选择绑定数据源：</label>
						<select name="bindval[]"  class=" require" >
						<option  value="">请选择</option>
						</select>
						<a class="icon-plus" onclick="addbindval(this)"></a><?php endif; ?>
                	</div>
                </div>
                <div class="tml-row depict_warp">
				<div class="sel_mod_lay">
                 <label>生成模板结构如下:</label>
                 <div class="tpl_preview">
                 	<!--  列出所有当前可用的模板生成方式 -->
                 	<?php if(is_array($tpldata)): $i = 0; $__LIST__ = $tpldata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tplitem): $mod = ($i % 2 );++$i; if(is_array($tplitem['tpl'])): $i = 0; $__LIST__ = $tplitem['tpl'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><!--  布局方式  -->
	                 		<div class="preview_item item_<?php echo ($tplitem['value']); ?>">
	                 		<input type="radio" style="color:red" name="nbm_tpl" value="<?php echo ($item['value']); ?>"/><?php echo ($item['title']); ?>
	                 		<?php echo ($item['content']); ?>
	                 		</div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                 </div>
                 </div>
                </div>
				 <!-- 
				 页面板式：
				 	基础档案：
				 		左菜单，右内容
				 	普通表单：
			 			左树右内容，
			 			左内容右树
			 			无树
				 	审批	流表单：
				 		左菜单，右内容
				  -->
				  <!-- 基础档案  -->
				  <div class="tml_nqq_page">
				<?php
 $tpldata = $tpltypeArr[$tpltype]['tpl']; ?>
				<?php if(tpldata): if(is_array($tpldata)): $key = 0; $__LIST__ = $tpldata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($key % 2 );++$key; echo ($key); ?>
					<div class="new_list_title1">
						<?php echo ($item["title"]); ?><input  type="radio" value="<?php echo ($item["value"]); ?>" name="nbm_tpl" <?php if($key == 1): ?>checked="checked"<?php endif; ?> />
					</div>
					<?php echo ($item["content"]); endforeach; endif; else: echo "" ;endif; endif; ?>
				
				</div>
				<div class="formBar" style="border-top: 1px solid #d8d8d8; padding-top: 15px">
					<ul>
						<li>
							模板生成方式：
							<?php echo createTags($tpltypeArr[$tpltype]);?>
						</li>
						<li>
							<!-- 缓存当前的数据表名与action名 -->
							<input type="hidden" name="tablename" value="<?php echo ($tablename); ?>" />
							<input type="hidden" name="nodename" value="<?php echo ($nodename); ?>" />
							<button type="submit" class="tml_formBar_btn tml_formBar_btn_blue">
								保存所有表
							</button>
						</li>
					</ul>
				</div>
				</form>
		</div>
	</div>
</div>