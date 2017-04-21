<?php 
 	
namespace xavoc\allsamaj;

class Model_ContentCategory extends \xepan\base\Model_Table {
	public $table= "allsamaj_content_category";
	public $acl=false;

	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\Samaj','samaj_id');

		$this->addField('name');
		$this->hasMany('xavoc\allsamaj\News','samaj_id');
		$this->hasMany('xavoc\allsamaj\Events','samaj_id');

		$this->is([
				'name|to_trim|required',
				'samaj_id|required',
			]);
		
		$this->add('dynamic_model\Controller_AutoCreator');
	}
}