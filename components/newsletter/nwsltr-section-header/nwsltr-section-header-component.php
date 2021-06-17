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
        $this->context['urlFormSignup'] = $themeOptions['mailchimp_url_signup'];
        $this->context['emailAddress'] = $themeOptions['contact_email_address'];

        $this->context['wpNonceValue'] = wp_create_nonce('nwsltr-nonce');
        $this->context['imageUri'] = sprintf('%s/img/mail_w400.png', get_template_directory_uri());
    }

    public function render()
    {
        Timber::render($this->info->getFileName(FileTypes::twig), $this->context);


        $successPopupComponent = NwComponents::prepare('newsletter/nwsltr-register-successful');
        $failPopupComponent = NwComponents::prepare('newsletter/nwsltr-register-fail');

        $this->viewData = array(
            "successPopupComponentId" => $successPopupComponent->info->id,
            "failPopupComponentId" => $failPopupComponent->info->id
        );

        NwComponents::load($successPopupComponent);
        NwComponents::load($failPopupComponent);
    }
}
