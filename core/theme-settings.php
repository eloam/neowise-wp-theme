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
			<?php Console::log($this->nw_options); ?>

			<form method="post" action="options.php">
				<!-- Section Footer -->
				<h2 style="padding-top: 25px;">Footer</h2>

				<?php 
				$this->addOptionField('text', 'footer_description', 'Description en bas de page');
				?>

				<!-- Section MailChimp -->
				<h2 style="padding-top: 25px;">MailChimp</h2>
				<p>Renseignez les paramètres liées à MailChimp afin de pouvoir afficher la section 'Call To Action' de la page d'accueil.</p>

				<?php 
				$this->addOptionField('text', 'mailchimp_api_key', 'Clé API');
				$this->addOptionField('text', 'mailchimp_list_id', 'Identifiant de la liste');
				$this->addOptionField('text', 'mailchimp_url_signup', 'URL d\'inscription manuelle');
				?>

				<!-- Section CTA -->
				<h2 style="padding-top: 25px;">Call To Action</h2>

				
				<?php 
				$this->addOptionField('text', 'cta_title', 'Titre');
				$this->addOptionField('textarea', 'cta_content', 'Description');
				$this->addOptionField('text', 'cta_submit_btn_title', 'Text du bouton envoyer');
				?>

				<!-- Section Contact -->
				<h2 style="padding-top: 25px;">Contact</h2>

				<?php 
				$this->addOptionField('text', 'contact_email_address', 'Adresse email de contact');
				?>

				<?php 			
					settings_fields('nw_option_group');
					submit_button(); ?>
			</form>
		</div>
	<?php 
	}

	public function pageInit() {
		register_setting(
			'nw_option_group', // option_group
			'nw_options', // option_name
		);
	}

	private function addOptionField($type, $name, $description) {
		?>
		<div class="form-table">
			<div><b><?php print($description); ?></b></div>
			<?php 
			if ($type !== 'textarea') {
				?>
				<input type="text" class="regular-text" name="nw_options[<?php print($name); ?>]" id="<?php print($name); ?>" value="<?php print($this->nw_options[$name]); ?>">
				<?php
			} else {
				?>
				<textarea type="text" class="regular-text" name="nw_options[<?php print($name); ?>]" id="<?php print($name); ?>" rows="10"><?php print($this->nw_options[$name]); ?></textarea>
				<?php
			}
			?>
			</div>
		<?php
	}

	

}
