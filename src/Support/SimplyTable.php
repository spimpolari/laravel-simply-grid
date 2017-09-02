<?php

namespace spimpolari\LaravelSimplyGrid\Support;

use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Collection;

/**
 * 
 */
class SimplyTable {

    /**
     * array of header column
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
     * @var anonimous function
     */
    protected $anon = null;

    /**
     * list of field name
     * @var array
     */
    protected $column = [];

    /**
     * Data Collection
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $data = null;


    /**
     * Mark row as special row
     * @var array
     */
    protected $special = [];

    /**
     * css clas
     * @var string
     */
    protected $css = '';

    /**
     * id html property
     * @var string
     */
    protected $id = '';

    /**
     * as buttton link or radio
     * @var boolean
     */
    protected $action = false;

    /**
     * primary key
     * @var string
     */
    protected $primaryKey = 'id';

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
    public function setHeader(array $header) {
        $this->header = $header;
        return $this;
    }

    /**
     * @param $caption
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setCaption(string $caption) {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @param $css
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setCSS($css) {
        $this->css = $css;
        return $this;
    }

    /**
     * @param $id
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setID($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $column
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setColumn($column) {
        $this->column = $column;
        return $this;
    }

    /**
     * @param $data
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setData(Collection $data) {
        $this->data = $data;
        return $this;
    }

    /**
     * @param $row
     * @param $option
     * @param $config
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setSpecial($row, $option, $config = null)
    {
        if($option === 'anon') {
            $this->anon = $config;
            $this->special[$row] = array($option);
        } else {
            $this->special[$row] = array($option, $config);
        }
        return $this;
    }

    /**
     * @param $action
     * @return \spimpolari\LaravelSimplyGrid\Support\SimplyTable
     */
    public function setAction($action) {
        $this->action = $action;
        return $this;

    }

    /**
     * @return string
     */
    public function __toString () {
        return $this->render ();
    }

    /**
     * @return string
     */
    public function render() {

        $list_view_var = [
            'data'=>$this->data,
            'column'=>$this->column,
            'header'=>$this->header,
            'caption'=>$this->caption,
            'table_css'=>$this->css,
            'table_id'=>$this->id,
            'special'=>$this->special,
            'action'=>$this->action,
            'primaryKey'=>$this->primaryKey,
            'anon'=>$this->anon
        ];


        return (string) View::make('SimplyGrid::DataTableGrid', $list_view_var )->render();

    }
}