<?php

use NwComponents\Component;
use NwComponents\Enums\FileTypes;

class NwsltrRegisterPopupComponent extends Component
{
    private $context;

    public function init()
    {
        $this->context = Timber::context();

        $themeOptions = get_option('nw_options');
        $this->context['title'] = $themeOptions['contact_email_address'];     
        
        $this->context['emailAddress'] = $themeOptions['contact_email_address'];
        $this->viewData['urlFormSignup'] = $themeOptions['mailchimp_url_signup'];
    }

    public function render()
    {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);
    }
}
