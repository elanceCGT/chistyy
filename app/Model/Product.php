<?php
App::uses('AppModel', 'Model');

class Product extends AppModel
{
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			),
			'alphanumeric' => array(
				'rule' => array('alphaNumericOnly'),
				'message' => "Please enter only alphanumeric value.",
			),
		),
		'description' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			),
		),
        'image' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required',
                'on' => 'create'               
			),
		),
        'price' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Field is required'
			),
		),
	);

    public function beforeSave($options = array())
	{
		
	}

	public function alphaNumericOnly($check)
	{
		// $data array is passed using the form field name as the key
		// have to extract the value to make the function generic
		$value = array_values($check);
		$value = $value[0];
		//echo "ss";exit;
		return preg_match('|^[a-zA-Z0-9 ]*$|', $value);
	}

}
