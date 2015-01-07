<?php

class curlClass
{

	public $SIGNATURE;
	public $USER;
	public $PWD;
	public $VERSION;
	public $DEBUG = true;

	public function curlClass()
	{
		$this->PAYPAL_URL = 'https://api-3t.sandbox.paypal.com/nvp';
		$this->SIGNATURE = 'AFcWxV21C7fd0v3bYYYRCpSSRl31Abbc313yzG0WypjZTBtdWLh3goHI';
		$this->USER = 'cgtrohit-facilitator_api1.yahoo.com';
		$this->PWD = '1391256293';
		$this->VERSION = '56.0';

		if ($this->DEBUG == false)// Live Paypal Profile
		{
			$this->PAYPAL_URL = 'https://api-3t.sandbox.paypal.com/nvp';
			$this->SIGNATURE = 'AFcWxV21C7fd0v3bYYYRCpSSRl31Abbc313yzG0WypjZTBtdWLh3goHI';
			$this->USER = 'cgtrohit-facilitator_api1.yahoo.com';
			$this->PWD = '1391256293';
			$this->VERSION = '56.0';
		}
	}

	public function curlCall($postFields)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->PAYPAL_URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($ch);
		return $result;
	}

	public function prepareCurlData($data)
	{
		$postfields = <<<R_INIT
VERSION={$this->VERSION}&SIGNATURE={$this->SIGNATURE}&USER={$this->USER}&PWD={$this->PWD}
R_INIT;
		foreach ($data as $key => $val)
		{
			$postfields .= '&' . $key . '=' . $val;
		}
		return $postfields;
	}

}
