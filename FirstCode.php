<?php
//something about my inner feeling, hope you guys like it. 0_0 
//create a virtual Peter, it's a superman
class Peter 
{
	private $name;
	private $age;
	private $height;
	private $weight;
	private $grade;
	private $sex;
	private $hobby;
	private $wife;
	private $mummy;
	private $daddy;
	private $house;

	public static function cooking($fresh = '', $veg = '', $spice = '') 
	{
		if(empty($fresh) && empty($veg) && empty($spice)) 
		{
			return echo "you cant cook with nothing!!!";
		} 
	}
}

Peter::cooking();