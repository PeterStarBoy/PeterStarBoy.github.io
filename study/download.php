<?php
/*
---------------------DOWNLOAD CODES----------------------
LOGICAL TREE:
(1). first you need to make sure the acutal directory of the target file.
(2). then you need to make sure the file exists and it's not empty, certainlly you can use FILE_EXISTS() & FILESIZE system functions to check it.
(3). then everything is ready, we set the headers.
HEADER SETTINGS:
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=" . $filename);
	header("Content-size: " . filesize($filename));
	opt: header("Accept-ranges: bytes");
(4). readfile($file);