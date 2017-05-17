<?php

namespace xavoc\allsamaj;


/**
* 
*/
class Model_FeedBack extends \xepan\base\Model_Table{
	public $table="allsamaj_feedback";
	public $acl_type="Committee";
	public $actions= [
				'Active'=>['view','edit','delete','deactivate'],
				'InActive'=>['view','edit','delete','activate'],
				];
	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\Samaj','samaj_id');
		$this->hasOne('xavoc\allsamaj\Event','event_id');

		$this->addField('created_at')->defaultValue($this->app->today);//->validate('required');
		$this->addField('message')->type('text');//->validate('required');
		$this->addField('status')->enum(['Active','InActive'])->defaultValue('Active');
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}