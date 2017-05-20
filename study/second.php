<?php
//验证用户名和密码类
//1.验证码验证
class Validation 
{
	public $captcha;
	public function checkCaptcha() 
	{
		if(!empty($_POST['captcha'])) return;
		$this -> $catpcha = $_POST['captcha'];
		if($this -> $catpcha == "") 
		{
			return;
		}
	}
}
