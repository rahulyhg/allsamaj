<?php


namespace xavoc\allsamaj;

class Tool_SamajNews extends \xepan\cms\View_Tool {

	public $options=[];
	
	function init(){
		parent::init();
		
		$samaj_id = $this->app->stickyGET('samaj_id');
		$n = $this->add('xavoc\allsamaj\Model_Samaj');
		if(!$samaj_id){
		
		}

		$this->setModel($n);
	}

	function defaultTemplate(){
		return ['view/samajdetail'];
	}
}