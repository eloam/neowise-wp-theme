<?php

use NwComponents\NwComponents;
use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class ArticleComponent extends Component {

    private $context;

    public function init() {
        // Contexte
        $this->context = Timber::context();
        $this->context['post'] = new Timber\Post();
        $this->context['sidebar'] = Timber::get_widgets('sidebar');
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}