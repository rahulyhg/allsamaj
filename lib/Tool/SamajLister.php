<?php


namespace xavoc\allsamaj;

class Tool_SamajLister extends \xepan\cms\View_Tool {
	public $options=[
					'show_search_bar'=>true,
					'no_of_record'=>10,
					'no_of_column'=>' ',
					'detail_url_page'=>null

	];


	function init(){
		parent::init();
		

		$samaj_model = $this->add('xavoc\allsamaj\Model_Samaj');
		$lister = $this->add('CompleteLister',null,null,['view/samajlister']);
		
		if($this->options['show_search_bar']){
			$f = $lister->add('Form',null,'search_form');;
			$f->setLayout(['view/serchform']);
			$f->addField('line','search');

			$f->addSubmit(' ')->addClass(' btn btn-default glyphicon  glyphicon-search');

		}else{
			$lister->template->tryDel('search_form');
		}	

		$lister->addHook('formatRow',function($l){
			if($this->options['no_of_column']){
				$l->current_row_html['col'] = $this->options['no_of_column'];
			}else{
				$l->current_row_html['col'] = "";
			}

			if($this->options['detail_url_page']){
				$l->current_row_html['detail_url_page'] = $this->options['detail_url_page'];
			}			
		});

		$lister->setModel($samaj_model);

		if($this->options['no_of_record']){
			$paginator = $lister->add('Paginator',null,'paginator');
			$paginator->setRowsPerPage($this->options['no_of_record']);

			$samaj_model->setLimit($this->options['no_of_record']);
		}

		$lister->add('xepan\cms\Controller_Tool_Optionhelper',['options'=>$this->options,'model'=>$samaj_model]);
	}
}