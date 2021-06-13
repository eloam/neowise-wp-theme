<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class PostsCardComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();

        if (!empty($this->data)) {
            $this->context['posts'] = new Timber\PostQuery($this->data);
        } else {
            $this->context['posts'] = new Timber\PostQuery();
        }
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}