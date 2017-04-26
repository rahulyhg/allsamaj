<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_Committee extends \xepan\cms\View_Tool{
	public $options=[];
	function init(){
		parent::init();
		$samaj_id = $this->app->stickyGET('samaj_id');
		$m = $this->add('xavoc\allsamaj\Model_Committee');
		if($samaj_id)
			$m->addCondition('samaj_id',$samaj_id);

		$l = $this->add('CompleteLister',null,null,['view/committee']);
		$l->setModel($m);			
	}

	// function defaultTemplate(){
	// 	return ['view/committee'];
	// }
}