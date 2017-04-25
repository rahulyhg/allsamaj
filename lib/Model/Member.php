<?php 
 	
namespace xavoc\allsamaj;

class Model_Member extends \xepan\base\Model_Table {
	public $table= "allsamaj_member";
	public $acl=false;

	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\Samaj','samaj_id');
		$this->addField('name');

		$this->is([
				'name|to_trim|required',
				'samaj_id|required',
			]);

		$this->add('dynamic_model\Controller_AutoCreator');		

	}
}