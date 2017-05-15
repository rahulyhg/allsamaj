<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Model_Images extends \xepan\base\Model_Table{
	public $table = "allsamaj_images";
	function init(){
		parent::init();
		$this->hasOne('xavoc\allsamaj\City','city_id');
		$this->hasOne('xavoc\allsamaj\Samaj','samaj_id');
		$this->add('xepan\filestore\Field_File','file_id');

		$this->hasOne('xavoc\allsamaj\Model_CarouselCategory','carousel_category_id');
		
		
		$this->addField('title');
		$this->addField('text_to_display')->display(['form'=>'xepan\base\RichText']);
		$this->addField('alt_text');
		$this->addField('order');
		$this->addField('link');

		$this->addField('created_at')->type('datetime')->defaultValue($this->app->now);
		$this->addField('status')->enum($this->status)->defaultValue('Visible');
		
		$this->addField('type');
		$this->addCondition('type','CarouselImage');
					
		$this->addExpression('thumb_url')->set(function($m,$q){
			return $q->expr('[0]',[$m->getElement('file')]);
		});

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}