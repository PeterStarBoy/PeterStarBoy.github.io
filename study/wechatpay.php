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
	public function send_get($url) 
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
}
