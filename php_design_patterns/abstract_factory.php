<?php
//PHP_DESIGN_PATTERNS----ABSTRACT_FACTORY
//create original classes
class Button {}
class Border {}
//Mac & Win extends
class MacButton extends Button {}
class WinButton extends Button {}
class MacBorder extends Border {}
class WinBorder extends Border {}
//create interface
interface AbstractFactory 
{
	public function CreateButton ();
	public function CreateBorder ();
}
//instance and emplements interface
class MacFactory implements AbstractFactory 
{
	public function CreateButton () { return new MacButton(); }
	public function CreateBorder () { return new MacBorder(); }
}

class WinFactory implements AbstractFactory 
{
	public function CreateButton () { return new WinButton(); }
	public function CreateButton () { return new WinBorder(); }
}

?>