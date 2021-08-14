<?php
require 'environment.php';

// visualização de erros
ini_set('display_errors', 'on');

// seta data e horario para portugues
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo'); 

// configuração banco de dados
$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/maisdigital/");
	$config['dbname'] = 'maisdigital';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'lucas1231';
} else {
	define("BASE_URL", "http://localhost/psr/psr-4-mvc/");
	$config['dbname'] = 'mvc_psr4';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";charset=utf8;host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}

define("MAIL", [
    "from" => "maisdigitalcertificado@gmail.com",
    "port" => "",
    "user" => "",
    "passwd" => "",
]);