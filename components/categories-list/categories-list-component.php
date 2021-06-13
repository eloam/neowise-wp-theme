<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class CategoriesListComponent extends Component {

    private $context;

    public function init() {
        $this->context = Timber::context();
        $this->context['cards'] = $this->getCards();
    }

    public function render() {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }

    private function getCards() {
        $cards = array();

        $categories = get_categories();
        foreach($categories as $category) {
            array_push($cards, $this->getCardProperties($category));
        }

        return $cards;
    }

    private function getCardProperties($category) {
        return [
            'class'   => sprintf('category-%s', $category->cat_ID),
            'name'      => $category->name,
            'desc'      => $category->description,
            'backgroundImage'     => get_field('category_img', sprintf('category_%s', $category->term_id)),
            'link'   => get_category_link($category->cat_ID)
        ];
    }
}