<?php
/**
 * Lanfoster Shortcuts for WP
 *
 * @package lanfoster
 * @subpackage lanfosterWP
 */

/*
removeColumns
addColumns
setColumns
disableSortableColumns
removeMetaBoxes
remove_post_type_support
setColumnsSizes
*/

final class lanfosterWP_admin {

	public $version = '0.1';
	public $plugins = array();
	public $columnsSizes = array();
	// Remove column from admin list
	//
	//cb 
	//title 
	//author 
	//categories 
	//tags 
	//comments 
	//date 
	public function removeColumns( $postType, $toRemove, $priority = 10){
		$filter = 'manage_edit-'.$postType.'_columns';

		add_filter($filter, function($columns) use ($toRemove){
			if( is_array($toRemove)){
				foreach( $toRemove as $columnName ){
					unset( $columns[$columnName]);
				}
			} else {
				unset( $columns[$toRemove]);
			}	
			return $columns;
		}, $priority);

	}

	public function addColumns( $postType, $toAdd, $callBack, $priority = 10){
		$filterAdd = 'manage_edit-'.$postType.'_columns';

		add_filter($filterAdd, function($columns) use ($toAdd){
			foreach( $toAdd as $columnID => $columnName){
				$columns[$columnID] = $columnName;
			}
			return $columns;
		}, $priority);

		if( $postType == 'post') $filterManage = 'manage_posts_custom_column';
		else $filterManage = 'manage_'.$postType.'_posts_custom_column';
		add_action($filterManage, $callBack,$priority, 2);
	}

	public function setColumns( $postType, $newColums, $callBack, $priority = 10){
		$filterAdd = 'manage_edit-'.$postType.'_columns';

		add_filter($filterAdd, function($columns) use ($newColums){
			return $newColums;
		}, $priority);

		if( $postType == 'post') $filterManage = 'manage_posts_custom_column';
		else $filterManage = 'manage_'.$postType.'_posts_custom_column';
		add_action($filterManage, $callBack,$priority, 2);
	}

	public function disableSortableColumns( $postType, $toRemove, $priority = 10){
		$filter = 'manage_edit-'.$postType.'_sortable_columns';

		add_filter($filter, function($columns) use ($toRemove){
			if( is_array($toRemove)){
				foreach( $toRemove as $columnName ){
					unset( $columns[$columnName]);
				}
			} else {
				unset( $columns[$toRemove]);
			}	
			return $columns;
		}, $priority);

		
	}

	//	Removes a meta box or any other element
	//
	//'authordiv' – Author metabox
	//'categorydiv' – Categories metabox.
	//'commentstatusdiv' – Comments status metabox (discussion)
	//'commentsdiv' – Comments metabox
	//'formatdiv' – Formats metabox
	//'pageparentdiv' – Attributes metabox
	//'postcustom' – Custom fields metabox
	//'postexcerpt' – Excerpt metabox
	//'postimagediv' – Featured image metabox
	//'revisionsdiv' – Revisions metabox
	//'slugdiv' – Slug metabox
	//'submitdiv' – Date, status, and update/save metabox
	//'tagsdiv-post_tag' – Tags metabox
	//'{$tax-name}div' - Hierarchical custom taxonomies metabox
	//'trackbacksdiv' – Trackbacks metabox
	public function removeMetaBoxes($postType, $toRemove, $priority = 10){
		add_action('admin_menu', 
			function() use($postType,$toRemove) { 
				if( is_array($toRemove)){
					foreach( $toRemove as $box ){
						remove_meta_box(  $box, $postType, 'normal' );
					}
				} else {
					remove_meta_box( $toRemove, $postType, 'normal' );
				}
			} ,$priority);
	}


	//	Remove support of certain features for a given post type (s)
	//
	// 'editor' (content)
	// 'author'
	// 'thumbnail' (featured image) (current theme must also support Post Thumbnails)
	// 'excerpt'
	// 'trackbacks'
	// 'custom-fields'
	// 'comments' (also will see comment count balloon on edit screen)
	// 'revisions' (will store revisions)
	// 'page-attributes' (template and menu order) (hierarchical must be true)
	// 'post-formats' removes post formats, see Post Formats
	
	public function remove_post_type_support($postType, $toRemove, $priority = 10){
		add_action('admin_menu', 
			function() use($postType,$toRemove) { 
				if( is_array($toRemove)){
					foreach( $toRemove as $box ){
						remove_post_type_support( $postType, $box );
					}
				} else {
					remove_post_type_support( $postType, $toRemove);
				}
			} ,$priority);
	}

	//	Set columns size in admin list
	// columns is array like this : array('product_cat'=>'140px', 'price'=>'10%' )
	public function setColumnsSizes($postType, $columns ) {
		$postType = 'edit-'.$postType;
		$this->columnsSizes[$postType] = $columns;

		add_action('admin_head', function() {
			$pageID = get_current_screen()->id;
			foreach ( lanfosterWP()->admin->columnsSizes as $postType => $columns) {
				if( $pageID == $postType) {
					echo '<style>';
					foreach ( $columns as $column => $size) {
						echo 'th#'.$column.' {width: '.$size.'!important;}';
					}
					echo '</style>';
				}
			}
		});
	}

	//	Set columns order in admin list
	// columns is array like this : array('product', 'price', 'date' )
	public function setColumnsOrder($postType, $columns ) {
		add_filter('manage_'.$postType.'_posts_columns', function ($old_columns) use ($columns) {
			return $columns;
		});
	}

	public function addPlugin( $pluginName ) {
		if( $this->plugins[ $pluginName ] ) return;
		$path = 'lanfoster-plugins/'.$pluginName.'/'.$pluginName.'.php';
		require( $path);
		$this->plugins[ $pluginName ] = new $pluginName;
	}

}

