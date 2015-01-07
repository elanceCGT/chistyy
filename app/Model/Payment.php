<?php

App::uses('AppModel', 'Model');

/**
 * CakePHP Payment
 * @author Mukesh Sharma
 * @created Dec 20, 2014
 */
class Payment extends AppModel
{

	public $useTable = false;
	
	public $validate = array(
		'cctype' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
		'cardno' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Field must be numeric'
			)
		),
		'cvv' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Field must be numeric')
		),
		'street' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
		'city' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
		'state' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
		'zip' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
		'country' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
		'month' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
		'year' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			)
		),
	);

}
