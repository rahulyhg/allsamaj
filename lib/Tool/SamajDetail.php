<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_SamajDetail extends \xepan\cms\View_Tool {
	public $options=[];		
	
	function init(){
		parent::init();
		$samaj_id = $this->app->stickyGET('samaj_id');
		$m = $this->add('xavoc/allsamaj/Model_Samaj');
		if(!$samaj_id){
			$this->add('View_Error')->set('Samaj Not Define');
		}else{
			$m->load($samaj_id);
		}

		$this->setModel($m);		



	}

	function defaultTemplate(){
		return ['view/samajdetail'];
	}
}