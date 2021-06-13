<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class CommentsComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();
        $this->context['post'] = new Timber\Post();
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}