<?php

function pluginN1()
{
	$obj = new BundleClass('PluginA', 6, 1, 'bundle_test.html', array('user_name' => 'Reno A', 'color' => 'red', 'height' => 100));
	return $obj;
}

function pluginN2()
{
	$obj = new BundleClass('PluginB', 12, 5,'bundle_test.html', array('user_name' => 'Reno B', 'color' => 'orange', 'height' => 300));
	return $obj;
}

function pluginN3()
{
	$obj = new BundleClass('PluginC', 6, 2, 'bundle_test.html', array('user_name' => 'Reno C', 'color' => 'yellow', 'height' => 150));
	return $obj;
}

function pluginN4()
{
	$obj = new BundleClass('PluginD', 6, 3, 'bundle_test.html', array('user_name' => 'Reno D', 'color' => 'green', 'height' => 200));
	return $obj;
}

function pluginN5()
{
	$obj = new BundleClass('PluginE', 6, 4, 'bundle_test.html', array('user_name' => 'Reno E', 'color' => 'blue', 'height' => 250));
	return $obj;
}

function pluginN6()
{
	$obj = new BundleClass('Customer', 6, 12, 'bundle_personal.html', array());
	return $obj;
}