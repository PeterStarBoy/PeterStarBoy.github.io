<?php
/*
	---------------NOSQL DATABASE SUMMARY-----------------
	(1). MONGODB
	a. download MONGODB zip file.
	b. unpack the MONGODB file to target directory.
	c. then create db folder to save database and log.txt to save log.
	d. run cmd to install mongodb.
	e. under cmd window, type mongod.exe -dbpath=db folder path/ -logpath=log.txt -install
	f. in cmd window, type path/mongo.exe to get connection with mongo.
	PHP EXTENSION.
	a. using phpinfo() function to display php version info.
	b. check the ZEND EXTENTION BUILD and PHP EXTENTION BUILD.
	c. download extentional files according to both metioned above.
	d. put the extention file into PHP ext folder
	e. set the php.ini, open the relative extension.dll.
	f. restart Apache server and check the phpinfo's info if has new extension.
	(2). MEMCACHE
	almost the same procudre with the MONGODB INSTALLATION.
	the DIFFERENCE IS:
	installation: in the memcached folder: type command: memcached.exe -d install
	how to start: under cmd window, type memchached.exe -d start
	PHP EXTENSION:
	a. once again, like how we deal with MONGODB, check the phpinfo to get the VERSION info and download relative php_memchache.dll file.
	b. put this php_memcache.dll file into ext folder(php extention folder)
	c. set the php.ini file and add a new dll(php_memchache.dll).
	d. restart Apache service.

