<?php
/*
-------------------INSERTING MEDIA PLAYER TO YOUR HTML PAGE---------------------
******here we take REALPLAYER as example******
(1). your need to download the player and install it in your computer.
(2). let's go straight to the html code, if you want to add a player, add the code below.
-----CODE AREA-----
********this is the player code**********
******param is player's config settings******
******src in the embed tag is the video source url********
		<object classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" name="rp1" width="475" height="375" id="rp1">
			  <param name="_extentx" value="12000">
              <param name="_extenty" value="7500">
              <param name="shuffle" value="0">
              <param name="nolabels" value="0">
              <param name="autostart" value="-1">
              <param name="prefetch" value="0">
              <param name="controls" value="imagewindow">
              <param name="console" value="clip1">
              <param name="loop" value="0">
              <param name="numloop" value="0">
              <param name="center" value="0">
              <param name="maintainaspect" value="0">
              <param name="backgroundcolor" value="#000000">
              <param name="src" value="__HSRC__/Video/one.3gp">
		<embed src="__HSRC__/Video/one1.3gp" type="audio/x-pn-realaudio-plugin" console="Clip1" controls="ImageWindow" height="375" width="475" >
        </embed>
		</object>
***********this is the control pad code************
		<object classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" name="rp2" width="475" height="60" id="rp2">
			  <param name="_extentx" value="12000">
              <param name="_extenty" value="1500">
              <param name="shuffle" value="0">
              <param name="nolabels" value="0">
              <param name="autostart" value="-1">
              <param name="prefetch" value="0">
              <param name="controls" value="controlpanel,statusbar">
              <param name="console" value="clip1">
              <param name="loop" value="0">
              <param name="numloop" value="0">
              <param name="center" value="0">
              <param name="maintainaspect" value="0">
              <param name="backgroundcolor" value="#000000">
		 	 <embed width="475" height="60" controls="ControlPanel" console="Clip1" type="audio/x-pn-realaudio-plugin" >
             </embed>
		</object>