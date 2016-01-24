<?php


require_once "E:\wamp\bin\smarty\libs\Smarty.class.php";
require_once "E:\wamp\www\classes\BundleClass.php";
require_once "E:\wamp\www\classes\GridClass.php";
require_once "E:\wamp\www\\functions.inc.php";

$smarty = new Smarty();

$smarty->setTemplateDir('E:\wamp\bin\smarty\smarty\templates');
$smarty->setCompileDir('E:\wamp\bin\smarty\smarty\templates_c');
$smarty->setCacheDir('E:\wamp\bin\smarty\smarty\cache');
$smarty->setConfigDir('E:\wamp\bin\smarty\smarty\configs');



$id_employee = 2;
$bundles = array();

for ($i=1; $i<=6; $i++) {
	$name = 'pluginN'.$i;
	$bundles []= $name();
}

if (is_file('conf/conf_'.$id_employee.'.json'))
	$json_gridster = file_get_contents('conf/conf_'.$id_employee.'.json');
else
	if (is_file('conf/conf_'.$id_employee.'.json')) {
		/* Use the default json */
		$json_gridster = file_get_contents('conf/default.json');
	} else {
		/* Create default json */
		GridClass::createDefaultGrid($bundles, 'conf/default.json');
		$json_gridster = file_get_contents('conf/default.json');
	}


$grid = new GridClass($json_gridster);


$smarty->assign('grid', $grid->getGrid());
$smarty->assign('id_employee', $id_employee);
$smarty->assign('bundles', $bundles);


$smarty->display('views/menu.html');
