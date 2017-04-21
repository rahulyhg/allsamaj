<?php 
 	
namespace xavoc\allsamaj;

class Model_State extends \xepan\base\Model_Table {
	public $table= "allsamaj_state";
	public $acl=false;

	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\Country','country_id');

		$this->addField('name');
		$this->hasMany('xavoc\allsamaj\City','state_id');

		$this->add('dynamic_model\Controller_AutoCreator');

	}
}