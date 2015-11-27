<?

// ================================
// GET PLUGIN LANFOSTER
// ================================

	require( get_template_directory() . '/includes/lanfosterWP.php' );
	lanfosterWP()->logginError('Mauvais Login ou Mot de passe');

	
// ================================
// PERSONNALISATION PANNEL ADMIN
// ================================

	// Sidebar
	add_action('admin_menu', function()
	{
		remove_menu_page('index.php'); //dashboard
		remove_menu_page('edit.php'); // Posts
		//remove_menu_page('upload.php'); // Media
		remove_menu_page('link-manager.php'); // Links
		remove_menu_page('edit-comments.php'); // Comments
		remove_menu_page('edit.php?post_type=page'); // Pages
		remove_menu_page('plugins.php'); // Plugins
		remove_menu_page('themes.php'); // Appearance
		//remove_menu_page('users.php'); // Users
		//remove_menu_page('tools.php'); // Tools
		//remove_menu_page('options-general.php'); // Settings 
	});

	// Redirection login
	add_filter('login_redirect', function($url)
	{
		return 'wp-admin/edit.php?post_type=page';
	});

	// Modify elements bar top navigation wp
	add_action('admin_bar_menu', function( $wp_admin_bar )
	{
		// Remove elements
		$wp_admin_bar->remove_node( 'wp-logo' );
		$wp_admin_bar->remove_node( 'site-name' );
		$wp_admin_bar->remove_node( 'updates' );
		$wp_admin_bar->remove_node( 'comments' );
		$wp_admin_bar->remove_node( 'new-content' );
		$wp_admin_bar->remove_node( 'view' );
		//$wp_admin_bar->remove_node( 'languages' );

	}, 999);

	// Modify elements bar top navigation wp
	add_action('admin_bar_menu', function( $wp_admin_bar )
	{
		// Create news elements
		$wp_admin_bar->add_menu(array
		(
			'id'    => 'name',
			'title' => get_bloginfo('name')
		));
		$wp_admin_bar->add_menu(array
		(
			'id'    => 'v-home',
			'title' => 'Accueil',
			'href'  => get_home_url().'/wp-admin/edit.php?post_type=page'
		));
		$wp_admin_bar->add_menu(array
		(
			'id'    => 'v-site',
			'title' => 'Voir le site',
			'href'  => get_home_url(),
			'meta'  => array('target' => '_blank')
		));

	}, 10);

	// Ajout des thumbnails aux articles
	add_theme_support( 'post-thumbnails', array( 'post', 'album', 'event' ) ); // Ajouter sur les articles uniquement



// ================================
// PERSONNALISATION PAGE EDITION
// ================================

	add_action('admin_menu', function()
	{
		r_remove('album');
	});
	function r_remove($e)
	{
		remove_meta_box( 'postexcerpt'		, $e, 'normal' );
		remove_meta_box( 'icl_div_config'	, $e, 'normal' );
		remove_meta_box( 'commentstatusdiv'	, $e, 'normal' );
		remove_post_type_support($e,  'editor');
	}



// ================================
// AJOUT DE MENUS
// ================================

    // évenements

    lanfosterWP()->admin->setColumns( 'event', array('thumb'=>'couverture', 'event-title' => __('Title'), 'event-type' => 'Type d\'évènement', 'event-date' => __('Date') ), function ( $column, $post_id ) {
		switch ( $column ) {
			case 'thumb':
				echo get_the_post_thumbnail($post_id, 'thumbnail');
				break;
			case 'event-title':
				echo '<a href="'.get_edit_post_link($post_id).'"><b>'.get_the_title($post_id).'</b></a><br>'.get_post_meta( $post_id, 'baseline', true );
				break;
			case 'event-date':
				$type = get_post_meta( $post_id, 'type', true );
				if( $type == 'Stage' ) {
					echo 'du <b>'. get_post_meta( $post_id, 'date-debut', true ).'</b><br> au <b>'.get_post_meta( $post_id, 'date-fin', true ).'</b>';
				} else {
					echo '<b>'. get_post_meta( $post_id, 'date-debut', true ).'</b>';
				}
				break;
			case 'event-type':
				echo get_post_meta( $post_id, 'type', true );
				break;
		}
	});
	lanfosterWP()->admin->setColumnsSizes('event', array('thumb'=>'170px;'));

    $event = new Super_Custom_Post_Type( 'event', 'Evènement', 'Evènements', array(
    	'supports' => array( 'title', 'thumbnail','excerpt',  'page-attributes' )
    	) );
    $event->add_meta_box(array
            (
                'id' => 'event-baseline',
                'title' => 'Baseline',
                'fields' => array
                (
                    'baseline'   => array( 'type' => 'text', 'style' => 'width:100%;max-width:800px;', 'placeholder' => 'description courte' )
            
                )
            ));
    $event->add_meta_box(array
            (
                'id' => 'event-link',
                'title' => 'Bouton en savoir plus',
                'fields' => array
                (
                    'lien'   => array( 'type' => 'text', 'style' => 'width:100%;max-width:800px;', 'placeholder' => 'Aucune redirection par défaut' ),
                    'fenetre' => array( 'type' => 'checkbox', 'options' => array( 'Nouvelle fenetre' ) )
            
                )
            ));
    $event->add_meta_box(array
            (
                'id' => 'event-date',
                'title' => 'Date',
                'fields' => array
                (
                	'type' => array( 'type' => 'radio', 'options' => array( 'concert', 'Stage' ) ),
                    'date-debut' => array( 'type' => 'date' ),
                    'date-fin' => array( 'type' => 'date' ),
            
                )
            ));
    $event->set_icon( 'calendar' );

    
	
    // Albums
    lanfosterWP()->admin->addColumns( 'album', array('medias'=>'medias', 'thumb'=>'couverture'), function ( $column, $post_id ) {
		switch ( $column ) {
			case 'thumb':
				echo get_the_post_thumbnail($post_id, 'thumbnail');
				break;
			case 'medias':
				$mediaCount = get_post_meta( $post_id, 'mediaCount', true );
				echo $mediaCount['videos']." vidéo(s), ".$mediaCount['photos']." photo(s)";
				break;
		}
	});
    lanfosterWP()->admin->setColumnsSizes('album', array('thumb'=>'170px;', 'medias'=>'150px;'));
	lanfosterWP()->admin->setColumnsorder('album', array('thumb'=>'couverture','title' => __('Title'),'medias'=>'medias', 'date' => __('Date') ));

    $album = new Super_Custom_Post_Type( 'album', 'albums', 'album' );
    include( dirname(__FILE__) . '/includes/albums.php');
    $album->set_icon( 'camera-retro' );


?>