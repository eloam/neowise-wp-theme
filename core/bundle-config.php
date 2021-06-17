<?php

class BundleConfig {

    function __construct() {
        // Importation de tous les assets du thème
        add_action('wp_enqueue_scripts', [$this, 'bundleConfig']);
    }

    public function bundleConfig() {
        $this->addBundleJS();
        $this->addBundleCSS();
    }

    private function addBundleJS() {
        // jQuery
        wp_deregister_script('jquery'); // Supprime le script jquery.js que wordpress utilise

        // jQuery Migrate
        wp_deregister_script('jquery-migrate'); // Supprime le script jquery-migrate.js que wp utilise

        // Theme
        wp_enqueue_script(
            $handle = 'theme', 
            $src = JS_PATH . 'theme.js', 
            $deps = false, 
            $ver = '1.0.0', 
            $in_footer = true
        );

        // Easing animation
        wp_enqueue_script(
            $handle = 'easing-functions', 
            $src = JS_PATH . 'easing-functions.js', 
            $deps = false, 
            $ver = '1.0.0', 
            $in_footer = true
        );

        // Neowise Framework
        wp_enqueue_script(
            $handle = 'nw-component-manager', 
            $src = JS_PATH . 'nw-framework/component-manager.js', 
            $deps = false, 
            $ver = '1.0.0', 
            $in_footer = true
        );
        wp_enqueue_script(
            $handle = 'nw-component', 
            $src = JS_PATH . 'nw-framework/component-info.js', 
            $deps = false, 
            $ver = '1.0.0', 
            $in_footer = true
        );
  
        wp_localize_script('theme', 'ajaxurl', admin_url('admin-ajax.php'));
    }

    private function addBundleCSS() {
        // Style.css
        wp_enqueue_style(
            $handle = 'main-style', 
            $src = get_stylesheet_uri(), 
            $deps = false, 
            $ver = '1.0.0'
        );

        wp_enqueue_style(
            $handle = 'tailwind', 
            $src = get_template_directory_uri() . '/tailwind.min.css', 
            $deps = false, 
            $ver = '1.0.0'
        );
    }
}

