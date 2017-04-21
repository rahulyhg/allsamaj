<?php 
 	
namespace xavoc\allsamaj;

class Model_Event extends \xepan\base\Model_Table {
	public $table= "allsamaj_event";
	public $acl=false;

	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\Samaj','samaj_id');
		$this->hasOne('xavoc\allsamaj\ContentCategory','category_id');

		$this->addField('name')->caption('Title');
		$this->addField('content')->type('text')->display(['form'=>'xepan\base\RichText']);
		$this->addField('from_date')->type('date');
		$this->addField('to_date')->type('date');

		$this->add('dynamic_model\Controller_AutoCreator');		

	}
}