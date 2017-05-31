<?php
	/*PETER!!!YOU'RE THE BEST, KEEP ON IT, BE YOURSELF!!!
	----------------------here we showing some git command---------------------
	(1). COMMAND FOR COMMITING
	A. git status (SHOW CURRENT FILE TRACE STATEMENT)
	B. git add FILENAME(INCLUDING FULL FILEPATH ACCORDING TO .git FILE)
	C. git commit -m "UPLOAD COMMENT"
	D. git push origin master (PUSH TO MAIN REPOSITORY)
	(2). COMMAND FOR GENERATING SSHKEY
	A. ssh-keygen -t -rsa -C "EMAIL ADDRESS"
	B. ssh-add ~/.ssh/NEW NAME(only read id_rsa by default)
	   IF IT SAYS count not open a connection to your authentication agent
	   TRY THIS: ssh-agent bash;  ssh-add ~/.ssh/NEW NAME
	(3). COMMAND FOR SET REMOTE ADDRESS
	A. git remote add NAME GITSITE (add)
	B. git remote rm NAME (delete)
	C. git remote rename OLD_NAME NEW_NAME
	(4). COMMAND FOR GIT VIM EDITOR
	A. get out from it, shift+;, then q! or qw!
	B. same commands as linux

	-------------------ADD NEW SSH KEY AND REPOSITORY---------------
	(1). PREPARATION: NEW GITHUB REPOSITORY, GENERATE A NEW SSH KEY.
	(2). DEPLOY THE SSH KEY TO THE NEW REPOSITORY.
	(3). SET THE ~/.ssh/config FILE, ADD A NEW HOST INFO GROUP.
	(4). INIT THE GIT BASH IN THE TARGET DIRECTORY AND RUN IT.
	(5). TYPE COMMAND AS FOLLOWING IN THE GIT BASH WINDOW.
	a. ssh-agent bash
	b. eval 'ssh-agent -s'
	c. ssh-add ~/.ssh/NEW_RSA_KEY_NAME
	d. ssh -T NEWHOSTNAME
	IF THE GIT FEEDBACK IT'S LIKE (Hi PeterStarBoy/Work_collection! You've successfully authenticated, but GitHub does not provide shell access.). IT WORKS.
	(6). SET THE GIT REMOTE ADDRESS BY USING COMMAND: 
	   git remote add NAME GIT_ADDRESS(the prefix is your new host name)
	(7). REBASE THE REPOSITORY:
	   git pull --rebase NAME master
	(8). WORK AS NORMAL.