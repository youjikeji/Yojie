/**
 * @Title: Config
 * @Package package_name
 * @Description: todo(动态表单_组件配置文件-生成添加页面专用JS)
 * @author 管理员
 * @company 重庆特米洛科技有限公司
 * @copyright 本文件归属于重庆特米洛科技有限公司
 * @date 2018-09-30 10:28:43
 * @version V1.0
*/

$(function(){
	initTableWNEW();
	checkidcard();
    var box = navTab.getCurrentPanel();
	var formname='MisAutoAhf';
	box = $('form[id^="'+formname+'"]',box)?$('form[id^="'+formname+'"]',box):box;
});