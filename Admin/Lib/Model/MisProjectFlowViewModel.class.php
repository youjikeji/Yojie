<?php
/**
 * @Title: MisSystemFlowViewModel
 * @Package 项目模板-项目菜单生成视图
 * @Description: TODO(项目节点与任务)
 * @author yangxi
 * @company 重庆特米洛科技有限公司˾
 * @copyright 重庆特米洛科技有限公司˾
 * @date 2014-10-18 19:18:54
 * @version V1.0
 */
class MisProjectFlowViewModel extends ViewModel {
	
	public $viewFields = array(
			'mis_project_flow_type'=>array('_as'=>'mis_project_flow_type','uid','id','name','complete'=>'type_complete'),
			
	     	'mis_project_flow_form'=>array('_as'=>'mis_project_flow_form','id'=>'form_id','name'=>'form_name','category','complete','begintime','endtime','formobj','critical','formtype','parentid','notes','projectid','xiangmujuese','_on'=>'mis_project_flow_form.category=mis_project_flow_type.id'),
						
			'mis_project_flow_resource'=>array('_as'=>'mis_project_flow_resource','alloterid','executorid','_on'=>'mis_project_flow_resource.id=mis_project_flow_form.id'),
	   );
}
?>