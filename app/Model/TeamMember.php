<?php

App::uses('AppModel', 'Model');

class TeamMember extends AppModel {	
	public $primaryKey	= 'id';	
    
    public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
		'name_jpn' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
        
		'designation' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			),
			
		),
		'designation_jpn' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			),
		),
		
	);
    
    
    
}
