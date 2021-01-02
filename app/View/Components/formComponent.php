<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */


    public $titleCard ;
    public $models ;
    public $dataform ;
    public $select ;

    public function __construct($titleCard, $models, $dataform, $select)
    {
        $this->titleCard = $titleCard;
        $this->models = $models;
        $this->dataform = $dataform;
        $this->select = $select;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-component');
    }
}
