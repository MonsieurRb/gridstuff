<?php

class GridClass
{
	var $grid_data = array();
	var $grid = array();

	public function __construct($json)
	{
		$this->grid_data = (array)json_decode($json);	
	}

	public function compare($elemA, $elemB)
	{
		if ($elemA->row < $elemB->row)
			return -1;
		if ($elemA->row > $elemB->row)
			return 1;
		if ($elemA->col < $elemB->col)
			return -1;
		return 1;
	}

	public function getInsideDiv($boundaries, $id_tab)
	{
		$tab = array();
		for ($i = $id_tab+1; $i < count($this->grid_data); $i++) {
			if (!isset($this->grid_data[$i]->done) 
				&& $this->grid_data[$i]->row == $boundaries['row_start'] 
				&& $this->grid_data[$i]->col >= $boundaries['col_start'] 
				&& ($this->grid_data[$i]->col+$this->grid_data[$i]->size_x-1) <= $boundaries['col_end']) 
				$tab []= $i;
		}
		return $tab;
	}

	public function generate($id_tab, $boundaries)
	{
		if ($id_tab >=0) {
			$this->grid_data[$id_tab]->done = 1;
			$virtual_size = $this->grid_data[$id_tab]->size_x * 12 / $boundaries['relative_size'];
			$this->grid []= '<div class="col-lg-'.$virtual_size.'" id="bundle_'.$this->grid_data[$id_tab]->id.'">';
			$this->grid []= '</div>';
		
			//Definir Boundaries
			$new_boundaries = array('row_start' => $boundaries['row_start'] + $this->grid_data[$id_tab]->size_y, 
									'col_start' => $this->grid_data[$id_tab]->col, 
									'col_end' => $this->grid_data[$id_tab]->size_x + $this->grid_data[$id_tab]->col - 1,
									'relative_size' => $boundaries['relative_size'] * $virtual_size / 12);
		} else {
			$new_boundaries = $boundaries;
		}

		$tab = $this->getInsideDiv($new_boundaries, $id_tab);

		//Voir si les bundles sont dedans
		foreach($tab as $id_item) {
			if (count($tab) > 1) {
				$relative_size = $this->grid_data[$id_item]->size_x * 12 / $new_boundaries['relative_size'];
				$this->grid []= '<div class="col-lg-'.$relative_size.'">';
				$tmp = $new_boundaries['relative_size'];
				$new_boundaries['relative_size'] = $relative_size;
			}
			$this->generate($id_item, $new_boundaries);
			if (count($tab) > 1) {
				$new_boundaries['relative_size'] = $tmp;
				$this->grid []= '</div>';
			}
		}

		if ($id_tab == -1)
			for ($j=$id_tab+1; $j<count($this->grid_data); $j++) {
				if (!isset($this->grid_data[$j]->done)) {
					$this->grid []= '<div class="row">';
					$this->generate($j, $new_boundaries);
					$this->grid []= '</div>';
				}
			}
	}

	public function getGrid()
	{
		global $smarty;

		usort($this->grid_data, array('GridClass', 'compare'));

		$boundaries = array('row_start' => 1, 'col_start' => 1, 'col_end' => 12, 'relative_size' => 12);
		$this->generate(-1, $boundaries);
		
		$smarty->assign('grid_data', $this->grid_data);
		$smarty->assign('grid_div', $this->grid);
		return $smarty->fetch('views/original_grid.html');

	}

	public static function createDefaultGrid($bundles, $filename)
	{
		$tab = array();
		$row_init = 1;
		foreach ($bundles as $bundle) {
			$x = new stdClass();
			$x->id = $bundle->getID();
			$x->col = 1;
			$x->row = $row_init;
			$x->size_x = $bundle->getWidth();
			$x->size_y = $bundle->getHeight();
			$row_init += $x->size_y;
			$tab []= $x;
		}
		file_put_contents($filename, json_encode($tab));
	}

}