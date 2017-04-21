<?php 
 	
namespace xavoc\allsamaj;

class Model_City extends \xepan\base\Model_Table {
	public $table= "allsamaj_city";
	public $acl=false;

	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\State','state_id');

		$this->addField('name');
		$this->hasMany('xavoc\allsamaj\Samaj','city_id');

		$this->is([
				'name|to_trim|required',
				'state_id|required',
			]);

		$this->add('dynamic_model\Controller_AutoCreator');
	}
}