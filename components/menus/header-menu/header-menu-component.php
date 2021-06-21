<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class HeaderMenuComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();

        // Logo
        $hasLogo = has_custom_logo();
        $logoId = get_theme_mod('custom_logo');
        $logoSrc = wp_get_attachment_image_src($logoId , 'full')[0] ?? '';
        $this->context['logo'] = array('hasLogo' => $hasLogo, 'src' => $logoSrc);
        $this->context['title'] = get_bloginfo('name');
        
        // Home url
        $this->context['homeUrl'] = get_home_url();
    }

    public function render() {

        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}