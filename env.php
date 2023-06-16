<?php
defined('env') OR exit('Akses langsung ke skrip ini diblokir');

$setDB['db_host']= '127.0.0.1';
$setDB['db_name']= 'webgis';
$setDB['db_user']= 'root';
$setDB['db_password']= '';

//folder templates
$template='templates/AdminLTE-3.1.0/';

//session
$setSession['prefix']= 'WEBGIS-TA';

//URI
$setUri['base']='http://localhost/webgis-ta/';
$setUri['asset']='assets/';