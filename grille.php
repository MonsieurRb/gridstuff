<?php


require_once "E:\wamp\bin\smarty\libs\Smarty.class.php";
require_once "E:\wamp\www\classes\BundleClass.php";
require_once "E:\wamp\www\\functions.inc.php";

$smarty = new Smarty();

$smarty->setTemplateDir('E:\wamp\bin\smarty\smarty\templates');
$smarty->setCompileDir('E:\wamp\bin\smarty\smarty\templates_c');
$smarty->setCacheDir('E:\wamp\bin\smarty\smarty\cache');
$smarty->setConfigDir('E:\wamp\bin\smarty\smarty\configs');

$id_employee = 1;

/* Load bundles */
$bundles = array();
for ($i=1; $i<=6; $i++) {
	$name = 'pluginN'.$i;
	$bundles []= $name();
}

/* Load default json */
if (is_file('conf/conf_'.$id_employee.'.json'))
	$smarty->assign('json_gridster', file_get_contents('conf/conf_'.$id_employee.'.json'));
else
	$smarty->assign('json_gridster', '');

$smarty->assign('id_employee', $id_employee);
$smarty->assign('bundles', $bundles);
$smarty->display('views/grille.html');
