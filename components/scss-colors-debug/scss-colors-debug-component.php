<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class ScssColorsDebugComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();
        $this->context['colors'] = array(
            'primary', 
            'secondary', 
            'black', 
            'white', 
            'light', 
            'dark', 
            'bluegray-100', 
            'bluegray-200', 
            'bluegray-300', 
            'bluegray-400', 
            'bluegray-500', 
            'bluegray-600', 
            'bluegray-700', 
            'bluegray-800', 
            'bluegray-900', 
            'gray-050', 
            'gray-100', 
            'gray-150', 
            'gray-200', 
            'gray-250', 
            'gray-300', 
            'gray-350', 
            'gray-400', 
            'gray-450', 
            'gray-500', 
            'gray-550', 
            'gray-600', 
            'gray-650', 
            'gray-700', 
            'gray-750', 
            'gray-800', 
            'gray-850', 
            'gray-900', 
            'gray-950'
        );
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}