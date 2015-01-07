<?php

App::uses('AppModel', 'Model');

class CmsPage extends AppModel {
	
	public $validate = array(
		'title' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Title is required'
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumericSpace',
				'message' => "Please enter only alphabet.",
			)
		),
		
		'description' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Description is required'
			),
		),
	);
}
