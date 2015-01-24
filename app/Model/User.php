<?php

App::uses('AppModel', 'Model');

class User extends AppModel
{

	public $primaryKey = 'id';
	
	public $validate = array(
       
			 'username' => array(
					'rule1' => array(
							'rule' => 'notEmpty',
							'message' => "User Name can't empty."
						),
					'rule2' => array(
							'rule' => 'email',
							'message' => "Enter Valid User Name."
						),	
					'rule3' => array(
							'rule' => 'isUnique',
        					'required' => 'create',
							'message' => "Duplicate User Name."
						),
				),
				
				'password' => array(
					'required' => array(
						'rule' => array('notEmpty'),
						'message' => 'Password is required',
						'required' => 'create',
						'last' => true
					),
					'minLength' => array(
						'rule' => array('minLength', '6'),
						'message' => 'Password should be minimum 6 characters long.',
						'required' => 'create',
						'last' => true
					),
					'range' => array(
						'rule' => array('between', 6, 20),
						'message' => 'Password must be between 6 and 20 characters long.',
						'required' => 'create',
					)
				),
				
				'confirm_password' => array(
					'required' => array(
						'rule' => array('notEmpty'),
						'message' => 'Confirm Password is required',
						'required' => 'create',
						'last' => true
					),
					'compare' => array(
						'rule' => array('identicalPassword', 'password'),
						'message' => "Password & Confirm Password does not match.",
						'required' => 'create',
						
					)
				),	
    );
		
	public $hasOne = array(
		'Cleaner' => array('className' => 'Cleaner', 'foreignKey' => 'user_id'), 
		'ServiceProvider' => array('className' => 'ServiceProvider', 'foreignKey' => 'user_id'), 
		'Customer' => array('className' => 'Customer', 'foreignKey' => 'user_id')
	);
	
	public $hasMany = array(
		'ServiceProviderService' => array('className' => 'ServiceProviderService', 'foreignKey' => 'user_id')
    );

	public $captcha = ''; //intializing captcha var
	
	public function setPasswordRequired()
	{
		$this->validate = Set::merge($this->validate, array(
				'password' => array(
					'required' => array(
						'rule' => array('notEmpty'),
						'message' => 'Password is required'
					),
					'minLength' => array(
						'rule' => array('minLength', '6'),
						'message' => 'Password should be minimum 6 characters long.'
					),
					'range' => array(
						'rule' => array('between', 6, 20),
						'message' => 'Password must be between 6 and 20 characters long.'
					)
				)
		));
	}

	public function setCaptchaValidation()
	{
		$this->validate = Set::merge($this->validate, array(
				'captcha' => array(
					'rule' => array('matchCaptcha'),
					'message' => 'Failed validating human check.'
				),
		));
	}

	public function matchCaptcha($inputValue)
	{
		return $inputValue['captcha'] == $this->getCaptcha(); //return true or false after comparing submitted value with set value of captcha
	}

	public function setCaptcha($value)
	{
		$this->captcha = $value; //setting captcha value
	}

	public function getCaptcha()
	{
		return $this->captcha; //getting captcha value
	}

	public function beforeSave($options = array())
	{
		if (isset($this->data[$this->alias]['password']) && (!empty($this->data[$this->alias]['password'])))
		{
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		// Capitalize first letter of the name
		if (isset($this->data[$this->alias]['first_name']))
		{
			$this->data[$this->alias]['first_name'] = ucwords($this->data[$this->alias]['first_name']);
		}
		if (isset($this->data[$this->alias]['last_name']))
		{
			$this->data[$this->alias]['last_name'] = ucwords($this->data[$this->alias]['last_name']);
		}
	}

	public function identicalPassword($field = array(), $compare_field = null)
	{
		foreach ($field as $k => $v)
		{
			$v1 = $v;
			$v2 = $this->data[$this->alias][$compare_field];

			if ($v1 !== $v2)
			{
				return false;
			}
			else
			{
				continue;
			}
		}
		return true;
	}

	public function isUniqueCustom($field = array())
	{
		foreach ($field as $k => $v)
		{
			if (isset($this->data[$this->alias]['id']) && !empty($this->data[$this->alias]['id']))
			{
				$Count = $this->find('count', array(
					'conditions' => array('status !=' => '2',
						$k => $v,
						'id !=' => $this->data[$this->alias]['id']
					)
				));
			}
			else
			{
				$Count = $this->find('count', array(
					'conditions' => array('status !=' => '2', $k => $v)
				));
			}
			if ($Count)
			{
				return false;
			}
		}
		return true;
	}

	public function alphanumericValue($field = array())
	{
		if (isset($field['first_name']))
		{
			$string = $field['first_name'];

			$pattern = '/^[a-z]+([a-z0-9._ ]*)?[a-z0-9]+$/i';

			if (preg_match($pattern, $string))
			{
				return true;
			}
		}
		elseif (isset($field['last_name']))
		{
			$string = $field['last_name'];

			$pattern = '/^[a-z]+([a-z0-9._ ]*)?[a-z0-9]+$/i';

			if (preg_match($pattern, $string))
			{
				return true;
			}
		}
		return true;
	}

	public function checkCurrentPassword($data)
	{
		$this->id = AuthComponent::user('id');
		$password = $this->field('password');
		return(AuthComponent::password($data['current_password']) == $password);
	}

	public function alphaNumericOnly($check)
	{
		// $data array is passed using the form field name as the key
		// have to extract the value to make the function generic
		$value = array_values($check);
		$value = $value[0];
		//echo "ss";exit;
		return preg_match('|^[a-zA-Z]*$|', $value);
	}

}
