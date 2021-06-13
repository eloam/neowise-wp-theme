<?php

namespace NwComponents;

use NwComponents\Utilities;
use NwComponents\Enums\ShadowMode;

class Options {

    private $componentsDirectoryPath;
    private $useShadowDom;
    private $shadowMode;

    public function __get($property) {
        if ($property == 'componentsDirectoryPath') { return $this->componentsDirectoryPath; } else
        if ($property == 'useShadowDom')            { return $this->useShadowDom; }   else
        if ($property == 'shadowMode')              { return $this->shadowMode; }
    }

    function __construct(string $componentsDirectoryPath = null, bool $useShadowDom = null, string $shadowMode = null) {
        $this->componentsDirectoryPath = ($componentsDirectoryPath ?? 'components');
        $this->useShadowDom = ($useShadowDom ?? false);
        $this->shadowMode = ($shadowMode ?? ShadowMode::closed);

        $this->init();
    }

    function init() {
        if (!Utilities::relativePathExists($this->componentsDirectoryPath)) {
            throw new Exception('The components path doesn\'t exists.');
        }
    }
}