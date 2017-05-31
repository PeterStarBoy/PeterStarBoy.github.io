<?php
/**
* Hint: this is my personal mysql summary
* Content: how to stimulate mysql from all kinds of aspects
* Author: Peter
* Date: 2017/5/22
* Menu started here:
*/
/*
!!!!!!!!!!this is the test line!!!!!!!!!!!!!!!!!
----------------MYSQL OPTIMIZATION INDEX---------------------------
---------1. design the table accroding to 3NF(normal format)-------------------
---------2. create proper index(primary key|unique|index|full text)------------
---------3. SQL sentence optimization(slow query location: explain)------------
---------4. table split(horizontal or vertical) and district split-------------
---------5. read and write seperation------------------------------------------
---------6. create proper procedure, function or triggers----------------------
---------7. my.ini configuration optimization----------------------------------
---------8. hardware and software upgrading------------------------------------
-----------------------------------------------------------------------------------------------
-----------1.design the table according to 3NF---------------
----------1NF indicates the table's attributes(fields) are atomic, can not be split-----------
----------2NF indicates there can not be the same row in the table(same data row)-------------
			  normally we create a primary key to meet this
----------3NF indecates fields de not exist implicit or explicit duction----------------------
			  so it needs another table to store this field and relate them with a id, etc..
-----------2. create proper index(primary key|unique|index|fulltest)------------
----------------------INDEX TYPES------------------------------
			index usually create with the fields where laid after "where" sentence;
			(1). primary key --> the most effective index, noramlly create with logic TD field
				unique and not null
			(2). unique ---> the second effective index, the fields' value can set null.
			(3). index ---> the third effective index, can duplicate and set null.
------------------ADD INDEX AND MODIFY INDEX-------------------------------
			(1). ADD INDEX
			a. when create a table, set right behind the target field
			e.g.
			create table example (id int primary key auto_increment);
			this command can also wrote in the end of the creating sentence.
			b. when a table exists, you can also add indexes on it.
			alter table TABLENAME add primary key|unique|index FIELDNAME;
			(2). DELETE INDEX
			alter table TABLENAME drop primary key; (primary key style)
			alter table TABLENAME drop index FIELDNAME; (unique|index style)
****************HOW TO USE INDEXED CORRECTLY****************
			(1). as for multipul indexes, index will be used when the where sentence contain indexes'very left field.
			(2). as for search sentence like "where FIELD like 'xxx'", when the 'xxx' written like this, such as '%xxx' or '_xxx', indexes invalid. it only valid when the field
			start with 'xxx', not % or _.
			(3). if search condition contain 'OR', then every field selected as search condition must has index on it, otherwise index invalid.
			(4). if target FIELDS' TYPE is string, the saerch word need to be wrapped with quotes, otherwise index invalid.
			(5). if mysql service estimate the whole table scan is faster then index scan, the index will not be used.
			(6). optimize group by sentence, group by sentence will order the result by default, if the target result doesn't need to be sorted, we can add 'order by null' to the end of the group by sentence.
			(7). when there is a child-search, we can use join related_table instead, cos there is no need to create temparate table using join sentence.
			(8). show indexes using status:
			command: show status like "Hanlder_read%";
			in the variables list, healthy indexes show follow info:
			var handler_read_key with a high value and var handler_read_md_next with a low value.
			(9). when lots of data inserting occurs:
			for engine myisam we should do:
			a. alter table TABLENAME disable keys;
			b. loading data/insert sentence;
			c.alter table TABLENAME enable keys;
			for engine innodb we should do:
			a. sort the importing data by primary key;
			b. set unique_checks = 0;(close unique check)
			c. set autocommit = 0; (close autocommit+)
			(10). select proper storage engine:
			MYISAM: can handle plenty of query and inserting.
			table type: such as forum feedback, news, goods, info, etc.
			INNODB: support commit and rollback, it's safer.
			table type: account, points, etc.
			MEMORY/HEAP: change rapidly and no need to be sotred, such as user online status.
			(11). decimal type is more pricise than float type
			(12). if the table's storage engine is MYISAM, it needs to be optimized on time.
			command: optimize table TABLENAME;
-----------3. SQL sentence optimization(slow query location: explain)-----------
			slow query location steps(test before the program put online)
			(1). start mysql service at safe mode
			command sentence: mysql dir\bin\mysqld.exe --safe-mode --slow-query-log
			under mysql client: set long_query_time = 1;
			then test the target sql sentence, the slow query will be added to slow query log.
			******log content analysis(important)*******
			example:
			Time:141122 10:39:45   #show the slow query detected time
			User@Host: root[root] @ localhost[127.0.0.1]   #show user's ID and IP
			Query_time: 1.625093 Lock_time:0.001000 Rows_sent: 0 Rows_examined: 8000000
			(Query_time: if it's too big means complex sql query request and need to be optimized(index))
			(Lock_time: if it's too big means too many visits and need using read & write split to reduce pressure)
			use testdb;	#show database name
			SET timestamp = 1416623985;
			select * from emp where ename = 'IUYTOPUYQEW';	#show sql query sentence
			*************explain content(useful attributes) show***************************
			select-type: simple (stands for serach type)
			table: emp (stands for target table)
			type: all (stands for whole table scan)
			possible_keys: NULL (show available index for current sql sentence)
			key: NULL (show actual used index)
			rows: 8000000 (estimated or scanned rows)
			Extra: Using where (stands for if has extra tasks)
//---------4. table split(horizontal or vertical) and district split-------------
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
		----------------------IT'S SIMPLE TABLE SPLIT, LET'S SEE SOME COMPLEX OCCASION----------------
		it happens to multipul login data type, such as ID, EMAIL, PHONE_NUMBER and so on.
		in this case, we need to convert nultipul data to decimal, then %T_NUM to make up tablename.
		e.g. let's take email address as login data, we'll handle it like this:
		a. convert email to decimal via certain function (we assume the result is dec)
		b. put the result %T_NUM to make up the table name needed, such as EMAIL . dec%T_NUM.
		---------show emial table's construction--------------
		fields: id,  password,  email
		email and password for verification, id is for fetching the whole information in id table.
		------------------VERTICAL SPLIT------------------------------------------------------
		table examples:
		table one:
		name: score | fields id, stu_id, question_id, answer, score
		name: student | fields stu_id, name, age, sex, class (connection: stu_id)
		name: question | fields question_id, content (connection: question_id)
		THERE IS A PROBLEM: THE MAIN TABLE SCORE'S COLUMN answer IS TOO BIG AND IT'S LESS USED, WE NEED TO SPLIT IT OUT(VERTICAL SPLIT)
		SO WE CREATE A NEW TABLE NAMED answer AND INERT ALL THE answer content TO IT, USE A ID FIELD TO CONNECT BOTH
		AS THE OTHER TABLES.
		-------------------------MYSQL MAINTENANCE-------------------------------------------
		1. finish tasks on time
		TASKS: 
		a. backups newsdb every hour under windows operation system
		b. backups table testdb.dept at 2:00 AM everyday under windows operation system
		STEPS:
		(1). use mysqldump command backup table data manually.
			a. go to mysql/bin directory
			b. input command: mysqldump.exe -u username -p password databasename tablename > target directory/backup filename(.bak)
		2. use php code to backup data
		steps: planned tasks -->  mytask.bat --> mytask.php --> backup files and mysql operation.
		----bat code (mytask.bat) -----
		phpdirectory\php.exe target php file directory\mytask.php
		----php code (mytask.php)----
		******this is backup function, you can also send email, upload and download***********
		data_default_timezone_set('PRC');
		$filename = date("YmdHis", time()) . ".bak";
		$command = "C:\mysqlroot\bin\msyqldump -u username -p password databasename tablename > target backup directory/{$filename}";
		exec($command);
		-------command under linux--------
		crontab -c
		* * * * * data >> /home/mydata.bak
---------------------------------EXTRA TIPS----------------------------------
		*****TIME ISSUE 2038*************
		SOLUTION:
		(1). convert timestamp to data
		$d = new DateTime('@INT');
		$d -> setTimezone(new DateTimeZone('PRC'));
		echo $d -> format('Y-m-d H:i:s');
		(2). convert date to timestamp
		$d = new DateTime('DATE');
		echo $d -> format('U');

		



