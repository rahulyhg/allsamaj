<?php 
 	
namespace xavoc\allsamaj;

class Model_Country extends \xepan\base\Model_Table {
	public $table= "allsamaj_country";
	public $acl=false;
	function init(){
		parent::init();

		$this->addField('name');
		$this->hasMany('xavoc\allsamaj\State','country_id');

		$this->is([
				'name|to_trim|required',
			]);

		$this->add('dynamic_model\Controller_AutoCreator');
	}
}