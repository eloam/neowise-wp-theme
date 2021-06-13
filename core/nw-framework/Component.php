<?php

namespace NwComponents;

use NwComponents\LazyComponent;
use NwComponents\ComponentInfo;

class Component extends LazyComponent {

    protected $viewData;

    public function __get($property) {
        if ($property == 'viewData') {
            return $this->viewData;
        }
    }

    public function __set($property, $value) {
        if ($property == 'viewData') {
            if (is_array($value)) {
                $this->viewData = $value;
            } else {
                throw new \Exception('This value must be an array.');
            }
        }
    }

    public function __construct(ComponentInfo $componentInfo, array $data = array()) {
        parent::__construct($componentInfo, $data);
        
        $this->viewData = array();
        
        $this->init();
        $this->render();
    }

    protected function init() {

    }

    protected function render() {
        throw new \Exception('Not implemented.');
    }
}