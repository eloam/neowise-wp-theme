<?php 

// Emplacement du dossier 'core'
define('CORE_PATH', get_template_directory() . '/core/');
// Emplacement du dossier 'js'
define('JS_PATH', get_template_directory_uri() . '/js/');



require_once  __DIR__ . '/vendor/autoload.php';					// Packages composer

require_once CORE_PATH . 'debug-utilities.php';         		// Fonctions de debug
require_once CORE_PATH . 'bundle-config.php';                   // Ressources JS et CSS du thème
require_once CORE_PATH . 'theme-settings.php';                  // Page d'options du thème
require_once CORE_PATH . 'mailchimp-integration.php';           // Intégration MailChimp

$nwComponents = new NwComponents\NwComponents(
	//$componentsDirectoryPath = 'components',
    //$useShadowDom = true,
    //$shadowMode = 'closed'
);

// Initialize Timber
$timber = new Timber\Timber();

// Important de tous les bundles JS et CSS
new BundleConfig();

// Enregistrement des menus du thème
register_nav_menus( array(
	'header' => 'Menu Principal',
	'footer' => 'Bas de page',
));

// On ajoute dans le contexte le menu principal et le menu de bas de page
add_filter( 'timber/context', 'add_to_context' );
function add_to_context($context) {
    $context['headerMenu'] = new \Timber\Menu('header');
    $context['footerMenu'] = new \Timber\Menu('footer');
    return $context;
}

// Barre latéral de widgets
/*function widget_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Primary Sidebar', 'neowise' ),
            'id' => 'article-sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'widget_sidebar' );*/

register_sidebar(array('name'=>'sidebar',
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

// Prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support('title-tag');

function custom_logo_setup() {
	$defaults = array(
		'height'      => 150,
		'width'       => 606,
		'header-text' => array('site-title', 'site-description'),
	);
	add_theme_support('custom-logo', $defaults );
}
add_action('after_setup_theme', 'custom_logo_setup');
   

// Page des paramètres du thème
if (is_admin()) {
	$nw_settings = new ThemeSettings();
}

// Intégration MailChimp
new MailchimpIntegration();