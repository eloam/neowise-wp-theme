<?php

namespace NwComponents;

use NwComponents\Options;
use NwComponents\ComponentInfo;
use NwComponents\LazyComponent;
use NwComponents\Component;
use NwComponents\Loader;

class NwComponents {   

    private static $version = '1.0.0';
    private static $options;

    public function __get($property) {
        if ($property == 'version') { return $this->version; }
    }

    public function __construct(string $componentsDirectoryPath = null, bool $useShadowDom = null, string $shadowMode = null) {
        self::setOptions($componentsDirectoryPath, $useShadowDom, $shadowDom);
        self::init();  
    }

    private static function init() {
        if (!defined('NWCOMPONENTS_LOADED')) {
            self::$options ?? self::$options = new Options();
            class_alias('NwComponents\NwComponents', 'NwComponents');
            define('NWCOMPONENTS_LOADED', true);
        }
    }

    public static function getOptions() {
        return self::$options;
    }

    public static function setOptions(string $componentsDirectoryPath = null, bool $useShadowDom = null, string $shadowMode = null) {
        self::$options = new Options($componentsDirectoryPath, $useShadowDom, $shadowMode);
        return self::$options;
    }

    public static function prepare(string $path, array $data = array(), bool $throwErrors = false) {
        $componentInfo = new ComponentInfo($path, self::$options, $throwErrors);
        return new LazyComponent($componentInfo, $data);
    }

    public static function call(string $path, array $data = array(), bool $throwErrors = false) {
        $lazyComponent = self::prepare($path, $data, $throwErrors);
        self::load($lazyComponent);
    }

    public static function load(LazyComponent $component) {

        // Init
        self::init();

        // Loader
        $loader = Loader::context();
        $loader->resolve($component);
    }


}