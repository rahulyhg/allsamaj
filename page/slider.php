<?php

namespace xavoc\allsamaj;
/**
* 
*/
class page_slider extends \xepan\base\Page{
	public $title = "Carousel";

	function page_index(){
        $category_m = $this->add('xavoc\allsamaj\Model_CarouselCategory');
        $category_c = $this->add('xepan\hr\CRUD',null,null,['view\grid\carouselcategory']);
        $category_c->setModel($category_m,['name'],['name','status']);

        $category_c->grid->addColumn('expander','Images');
    }

    function page_Images(){        
        $category_id = $this->app->stickyGET('carouselcategory_id');

        $image_m = $this->add('xavoc\allsamaj\Model_Images');
        $image_m->addCondition('carousel_category_id',$category_id);

        $image_c = $this->add('xepan\hr\CRUD',null,null,['view/grid/carouselimage']);
        $image_c->setModel($image_m,['file_id','title','text_to_display','alt_text','order','link','carousel_category_id'],['file','title','text_to_display','alt_text','order','link','status']);
    
        $image_c->grid->addHook('formatRow',function($g){
            $g->current_row_html['text_to_display'] = $g->model['text_to_display']; 
        });
    }
}