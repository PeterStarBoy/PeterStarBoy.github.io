<?php
/**
* Hint: this is my personal mysql summary
* Content: how to stimulate mysql from all kinds of aspects
* Author: Peter
* Date: 2017/5/22
* Menu started here:
*/
//PART 6: Table split and District split
//USAGE: when a table is too big and index can not solve it
//Chapter 1: horizantial split
// (1). make sure how many subtable you want to split, for example, 3 subtable, so we set the subnum = 3.
// (2). split the parent_table into 3 subtable, and rename their name as format(ORIGINNAME+0/1/2);
// (3). when a user commits login process, it works like this:
//		a. get the post data id
//		b. make up the table need to be handle as ORIGINNAME + $id%3;
//		c. check the username and password in the table above as normal.
//		d. when a new user registers, he fill up the personal information such as username and password, but the id 
//		   number is provided by a function such as uuid, then system figure out which table need to be						   inserted(ORIGINNAME+id%3), and all information will be commited to this table.
// (4). now create the subtable and uuid table needed.
/*		CODE: 
		create tbale qq_number0 (id bigint unsigned primary key,
		name varchar(64) not null default '',
		email varchar(64) not null unique,
		pwd char(32) not null default '')engine=myisam charset=utf8;

		create table qq_number1 like qq_number0;
		create tbale qq_number2 like qq_number0;

		create table uuid (id  bigint primary key auto_increment);

		----------OK, EVERYTHING IS READY, NOW WE CAN MAKE IT HAPPEN.----------------
		**FIRST PART: REGISTER
		//need to get the user's information, we just use simple way to show it.
		extract($_GET); //via http passes over name, password, email, in fact, need data verification here.
		//database connect, generate unique uuid;
		//make some const for use
		const UUID = "uuid";
		const TABLE = "qq_number";
		const T_NUM = 3;
		$conn = mysql_connect('localhost', '', '');
		mysql_select_db('test', $conn);
		$sql = "INSERT INTO " . UUID . " VALUES (null)";
		//execute sql and get the id inserted.
		if(mysql_query($sql, $conn)) 
		{
			$id = mysql_insert_id();
			$tablename = TABLE . $id%T_NUM;
			$pwd = md5($pwd);
			//make up new sql santence
			$sql = "INSERT INTO $tablename VALUES ($id, '$name', '$email', '$pwd')";
			if(mysql_query($sql, $conn)) 
			{
				echo "register success, your id is " . $id . ", please take care of your id NO. and password";
			} 
			else 
			{
				echo "data insert error";
			}
		} 
		else 
		{
			echo "ID generate error";
		}
		--------------THEN, WE WILL GO TO THE NEXT PART, LOGIN PART-----------------------
		//same simple way to get the data submited.
		extract($_GET);
		const TABLE = "qq_number";
		const T_NUM = 3;
		//make up sql santence
		$sql = "select pwd from " . TABLE . $id%T_NUM " where id = $id";
		//mysql connect
		$conn = mysql_connect('localhost', '', '');
		mysql_select_db('test', $conn);
		if($row = mysql_query($sql)) 
		{
			//id is right, now we check the password.
			$data = mysql_fetch_assoc($row);
			$pwd = md5($pwd);
			if($pwd === $data['pwd']) 
			{
				echo "login successful";
			} 
			else 
			{
				echo "please check your password and try again!!!";
			}
		} 
		else 
		{
			echo "id does't exist, please check and try again.";
		}
		-------------------------SIMPLE SPLIT END---------------------------------
		



