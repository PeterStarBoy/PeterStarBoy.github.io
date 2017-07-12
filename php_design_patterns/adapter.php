<?php
//PHP_DESIGN_PATTERNS---ADAPTER
//object adapter

interface Target 
{
	public function sampleMethodOne ();
	public function sampleMethodTwo ();
}

class Adaptee 
{
	public function sampleMethodOne () 
	{
		echo '#############';
	}
}

class Adapter implements Target 
{
	private $_adaptee;

	public function __construct ($adaptee) 
	{
		$this -> _adaptee = $adaptee;
	}

	public function sampleMethodOne () 
	{
		$this -> _adaptee -> sampleMethodOne();
	}

	public function sampleMethodTwo () 
	{
		echo '!!!!!!!!!!!!!!';
	}
}

$adapter = new Adapter( new Adaptee() );
$adapter -> sampleMethodOne();
$adapter -> sampleMethodTwo();

interface Target2 
{
	public function sampleMethodOne();
	public function sampleMethodTwo();
}

class Adaptee2 
{
	public function sampleMethodOne() {}
}

class Adapter2 extends Adaptee2 implements Target2 
{
	public function sampleMethodTwo() {}
}

$adapter = new Adapter2();
$adapter -> sampleMethodOne();
$apapter -> sampleMethodTwo();
?>