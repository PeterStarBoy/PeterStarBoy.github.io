<?php
//��֤�û�����������
//1.��֤����֤
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
