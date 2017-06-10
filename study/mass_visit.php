<?php
/*--------------methods to deal with massive visit------------------
(1). BULID UP HIGH QUALITY SERVER.
	related hardware: internet/disk read & write speed/capacity of memories/CPU addressing speed.
(2). DATABASE OPTIMIZATION
	a.datebase with perfect structure.
	b.avoid '*' in query sentence and child query, add index to active fields.
	c.mysql server installed in Linux OS.
	d.recommend nginx web server in massive visits.
	e.close unnecessary PHP modules.
	f.using memcache.
	g.using GZIP compressing method to optimize site content.
(3).forbiden outer images/file cheeting, set config in Apache.
(4).control big file downloading, avoid file (filesize more than 2M) downloading, if have to, put all big file in another server.
(5).using different host to split the stream.
(6).using stream analysis software: install a stream analysis software to check where take too much stream and which page need to be optimized. (Google Analytics).
