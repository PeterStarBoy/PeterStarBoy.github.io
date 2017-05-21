<?php
	/**this is the procedure of wechat payment
	*OTDO: gonna show up the procedure of wechat payment
	**/
class Peter 
{
	//stands for the configuration files
	private $config;
	/**
	* TODO: fill up the config information 
	* HINT: you can search for helpful hint through wechat API document.
	* PARAM: $config stands for the configuration files, it's a php file.
	**/
	function stepOne_setConfig($config) 
	{
		if($this -> checkCode($config))	
		{
			$this -> fillUp($config);
		} 
		else 
		{
			return false;
		}
		
	};
	/**
	* TODO: check if the paramater is a file 
	* PARAM: $config file
	* RETURN: boolean true
	**/
	public function checkCode($config) 
	{
		if(is_file($config)) return true;
	}

	/**
	* TODO: get access_token
	* @return: mixed | boolean | unknown
	* HINT: base on ThinkPHP framework
	**/
	public function getToken() 
	{
		//get cache, if access_token exists, return
		$cache_token = S('exp_wechat_pay_token');
		if(!empty($cache_token)) 
		{
			return $cache_token;
		}
		//it appears the access_token does not exist, then get it.
		//format strings, the arguments inside sprintf match the position where %s appears in $url 
		$url = "http://api.weixin.qq.com/asdlflkadsj.lkajsdflkjdas$appid=%s&secret=%s";
		$rul = sprintf($url, $this -> options['appid'], $this -> options['appsecret']);
		//send get request
		$result = $this -> send_get($url);
		//convert to json format, return array when the second param is true
		$result = json_decode($result, true);
		//check the result array
		if(empty($result)) 
		{
			return false;
		}
		//set exp_wechat_pay_token
		S('exp_wechat_pay_token', $result['access_token'], array('type' => 'file', 'expire' => 3600));
		return $rseult['access_token'];
	}

	/**
	* GET request
	* @param string $url
	*/
	private function send_get($url) 
	{
		$oCurl = curl_init();
		//check if its header is https://
		if(strripos($url, "https://") !== false) 
		{
			//forbin cert verification
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
			//set curl version (better default)
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
		} 
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		//execute curl
		$sContent = curl_exec($oCurl);
		//get curl executing status, http_code
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		//check if executed successfully
		if(intval($aStatus['http_code']) == 200) 
		{
			//success
			return $sContent;
		} 
		else 
		{
			return false;
		}
		
	}
	/**
	* TODO: send post request
	* @param string $url
	* @param array $param
	* @param boolean $post_file (weather it's file uploading)
	* @return string content
	*/
	private function send_post($url, $param, $post_file = false) 
	{
		$oCurl = curl_init();
		//check if its header is started with https://
		if(stripos($url, "https://") !== false) 
		{
			//set curl options
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
		}
		//check if there is a file
		if(is_string($param) || $post_file) 
		{
			$strPOST = $param;
		} 
		else 
		{
			$aPOST = array();
			foreach($param as $key => $value) 
			{
				$aPOST[] = $key . "=" . urlencode($value);
			}
			//add & to the end of every element(except the last one)
			$strPOST = join('&', $aPOST);
		}
		//curl continue
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_POST, true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus['http_code']) == 200) 
		{
			return $sContent;
		} 
		else 
		{
			return false;
		}
	}

	/**
	* TODO: send serve message
	* $param array $data (format: {"touser":"OPENID", "msgtype":"news", "news":{.....}})
	*/
	public function sendCustomMessage($data) 
	{
		//get access_token
		$token - $this -> getToken();
		if(empty($token)) return false;
		$url = "https://api.weixin.qq.com/alsdkjfladjf-sdalfhowe?access_token=%s";
		$url = sprintf($url, $token);
		//send post request to the url metioned above, 
		$result = send_post($url, self::json_encode($data));

	}

	/**
	* TODO: generate random strings
	* @param $length int string length
	* @return $str string 
	*/
	public static function getRandomString($length = 32) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIHKLMNOPQRSTUVXYZ";
		$str = '';
		for($i = 0; $i < $length; $i++) 
		{
			$str .= substr($chars, rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}
}
