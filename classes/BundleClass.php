<?php

class BundleClass {

	var $name;
	var $tpl;
	var $gridster_width;
	var $gridster_height;
	var $data;

	// Create a plugin with a size of bootstrap lg-col
	public function __construct($name, $width, $height, $tpl, $data)
	{
		
		$this->data = $data;
		$this->tpl = $tpl;
		$this->gridster_width = $width;
		$this->gridster_height = $height;
		$this->name = $name;	

	}

	public function getBuffer()
	{
		global $smarty;
		$smarty->assign('name', $this->name);
		$smarty->assign('width', $this->gridster_width);
		$smarty->assign('height', $this->gridster_height);
		$smarty->assign($this->data);
		return $smarty->fetch('views/'.$this->tpl);
	}

	public function getID()
	{
		return $this->name;
	}

	public function getWidth()
	{
		return $this->gridster_width;
	}

	public function getHeight()
	{
		return $this->gridster_height;
	}
}

