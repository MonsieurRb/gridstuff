<?php


require_once "E:\wamp\bin\smarty\libs\Smarty.class.php";
require_once "E:\wamp\www\classes\PluginClass.php";
require_once "E:\wamp\www\\functions.inc.php";

$smarty = new Smarty();

$smarty->setTemplateDir('E:\wamp\bin\smarty\smarty\templates');
$smarty->setCompileDir('E:\wamp\bin\smarty\smarty\templates_c');
$smarty->setCacheDir('E:\wamp\bin\smarty\smarty\cache');
$smarty->setConfigDir('E:\wamp\bin\smarty\smarty\configs');



$id_employee = 2;
$plugins = array();

for ($i=1; $i<=6; $i++) {
	$name = 'pluginN'.$i;
	$plugins []= $name();
}

$smarty->assign('id_employee', $id_employee);
$smarty->assign('plugins', $plugins);
$smarty->display('views/menu.html');
