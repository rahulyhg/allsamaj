<?php

namespace xavoc\allsamaj;

/**
* 
*/
class page_eventfeedback extends \xepan\base\Page{
	public $title = "Events Comments";
	function init(){
		parent::init();

		$event_id = $this->app->stickyGET('event_id');
		
		$comment = $this->add('xavoc\allsamaj\Model_FeedBack');
		if($event_id)
			$comment->addCondition('event_id',$event_id);
		$crud = $this->add('xepan\hr\CRUD',null,null,['view/grid/event-comment']);
		$crud->setModel($comment);

	}
}