<?php

namespace spimpolari\LaravelSimplyGrid\Support;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Collection;

/**
 * Class SimplyTable
 * @package spimpolari\LaravelSimplyGrid\Support
 */
class SimplyTable {

	public $hasOrderColumn = false;
    /**
     * array of header fields
     * @var array
     */
    protected $header = [];

    /**
     * table caption
     * @var string
     */
    protected $caption = '';

    /**
     * anonimous function for field
     * @var anonymous function
     */
    protected $anon = null;

    /**
     * list of field name
     * @var array
     */
    protected $fields = [];

    /**
     * Data Collection
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $data = null;


    /**
     * Mark row as customField row
     * @var array
     */
    protected $customField = [];

    /**
     * @var null
     */
    protected $customRow = null;

    /**
     * @var null
     */
    protected $customAction = null;

    /**
     * css clas
     * @var string
     */
    protected $css = '';


    /**
     * as buttton link or radio
     * @var boolean
     */
    protected $action = null;

    /**
     *
     */
    protected $buttons = null;

    /**
     * primary key
     * @var string
     */
    protected $primaryKey = null;

    /**
     * @var array
     */
    protected $dataTableOptions = [];
	
	/**
	 * @var array
	 */
    protected $ordering = null;


    /**
     * 
     * @param string $tableName table name
     */
    public function __construct($tableName)
    {
        $this->id = $tableName;
    }

    /**
     * @param array $header
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setHeader(array $header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param $caption
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setCaption(string $caption)
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @param $css
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setCSS($css)
    {
        $this->css = $css;
        return $this;
    }

    /**
     * @param $id
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setPrimaryKey($id = 'id')
    {
        $this->primaryKey = $id;
        return $this;
    }

    /**
     * @param $fields
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param $data
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setData(Collection $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param $row
     * @param $option
     * @param $config
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setCustomField($row, $option, $config = null)
    {
        if($option === 'anon' || $option === 'morph') {
            $this->anon[$row] = $config;
            $this->customField[$row] = array($option);
        } else {
            $this->customField[$row] = array($option, $config);
        }
        return $this;
    }

    /**
     * @param $config
     */
    public function setCustomRow($config)
    {
        $this->customRow = $config;

        return $this;
    }


    /**
     * @param $config
     */
    public function setCustomAction($config)
    {
        $this->customAction = $config;

        return $this;
    }

    /**
     * @param $action
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;

    }

    /**
     * @param $action
     * @param $key
     * @param $string
     * @param $class
     * @param string $description
     * @return $this
     */
    public function setButton($action, $key, $string, $class, $description = '')
    {
        $this->buttons[] = ['action' => $action, 'key' => $key, 'string' => $string, 'class' => $class, 'description' => $description];
        return $this;
    }

    /**
     * @param $option
     * @param $value
     */
    public function setDataTableOptions($option, $value)
    {
        $this->dataTableOptions[$option] = $value;
    }

    /**
     * @return array
     */
    public function getDataTableOptions()
    {
        return $this->dataTableOptions;
    }
	
	/**
	 * @return null
	 */
    public function getButton()
    {
    	return $this->buttons;
    }
    
    public function getHeader()
    {
    	return $this->header;
    }
	
	/**
	 * @param $orderUpRoute
	 * @param $orderDownRoute
	 * @param $fieldName
	 */
    public function setOrderField($orderUpRoute, $orderDownRoute, $fieldId, $order_column = 'order_column' )
    {
    	$this->ordering['upRoute'] = $orderUpRoute;
    	$this->ordering['downRoute'] = $orderDownRoute;
    	$this->ordering['fieldId'] = $fieldId;
	    $this->ordering['orderColumn'] = $order_column;
	    $this->hasOrderColumn = true;
	    
	    return $this;
    }

    
    /**
     * @return string
     */
    public function __toString ()
    {
        return $this->render ();
    }

    /**
     * @return string
     */
    public function render()
    {

        $list_view_var = [
            'data'=>$this->data,
            'fields'=>$this->fields,
            'header'=>$this->header,
            'caption'=>$this->caption,
            'table_css'=>$this->css,
            'table_id'=>$this->id,
            'customField'=>$this->customField,
            'action'=>$this->action,
            'primaryKey'=>$this->primaryKey,
            'anon'=>$this->anon,
            'buttons'=>$this->buttons,
            'customRow'=>$this->customRow,
            'customAction'=>$this->customAction,
	        'ordering' => $this->ordering

        ];


        return View::make('SimplyGrid::DataTableGrid', $list_view_var )->render();

    }
}