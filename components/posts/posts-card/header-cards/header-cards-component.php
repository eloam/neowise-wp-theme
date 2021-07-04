<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class HeaderCardsComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();

        if (is_category()) {
            $this->context['title'] = single_term_title('', false);
        } else {
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            if ($paged == 1) {
                $this->context['title'] = 'Derniers articles';
                $this->context['content'] = 'Ici se trouve les dernieres publications croustillantes tout juste sorties du four !';
            } else {
                $this->context['title'] = "Page {$paged}";
            }
        }
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}