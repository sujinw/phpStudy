<?php 
$link = @mysql_connect( $_config['db']['dbhost'], $_config['db']['dbuser'], $_config['db']['dbpwd'] ) or die( '连接数据库失败：'.mysql_error() );
mysql_select_db( $_config['db']['dbname'] );
mysql_query( 'SET names'.$_config['db']['dbcharset'] ); 

?>