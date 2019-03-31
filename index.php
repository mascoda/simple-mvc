<?
require __DIR__ . '/globals/header.php';
require __DIR__ . '/globals/settings.php';
require __DIR__ . '/vendor/autoload.php';

$page = new HM\MVC($_SERVER["SCRIPT_URL"]);

#var_dump($page);

if ($page->view === false) : header('Location: '.'/404'); endif; 

require($page->controller);	
require($page->template); 