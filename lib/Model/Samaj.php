<?php 
 	
namespace xavoc\allsamaj;

class Model_Samaj extends \xepan\base\Model_Table {
	public $table= "allsamaj_samaj";
	public $acl_type="Samaj";

	public $actions= [
				'Active'=>['view','edit','delete','member_management','manage_news','manage_event','manage_committee','manage_categories','deactivate'],
				'InActive'=>['view','edit','delete','activate'],
				];

	function init(){
		parent::init();

		$this->hasOne('xavoc\allsamaj\City','city_id');

		$this->addField('name');
		$this->add('xepan/filestore/Field_Image',['name'=>'image_id','deref_field'=>'thumb_url']);
		$this->addField('status')->enum(['Active','InActive'])->defaultValue('Active');
		$this->addField('description')->type('text');
		$this->addField('search_string')->type('text')->system(true)->defaultValue(null);
		
		$this->hasMany('xavoc\allsamaj\News','samaj_id');
		$this->hasMany('xavoc\allsamaj\Member','samaj_id');
		$this->hasMany('xavoc\allsamaj\Committee','samaj_id');
		$this->hasMany('xavoc\allsamaj\Event','samaj_id');

		$this->add('dynamic_model\Controller_AutoCreator');

		$this->addExpression('state')->set(function($m,$q){
			return $m->refSQL('city_id')->fieldQuery('state');
		});

		$this->addHook('beforeSave',[$this,'updateSearchString']);

		// $this->addExpression('search_string')->set(function($m,$q){
		// 	return $q->expr('CONCAT([0]," ",[1]," ",[2])',[$m->getElement('name'),$m->getElement('city'),$m->getElement('state')]);
		// });



	}

	function page_manage_news($page){
		
		$news_model = $this->add('xavoc\allsamaj\Model_News');
		$news_model->addCondition('samaj_id',$this->id);

		$crud = $page->add('xepan\hr\CRUD',null,null,['view/grid/news']);
		$crud->setModel($news_model);
	}

	function page_manage_event($page){
		
		$event_model = $this->add('xavoc\allsamaj\Model_Event');
		$event_model->addCondition('samaj_id',$this->id);

		$crud = $page->add('xepan\hr\CRUD',null,null,['view/grid/events']);
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

		$crud = $page->add('xepan\hr\CRUD',null,null,['view/grid/member']);
		$crud->setModel($member_model);
	}

	function page_manage_committee($page){
		
		$c_model = $this->add('xavoc\allsamaj\Model_Committee');
		$c_model->addCondition('samaj_id',$this->id);

		$crud = $page->add('xepan\hr\CRUD',null,null,['view/grid/committee']);
		$crud->setModel($c_model);

		// if(!$crud->isEditing()){
		// 	$crud->grid->js('click')->univ()->newWindow($this->app->url('xavoc_allsamaj_committeemember',['committee_id'=>$c_model->id]),"Committee Member");
		// }
	}

	function updateSearchString($m){

		$search_string = ' ';
		$search_string .=" ". $this['name'];
		$search_string .=" ". $this['description'];
		$search_string .=" ". $this['city'];
		$search_string .=" ". $this['state'];

		$this['search_string'] = $search_string;
		
	}
}