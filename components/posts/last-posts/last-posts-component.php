<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class LastPostsComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();
        $this->context['posts'] = new Timber\PostQuery(array('posts_per_page' => 3));
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}