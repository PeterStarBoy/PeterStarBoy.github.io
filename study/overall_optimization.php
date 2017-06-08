<?php
/*
-------------------PHP APPLICATION CONSTRUCTION---------------
			first part: JS/CSS/IMAGES
			second part: PHP codes
			(1). best php coding.
			(2). Opcode cache
			(3). variable/data cache
			third part: database
			forth part: web service
			fifth part: operation system
******EVERY PART OF THIS LIST CAN BE OPTIMIZED********
--------------------OVERALL TEST------------------------
******APACHE BENCHMARK*****
(1). how to install apache benchmark, when you install apache web server, you install AB.
(2). how to run AB, open CMD command window or shell terminal, go directly to the apache/bin dirtory.
	 then type ab ......some command codes....
(3). result analysis.




-------------------IMAGES/JS/CSS OPTIMIZATION-----------------
(1). CSS PART
a. put the css style file in the top of the hmtl.
b. avoid some kind of css expression.
c. simplify css file.
(2). IMAGE PART
a. use images' original size, not set it in code.
b. collect all the images in a big picture, use sprite, it can reduce the images need to be loaded.
c. normal rules for images: icon and little images using gif format, high quality images using jpeg format, and all other iamges using png format.
d. using compressing tool SMUUSH.IT to compress images.
(3). JAVASCRIPT OPTIMIZATION
a. put the js code at the bottom of all code.
b. simplify js code.
c. set js code as a outer file and import it to the html.
d. combine all js code in one js file, make sure the code ordered correctly.
e. js file can be compressed twice, one is simplify, another is server compression via Gzip.
---------------------PHP CODE OPTIMIZATION---------------------
(1). require is faster than require_once, cos it's less function used, but we need to know the overall code construction to avoid duplicate importing.
(2). using certain loop times instead of expression.
e.g. 
	$list = array(1,2,3,4,5,6,7,8,9,10);
	for ($i = 0; $i < count($list), $i++) 
	{
		....some code....
	}
	*****it's better coding this way:
	$list = array(1,2,3,4,5,6,7,8,9,10);
	$count = count($list);
	for ($i = 0; $i< $count; $i++) 
	{
		.....some code......
	}
	according to logical check we can tell it's only count one time in the 2ed code but 10 times in the 1st code.
(3). foreach is the fasest loop function, then while, then for.
(4). when opening a file, you can choose different open method according filesize:
	if (filesize < 100kb) using fopen & fread is a better way.
	if (filesize > 1M) using file_get_contents is a better way.