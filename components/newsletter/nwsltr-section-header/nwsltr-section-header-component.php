<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class NwsltrSectionHeaderComponent extends Component
{

    private $title;
    private $content;
    private $btnSubmitValue;
    private $emailAddress;

    private $context;

    public function init()
    {
        $this->context = Timber::context();

        $themeOptions = get_option('nw_options');
        $this->context['title'] = $themeOptions['cta_title'];
        $this->context['content'] = $themeOptions['cta_content'];
        $this->context['btnSubmitValue'] = $themeOptions['cta_submit_btn_title'];

        $this->context['wpNonceValue'] = wp_create_nonce('nwsltr-nonce');
    }

    public function render()
    {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);

        $popupComponent = NwComponents::prepare('newsletter/nwsltr-register-popup');
        $this->viewData = array("popupComponentId" => $popupComponent->info->id);
        $popupComponent->info->class = 'hidden';
        NwComponents::load($popupComponent);
    }
}
