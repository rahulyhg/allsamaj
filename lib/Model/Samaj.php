<?php 
 	
namespace xavoc\allsamaj;

class Model_Samaj extends \xepan\base\Model_Table {
	public $table= "allsamaj_samaj";
	public $acl=false;

	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\City','city_id');

		$this->addField('name');

		$this->hasMany('xavoc\allsamaj\News','samaj_id');
		$this->hasMany('xavoc\allsamaj\Member','samaj_id');
		$this->hasMany('xavoc\allsamaj\CommitiMember','samaj_id');
		$this->hasMany('xavoc\allsamaj\Event','samaj_id');

		$this->add('dynamic_model\Controller_AutoCreator');

	}
}