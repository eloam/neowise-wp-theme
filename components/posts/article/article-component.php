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

        // Paramètres optionnels
        if (!empty($this->data) && array_key_exists('comments', $this->data)) {
            $this->context['comments'] = $this->data['comments'];
        } else {
            $this->context['comments'] = true;
        }
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}