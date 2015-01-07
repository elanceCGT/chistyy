<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	/**
     * Generate Random Values for given parameters
     * @param int $len
     * @param string $type
     * @return type String
     */
	public function getRandomValues ($len, $type='mix') 
	{
		$typeArr = array('mix', 'char', 'int');
		
		if ( !in_array($type, $typeArr) ) 
        {
			$type='mix';
		}
		$val = '';
		while (strlen($val) < $len) {
			if($type == 'digits'){
				$char = rand(0,9);
			}else{
				$char = chr(rand(0,255));
			}						
			if ($type == 'mix') {
                if (eregi('^[a-z0-9]$', $char)){ $val .= $char; }
			} elseif ($type == 'char') {
                if (eregi('^[a-z]$', $char)){ $val .= $char; }
			} elseif ($type == 'int') {
                if (ereg('^[0-9]$', $char)){ $val .= $char; }
			}
		}
		return $val;
	}
	
	public function alphaNumericSpace($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('|^[0-9a-zA-Z ]*$|', $value);
    }
        
        
    public function alphaNumericSymbol($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('|^[0-9a-zA-Z _,]*$|', $value);
    }
	
    /**
     * Check last Query
     * @return type String
     */
	function getLastQuery(){
		$log	=	$this->getDataSource()->getLog(false, false);
		$lastLog	=	end($log['log']);
		return $lastLog['query'];
	}	
}
