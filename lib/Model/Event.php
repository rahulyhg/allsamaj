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
		
		$this->addField('facebook_url');
		$this->addField('twitter_url');
		$this->addField('google_url');
		$this->addField('instagram_url');
		$this->addField('website_url');
		
		$this->add('xepan/filestore/Field_Image','image_id');

		$this->addExpression('day')->set(function($m,$q){
			return $q->expr('DAY([0])',[$m->getElement('from_date')]);
		});
		$this->addExpression('month')->set(function($m,$q){
			return $q->expr('DATE_FORMAT([0],"%b")',[$m->getElement('from_date')]);
		});
		$this->addExpression('year')->set(function($m,$q){
			return $q->expr('YEAR([0])',[$m->getElement('from_date')]);
		});
		$this->is([
				'name|to_trim|required',
				'samaj_id|required',
				'category_id|required',
				'content|required',
				'from_date|required',
				'to_date|required',
			]);

		$this->add('dynamic_model\Controller_AutoCreator');		

	}
}