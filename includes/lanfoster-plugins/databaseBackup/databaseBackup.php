<?php
/**
 * Lanfoster Shortcuts for WP
 *
 * @package lanfoster
 * @subpackage lanfosterWP
 */

final class databaseBackup {

	private $PATH;

	public function __construct() {
		$that = $this;
		$this->PATH = lanfosterWP()->pluginsPATH.'/databaseBackup/';

		add_action( 'admin_menu', function() use($that){

			add_menu_page( 
		        'My database backup by Lanfoster', 
		        'Database Backup', 
		        'manage_options', 
		       	'databaseBackup', 
		       	array(
					$this,
					'getPageContent'
				),
		        'dashicons-shield-alt',
	        102 ); 

	        /*add_submenu_page( 
	        	'mailchimpNewsletter', 
	        	'Newsletters stats', 
	        	'Statistiques', 
	        	'manage_options', 
	        	'mailchimpNewsletter-campaigns',
	        	array(
					$this,
					'getCampaigns'
				)
			);*/

		});

		//add_action( 'wp_ajax_lanMC-removeCampaign', array( $this, 'ajaxRemoveCampaign' ) );
		

	}

	public function getOptions() {
		if( $this->options ) return $this->options;

		$defaults = array(
			'general' => array(
				'api_key' => ''
			)
		);

		$db_keys_option_keys = array(
			'lan_mc_news' => 'general'
		);

		$options = array();
		foreach ( $db_keys_option_keys as $db_key => $option_key ) {
			$option = (array) get_option( $db_key, array() );

			// add option to database to prevent query on every pageload
			if ( count( $option ) === 0 ) {
				add_option( $db_key, $defaults[$option_key] );
			}

			$options[$option_key] = array_merge( $defaults[$option_key], $option );
		}

		$this->options = $options;
		$this->apikey = $options['general']['api_key'];
		return $this->options;
	}

	public function saveOptions() {
		if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') {
			$datas = $_POST['lan_mc_news'];
			update_option( 'lan_mc_news', $datas );
		}
	}

	

	protected function getStyle() {
		wp_enqueue_style( 'lanfoster_mc', $this->PATH . '/admin.css', array(), null);
	}

	protected function getScript() {
		//wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.js', array( 'jquery' ));
	}

	public function getPageContent() {
		
		$this->getStyle();
		$this->getScript();
		$this->saveOptions();
		$options = $this->getOptions();
		?>
		<div id="mailchimpNewsletter" class="mailchimpNewsletter">
			<h2><img src="<?php echo $this->PATH; ?>menu-icon.png" /> Mailchimp newsletter par LANFOSTER</h2>
		</div>
		<?php
	}

	

}

//echo 'jhl';
?>
