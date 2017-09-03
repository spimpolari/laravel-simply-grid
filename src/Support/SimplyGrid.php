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
	 * @var array \spimpolari\LaravelSimplyGrid\Support\SimplyTable
	 */
	protected $table = [];

    /**
     * array of option
     *
     * @var array
     */
	protected $options = [];
	/**
	 * Create a new Data Table
	 * @param  string $tableName tableName
	 * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
	 */
	public function newTable($tableName)
	{
		return $this->table[$tableName] = new SimplyTable($tableName);
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
	public function setTable(SimplyTable $table, $tableName)
    {
		return $this->table[$tableName] = $table;
	}

    /**
     * @param $tableName
     */
    public function renderJS($tableName)
    {
        $options = $this->table[$tableName]->getDataTableOptions();

        if(count($options)>0) {
            $option = '{';
            foreach ($options as $key => $val) {
                $option = '"'.$key.'":"'.$val.'"';
            }
            $option = $option . '}';
        } else {
            $option = '';
        }

        $render = '<script type="text/javascript">$(function(){$("#'.$tableName.'").DataTable('.$option.');});</script>';

        return $render;
    }

}