<?php

class analytics_api {
	public $auth;
	public $accounts;
	public function login($email, $password) {		
		$ch = $this->curl_init("https://www.google.com/accounts/ClientLogin");
		curl_setopt($ch, CURLOPT_POST, true);
		
		$data = array(
			'accountType' => 'GOOGLE',
			'Email' => $email,
			'Passwd' => $password,
			'service' => 'analytics',
			'source' => ''
		);
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		
		$this->auth = '';
		if($info['http_code'] == 200) {
			preg_match('/Auth=(.*)/', $output, $matches);
			if(isset($matches[1])) {
				$this->auth = $matches[1];
			}
		}
		
		return $this->auth != '';
	
	}
	protected function curl_init($url) {		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		if($this->auth) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: GoogleLogin auth=$this->auth"));
		}
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		return $ch;
		
	}

}

?>