<?php
/*
-----------------------THINKPHP TIPS-------------------------------
(1). when you make a page split function, if there are parameters need to be passed, we assume the parameters collected in a array named data, so we can set data to $page -> paramater.
	IT MEANS: $page -> parameter = $data(array);
(2). when you use if tag in the htmlpage, please use $example['xxx'] instead of $example.xxx, ortherwise it will not be analysed