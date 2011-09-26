# Installation

## Download and Extract Script

You can obtain the lastest release from [github repository](https://github.com/JiLiZART/w3ghstats)
the files are available in .tar.gz and .zip formats and can be extracted using most compression tools.

To download and extract the files, on a typical Unix/Linux command line, 
use the following commands:

	wget https://github.com/JiLiZART/w3ghstats/tarball/master
	mv master w3ghstats.tgz
	tar -zxvf w3ghstats.tgz
	cd w3ghstats
	mkdir assets
	mkdir app/runtime
	chmod 775 assets
	chmod 775 app/runtime
	chmod 775 app/framework/zii/widgets/assets/

## Database setup

You can edit configuration in path/to/w3ghstats/app/config/web.php 
fill 'title' and 'connectionString', 'user', 'password' in db section of array, 

	
	'db'=>array(
		'connectionString' => 'mysql:host=localhost;dbname=dos',
		'emulatePrepare' => true,
		'enableProfiling' => true,
		'username' => 'root',
		'password' => '1234',
		'charset' => 'latin1',
	),
		
also you can edit params in 'params' section
	
	'params'=>array(
		'dateFormat'=>'d.m.Y H:i',
		'newsPerPage'=>10,
		'gamesPerPage'=>10,
		'heroesPerPage'=>10,
		'bansPerPage'=>10,

		'heroGameHistoryPerPage'=>10,

		'showItemsMostUsedByHero'=>true,
		'showAllSlotsInGame' => true,
		'minPlayedRatio'=> '0.8',

		'headAdmin'=>'JiLiZART',
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),

If you don't have a ghost database, you can create it
on Linux/Unix command line, use the following commands:

	mysql -uYOUR_USER -pYOUR_PASSWORD

you will be entered in mysql shell, now type

	CREATE DATABASE `databasename`;

and hit ENTER, you will see:

	Query OK, 0 rows affected (0.13 sec).
    
quit and ENTER.

Import install.schema.sql into your database on Linux/Unix command line, use the following commands:

	mysql -uYOUR_USER -pYOUR_PASSWORD YOUR_DATABASE < install.schema.sql


