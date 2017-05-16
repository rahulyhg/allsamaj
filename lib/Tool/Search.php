<?php

namespace xavoc\allsamaj;

/**
* 
*/
class Tool_Search extends \xepan\cms\View_Tool{
	public $options = [
					'form_layout'=>'view/searchform',
					'xavoc_allsamaj_search_result_page'=>"index",
					'search-field-label'=>"Type Your Search String",
					'search-form-btn'=>true,
					// 'search-form-btn-label'=>'Search',
					// 'search-button-position'=>"after",
					// 'search-form-btn-icon'=>"glyphicon glyphicon-search"
					];
	function init(){
		parent::init();

		$this->addClass('xepan-commerce-search-tool');

		$search_result_page=$this->options['xavoc_allsamaj_search_result_page'];
		if(!$search_result_page){
			$search_result_page="index";
		}


	   	$label = "";
		if($this->options['search-field-label'] != "")
			$label = $this->options['search-field-label'];

		$f = $this->add('Form',null,null,['form/empty']);;
		$f->setLayout($this->options['form_layout']);

		$search_samaj = $this->add('xavoc\allsamaj\Model_Samaj',['title_field'=>'search_string']);
		// $search_field = $f->addField('autocomplete\Basic','search');
		$search_field = $f->addField('line','search',$label)->validate('required');//->setAttr('PlaceHolder',$this->options['search-input-placeholder']);
		// $search_field->setModel($search_samaj);
	   	

		// $form = $this->add('Form');
	   	
	   	if($this->options['search-form-btn']){
	   		$f->addSubmit(' ')->addClass(' btn btn-default glyphicon  glyphicon-search');
	   		if($this->options['search-button-position'] === "before")
	  	 		$submit_button = $search_field->beforeField()->add('Button');
	  	 	else
	  	 		$submit_button = $search_field->afterField()->add('Button');
	  	 	$submit_button->setIcon('fa '.$this->options['search-form-btn-icon']);
	  	 	$submit_button->set($this->options['search-form-btn-label']);
	  	 	$submit_button->js('click',$f->js()->submit());
	 	  	// $form->addSubmit($this->options['search-form-btn-label'] !=""?$this->options['search-form-btn-label']:"Search");
	   	}

		if($f->isSubmitted()){
			$f->api->redirect(
						$this->api->url(
									null,
									array('page'=>$search_result_page,'search'=>$f['search'])));
		}

	}
}