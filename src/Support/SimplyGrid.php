<?php

namespace spimpolari\LaravelSimplyGrid\Support;

use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Collection;
use spimpolari\LaravelSimplyGrid\Support\SimplyTable;

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
	 * @return \spimpolari\LaravelSimplyGrid\Support\SimplyGrid        
	 */
	public function newTable($tableName)
	{
		return $this->table[$table] = new SimplyTable($tableName);
	}

	/**
	 * get table
	 * @param  string $tableName 
	 * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
	 */
	public function getTable($tableName)
	{
		if(isset($this->tabel[$tableName])) {
			return $this->table[$tableName];
		} else {
			throw new Exception("Table not Found, you need to create first", 1);
		}
	}

	/**
	 * [setTable description]
	 * @param SimplyGrid $table     [description]
	 * @param [type]     $tableName [description]
	 */
	public function setTable(SimplyTable $table, $tableName) {
		return $this->table[$tableName] = $table;
	}

}