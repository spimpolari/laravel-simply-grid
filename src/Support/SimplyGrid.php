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
    public function renderJS()
    {
    	$option = '';
        $render = '<script type="text/javascript">'."\n";

        foreach ($this->table as $tableName => $object) {
        	/** @var  \spimpolari\LaravelSimplyGrid\Support\SimplyTable $object */
	        $options = $object->getDataTableOptions();
	        
            if (count($options) > 0) {
                $option = '{';
	            $option_datatable = '';
                foreach ($options as $key => $val) {
                	switch ($val) {
		                case '[]':
		                case 'false':
		                case 'true':
		                case is_numeric($val):
		                    $option_datatable .= '"' . $key . '":' . $val . ',';
	                        break;
		                default:
	                        $option_datatable .= '"' . $key . '":"' . $val . '",';
	                        break;
	                }
                }
	            $option_datatable = substr( $option_datatable, 0, strlen($option_datatable) - 1);
	
                //debugbar()->addMessage($object->getButton());
	            if(count($object->getButton()) > 0) {
					$option_datatable .= ', "columnDefs":[{"orderable":false, "targets":'.(count($object->getHeader()) + (($object->hasOrderColumn) ? 1 : 0) )
					                     .'}'
					                     .(($object->hasOrderColumn) ? ', {"orderable":false, "targets":0}' : '')
					                     .']';
	            }
                $option .=  $option_datatable . '}';
            } else {
             
	            if(count($object->getButton()) > 0) {
		            $option .= '{"columnDefs":[{"orderable":false, "targets":'.(count($object->getHeader()) + (($object->hasOrderColumn) ? 1 : 0) )
		                                 .'}'
		                                 .(($object->hasOrderColumn) ? ', {"orderable":false, "targets":0}' : '')
		                                 .']}';
	            }
            }
            
            

            $render .= '$(function(){$("#' . $tableName . '").DataTable(' . $option . ');});'."\n";
            $option_datatable = '';
            $option = '';
        }

        return $render.'</script>'."\n";
    }

    
    
    
}