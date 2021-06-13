<?php 

class ThemeSettings {
	private $nw_options;

	public function __construct() {
		add_action('admin_menu', [$this, 'createMenuPage']);
		add_action('admin_init', [$this, 'pageInit']);
	}

	public function createMenuPage() {
		add_menu_page(
			'Neowise', // page_title
			'Neowise', // menu_title
			'manage_options', // capability
			'neowise', // menu_slug
			[$this, 'createAdminPage'], // function
			'dashicons-admin-settings', // icon_url
		);
	}

	public function createAdminPage() {
		$this->nw_options = get_option('nw_options'); ?>

		<div class="wrap">
			<h2>Neowise</h2>
			<p>Paramètres du thème Neowise</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields('nw_option_group');
					?><br style="margin-bottom: 5rem;"><?php
					do_settings_sections('neowise-mailchimp');
					do_settings_sections('neowise-cta');
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function pageInit() {
		register_setting(
			'nw_option_group', // option_group
			'nw_options', // option_name
		);

		add_settings_section(
			'nw_setting_section_mailchimp', // id
			'Paramètres MailChimp', // title
			 [$this, 'nw_mailchimp_section_info'], // callback
			'neowise-mailchimp' // page
		);

		add_settings_section(
			'nw_setting_section_cta', // id
			'Paramètres Call To Action', // title
			 [$this, 'nw_cta_section_info'], // callback
			'neowise-mailchimp' // page
		);

		add_settings_section(
			'nw_setting_section_contact', // id
			'Paramètre de contact', // title
			 [$this, 'nw_contact_section_info'], // callback
			'neowise-mailchimp' // page
		);

		add_settings_field(
			'mailchimp_api_key', // id
			'Clé API', // title
			[$this, 'mailchimp_api_key_callback'], // callback
			'neowise-mailchimp', // page
			'nw_setting_section_mailchimp' // section
		);

		add_settings_field(
			'mailchimp_list_id', // id
			'Identifiant de la liste', // title
			[$this, 'mailchimp_list_id_callback'], // callback
			'neowise-mailchimp', // page
			'nw_setting_section_mailchimp' // section
		);

		add_settings_field(
			'mailchimp_url_signup', // id
			'URL d\'inscription manuelle', // title
			[$this, 'mailchimp_url_signup_callback'], // callback
			'neowise-mailchimp', // page
			'nw_setting_section_mailchimp' // section
		);

		add_settings_field(
			'cta_title', // id
			'Titre', // title
			[$this, 'cta_title_callback'], // callback
			'neowise-mailchimp', // page
			'nw_setting_section_cta' // section
		);

		add_settings_field(
			'cta_content', // id
			'Description', // title
			[$this, 'cta_content_callback'], // callback
			'neowise-mailchimp', // page
			'nw_setting_section_cta' // section
		);

		add_settings_field(
			'cta_submit_btn_title', // id
			'Texte du bouton envoyer', // title
			[$this, 'cta_submit_btn_title_callback'], // callback
			'neowise-mailchimp', // page
			'nw_setting_section_cta' // section
		);

		add_settings_field(
			'contact_email_address', // id
			'Adresse email de contact', // title
			[$this, 'contact_email_address_callback'], // callback
			'neowise-mailchimp', // page
			'nw_setting_section_contact' // section
		);
	}

	public function nw_mailchimp_section_info() {
		echo '<p>Renseignez les paramètres liées à MailChimp afin de pouvoir afficher la section \'Call To Action\' de la page d\'accueil.</p>';
	}

	public function nw_cta_section_info() {
		echo '<p>Paramètres de l\'encart sur la page d\'accueil.</p>';
	}

	public function nw_contact_section_info() {
		echo '<p>Paramètre de contact.</p>';
	}

	public function mailchimp_api_key_callback() {
		printf(
			'<input class="regular-text" name="nw_options[mailchimp_api_key]" id="mailchimp_api_key" value="%s">',
			isset( $this->nw_options['mailchimp_api_key'] ) ? $this->nw_options['mailchimp_api_key'] : ''
		);
	}

	public function mailchimp_list_id_callback() {
		printf(
			'<input class="regular-text" name="nw_options[mailchimp_list_id]" id="mailchimp_list_id" value="%s">',
			isset( $this->nw_options['mailchimp_list_id'] ) ? $this->nw_options['mailchimp_list_id'] : ''
		);
	}

	public function mailchimp_url_signup_callback() {
		printf(
			'<input class="regular-text" name="nw_options[mailchimp_url_signup]" id="mailchimp_url_signup" value="%s">',
			isset( $this->nw_options['mailchimp_url_signup'] ) ? $this->nw_options['mailchimp_url_signup'] : ''
		);
	}

	public function cta_title_callback() {
		printf(
			'<input class="regular-text" name="nw_options[cta_title]" id="cta_title" value="%s">',
			isset( $this->nw_options['cta_title'] ) ? $this->nw_options['cta_title'] : 'S\'inscrire à la newslatter'
		);
	}

	public function cta_content_callback() {
		printf(
			'<textarea class="regular-text" rows="5" name="nw_options[cta_content]" id="cta_content">%s</textarea>',
			isset( $this->nw_options['cta_content'] ) ? $this->nw_options['cta_content'] : ''
		);
	}

	public function cta_submit_btn_title_callback() {
		printf(
			'<input class="regular-text" name="nw_options[cta_submit_btn_title]" id="cta_submit_btn_title" value="%s">',
			isset( $this->nw_options['cta_submit_btn_title'] ) ? $this->nw_options['cta_submit_btn_title'] : 'Envoyer'
		);
	}

	public function contact_email_address_callback() {
		printf(
			'<input type="email" class="regular-text" name="nw_options[contact_email_address]" id="contact_email_address" value="%s">',
			isset( $this->nw_options['contact_email_address'] ) ? $this->nw_options['contact_email_address'] : ''
		);
	}

}
