<?php
//PHP_DESIGN_PATTERNS----BRIDGE
abstract class Abstraction 
{
	protected $imp;
	public function operation () 
	{
		$this -> imp -> operationImp();
	}
}

class RefinedAbstraction extends Abstraction 
{
	public function __construct(Implementor $imp) 
	{
		$this -> imp = $imp;
	}

	public function operation () { $this -> imp -> operationImp(); }
}

abstract class Implementor 
{
	abstract public function operationImp();
}

class ConcreteImplementorA extends Implementor 
{
	public function  operationImp() {}
}

class ConcreteImplementorB extends Implementor 
{
	public function operationImp() {}
}

$abstraction = new RefinedAbstraction( new ConcreteImplementorA() );
$abstraction -> operation();

$abstraction = new RefinedAbstraction( new ConcreteImplementorB() );
$abstraction -> operation();

?>