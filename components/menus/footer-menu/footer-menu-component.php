<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class FooterMenuComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();

        $themeOptions = get_option('nw_options');
        $this->context['description'] = $themeOptions['footer_description'];
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}