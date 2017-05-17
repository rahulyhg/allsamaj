<?php

namespace xavoc\allsamaj;


/**
* 
*/
class Model_FeedBack extends \xepan\base\Model_Table{
	public $table="allsamaj_feedback";
	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\Samaj','samaj_id');
		$this->hasOne('xavoc\allsamaj\Event','event_id');

		$this->addField('created_at')->defaultValue($this->app->today);//->validate('required');
		$this->addField('message')->type('text');//->validate('required');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}