<?php

use \DrewM\MailChimp\MailChimp;

class MailchimpIntegration {

    private $apiKey;
    private $listId;

    function __construct() {
		$options = get_option('nw_options');
        $this->apiKey = $options['mailchimp_api_key'];
        $this->listId = $options['mailchimp_list_id'];
        add_action('wp_ajax_nwsltr_signup', [$this, 'newsletterSignup']);
        add_action('wp_ajax_nopriv_nwsltr_signup', [$this, 'newsletterSignup']);
    }

    function newsletterSignup() {

        if (isset($_POST['_wpnonce']))  {
            if (wp_verify_nonce($_POST['_wpnonce'], 'nwsltr-nonce')) {
                
                if (!$this->apiKey || !$this->listId) { wp_send_json_error('Mailchimp not correctly configured.'); }

                $emailAddress = $_POST['email-address'];

                if (!$emailAddress) { wp_send_json_error('Email address not specified.'); }

                $mailChimp = new MailChimp($this->apiKey);
                $listMembersUrl = sprintf('/lists/%s/members', $this->listId);
                $hash = $mailChimp->subscriberHash($emailAddress);   

                $result = $mailChimp->get(sprintf('%s/%s', $listMembersUrl, $hash));

                if ($mailChimp->success()) {
                    $result = $mailChimp->patch(sprintf('%s/%s', $listMembersUrl, $hash), array(
                        'status'        => 'subscribed'
                    ));
                } else {
                    $result = $mailChimp->post($listMembersUrl, array(
                        // create a user
                        'email_address' => $emailAddress,
                        'status'        => 'subscribed'
                    ));
                }

                if ($mailChimp->success()) {
                    wp_send_json_success($result);
                } else {
                    wp_send_json_error($result);
                }
            }
        }
    }
}