<?php

switch ($_REQUEST['type']) 
{
	case 'PostData':
		file_put_contents('conf/conf_'.$_REQUEST['id_employee'].'.json', $_REQUEST['gridster_data']);
		break;
	case 'GetData':
		echo file_get_contents('conf/conf_'.$_REQUEST['id_employee'].'.json');
		break;
}
