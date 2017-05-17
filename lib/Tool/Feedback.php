<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_Feedback extends \xepan\cms\View_Tool{
	public $options=[

	];		
	
	function init(){
		parent::init();
		$samaj_id = $this->app->stickyGET('samaj_id');
		$event_id = $this->app->stickyGET('event_id');
		
		$m = $this->add('xavoc/allsamaj/Model_FeedBack');
		$m->addCondition('status','Active');
		if($samaj_id OR !$event_id)
			$m->addCondition('samaj_id',$samaj_id);
		if($event_id)
			$m->addCondition('event_id',$event_id);
		
		$view = $this->add('View');
		
		
		$f = $view->add('Form');
		$f->setLayout(['view/feedback']);

		$lister = $view->add('CompleteLister',null,null,['view/feedback-list']);
		// $f->addField('line','email')->validate('required');
		$comment_f = $f->addField('text','comment')->validate('required');
		
		$f->addSubmit('Comment')->addClass('btn btn-success btn-block');

		if($f->isSubmitted()){
			// throw new \Exception($samaj_id, 1);
			
			$comment_m = $this->add('xavoc/allsamaj/Model_FeedBack');
			$comment_m['samaj_id'] = $samaj_id;
			$comment_m['event_id'] = $event_id;
			$comment_m['message']  = $f['comment'];
			$comment_m['status']  = $f['InActive'];
			$comment_m->save();

			$js = [
				// $f->js()->reload(),
				$f->js()->html('<div style="width:100%"><img style="width:20%;display:block;margin:auto auto 50%;" src="vendor\xepan\communication\templates\images\email-loader.gif"/></div>')->reload()
			];

			$f->js(true,$js)->execute();
		}
		
		$m->setOrder('id','desc');
		$lister->setModel($m);
		$lister->addHook('formatRow',function($l){
			$l->current_row['created_at'] = date('d M Y',strtotime($l->model['created_at']));
		});
	}
}