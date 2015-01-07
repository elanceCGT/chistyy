<?php

App::uses('AppModel', 'Model');

class Faq extends AppModel {
	
	public $primaryKey	= 'id';

	//public $validationDomain = 'validation_errors';	
	
	public $validate = array(
		 
	);
	
	public $belongsTo = array(
        'FaqCategory' => array(
            'className' => 'FaqCategory',
            'foreignKey' => 'faq_category_id'
        )
    );
	
}
