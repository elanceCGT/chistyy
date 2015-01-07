<?php
App::uses('AppModel', 'Model');

class Review extends AppModel
{
    public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
    );
    
	public $validate = array(
		'description' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			),
		),
        'rating' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required',
                'on' => 'create'               
			),
		),
        
	);
}
