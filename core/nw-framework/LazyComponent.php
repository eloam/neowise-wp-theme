<?php

namespace NwComponents;

use NwComponents\ComponentInfo;

class LazyComponent {

    protected $info;
    protected $data;

    public function __get($property) {
        if ($property == 'info') {
            return $this->info;
        } else if ($property == 'data') {
            return $this->data;
        }
    }

    public function __construct(ComponentInfo $componentInfo, array $data = array()) {
        $this->info = $componentInfo;
        $this->data = $data;
    }
}