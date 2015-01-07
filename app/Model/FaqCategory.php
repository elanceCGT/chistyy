<?php

App::uses('AppModel', 'Model');

class FaqCategory extends AppModel {
	
	public $primaryKey	= 'id';
	//public $validationDomain = 'validation_errors';	
	
	public $validate = array(
		 
	);
	
	 
     public $hasMany = array(
        'Faq' => array(
            'className' => 'Faq',
            'foreignKey' => 'faq_category_id',
            //'conditions' => array('Comment.status' => '1'),
            //'order' => 'Comment.created DESC',
            //'limit' => '5',
            //'dependent' => true
        )
    );
	 
	  
	
	 
	
	
}
