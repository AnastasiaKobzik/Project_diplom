<?php
$host = '127.0.0.1';
$database = 'bakecake';
$user = 'mysql';
$password = 'mysql';
$salt = md5(1231);
$charset = 'utf8';
global $dbLink;

$dbLink = mysqli_connect($host, $user, $password, $database) or die ("Ошибка".mysqli_error($link));
if(!$dbLink->set_charset($charset)){
	echo "Ошибка установки кодировки UTF8";
}
?>