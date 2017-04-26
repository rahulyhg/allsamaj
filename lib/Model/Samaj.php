<?php 
 	
namespace xavoc\allsamaj;

class Model_Samaj extends \xepan\base\Model_Table {
	public $table= "allsamaj_samaj";
	public $acl_type="Samaj";

	public $actions= [
				'Active'=>['view','edit','delete','member_management','manage_news','manage_event','manage_categories','deactivate'],
				'InActive'=>['view','edit','delete','activate'],
				];

	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\City','city_id');

		$this->addField('name');
		$this->add('xepan/filestore/Field_Image',['name'=>'image_id','deref_field'=>'thumb_url']);
		$this->addField('status')->enum(['Active','InActive'])->defaultValue('Active');
		$this->addField('description')->type('text');
		
		$this->hasMany('xavoc\allsamaj\News','samaj_id');
		$this->hasMany('xavoc\allsamaj\Member','samaj_id');
		$this->hasMany('xavoc\allsamaj\Committee','samaj_id');
		$this->hasMany('xavoc\allsamaj\Event','samaj_id');

		$this->add('dynamic_model\Controller_AutoCreator');

		$this->addExpression('state')->set(function($m,$q){
			return $m->refSQL('city_id')->fieldQuery('state');
		});

		$this->addExpression('search_string')->set(function($m,$q){
			return $q->expr('CONCAT([0]," ",[1]," ",[2])',[$m->getElement('name'),$m->getElement('city'),$m->getElement('state')]);
		});



	}

	function page_manage_news($page){
		
		$news_model = $this->add('xavoc\allsamaj\Model_News');
		$news_model->addCondition('samaj_id',$this->id);

		$crud = $page->add('xepan\hr\CRUD');
		$crud->setModel($news_model);
	}

	function page_manage_event($page){
		
		$event_model = $this->add('xavoc\allsamaj\Model_Event');
		$event_model->addCondition('samaj_id',$this->id);

		$crud = $page->add('xepan\hr\CRUD');
		$crud->setModel($event_model);
	}

	function page_manage_categories($page){
		
		$categories_model = $this->add('xavoc\allsamaj\Model_ContentCategory');
		$categories_model->addCondition('samaj_id',$this->id);

		$crud = $page->add('xepan\hr\CRUD');
		$crud->setModel($categories_model);
	}

	function page_member_management($page){
		
		$member_model = $this->add('xavoc\allsamaj\Model_Member');
		$member_model->addCondition('samaj_id',$this->id);

		$crud = $page->add('xepan\hr\CRUD');
		$crud->setModel($member_model);
	}
}