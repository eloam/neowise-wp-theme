<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class PaginationComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();
        $this->context['posts'] = new Timber\PostQuery();
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}