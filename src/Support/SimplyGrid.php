<?php

namespace spimpolari\LaravelSimplyGrid\Support;

use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Collection;
use spimpolari\LaravelSimplyGrid\Support\SimplyGrid;

/**
 * 
 */
class SimplyGrid {

	/**
	 * array of table
	 * @var array
	 */
	protected $table = [];

	/**
	 * Create a new Data Table
	 * @param  string $tableName tableName
	 * @return [type]            [description]
	 */
	public function newTable($tableName)
	{
		return $this->table[$table] = new SimplyGrid($tableName);
	}

	public function getTable($tableName)
	{
		if(isset($this->tabel[$tableName])) {
			return $this->table[$tableName];
		} else {
			throw new Exception("Table not Found, you need to create first", 1);
		}
	}

	public function setTable(SimplyGrid $table, $tableName) {
		return $this->table[$tableName] = $table;
	}

}