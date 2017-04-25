<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_EventDetail extends \xepan\cms\View_Tool {
	public $options=[];		
	
	function init(){
		parent::init();
		$event_id = $this->app->stickyGET('event_id');
		$m = $this->add('xavoc/allsamaj/Model_Event');
		if(!$event_id){
			$this->add('View_Error')->set('Event details not presented here');
			return;
		}else{
			$m->load($event_id);
		}

		$this->setModel($m);

	}

	function defaultTemplate(){
		return ['view/eventdetail'];
	}
}