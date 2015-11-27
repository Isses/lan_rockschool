<?php

add_action( 'admin_menu', 'createProjectMeta' );
add_action( 'save_post', 'saveProjectMeta', 10, 2 );
add_action( 'edit_post', 'saveProjectMeta', 10, 2 );

function createProjectMeta() {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    $post = get_post($post_id);
    if( $post->post_type == 'album' || $_GET['post_type'] == 'album' ) {
        wp_enqueue_style('it-admin', get_template_directory_uri().'/includes/admin.css');
        wp_enqueue_script('it-admin', get_template_directory_uri().'/includes/admin.js');
        wp_enqueue_script('tiny_mce');
        add_action( 'admin_enqueue_scripts', function(){ wp_enqueue_media(); }); 
        
        add_meta_box( 'album-media'     , 'medias'       , 'createAlbumMedia', 'album', 'normal', 'high' );

    }
}

function comparePositionGreatter($a, $b){
    if ($a['position'] == $b['position']) {
        if( $a['positionWanted'] == true ) return -1;
        if( $b['positionWanted'] == true ) return 1;
        else return 0;
    }
    return ($a['position'] < $b['position']) ? -1 : 1;
}

function saveProjectMeta( $post_id, $post ) {
    if ( !wp_verify_nonce( $_POST['medias_nonce'], 'mediasNONCE' ) )
        return $post_id;
    
    if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    
    //print_r($_POST);

    // ------------------------ 
    // MEDIAS 
    // ------------------------ 
    $nbVideos = 0;
    $nbPhotos = 0;

    $albumMedias = [];
    $albumMediasSorted = [];
    $mediasCount = 0;
    foreach ($_POST['media'] as $key => $value) {
        ++$mediasCount;

        if( $value['position'] && !is_nan($value['position'])){
            if( $value['position'] > $mediasCount ) $albumMedias[$mediasCount]['position'] = $value['position'] + 1;   
            else $albumMedias[$mediasCount]['position']    = $value['position'];                 
            $albumMedias[$mediasCount]['positionWanted']   = true;
        } else {
            $albumMedias[$mediasCount]['position']         = $mediasCount;    
        }
        
        $albumMedias[$mediasCount]['type']    = $value['type'];
        if( $value['type'] == 'image' &&  $value['image'] != '' ) {
            $albumMedias[$mediasCount]['image']   = $value['image'];
            $albumMedias[$mediasCount]['video']   = '';
            ++$nbPhotos;
        } else if( $value['type'] == 'video' &&  $value['video'] != '' ) {
            $albumMedias[$mediasCount]['video']   = $value['video'];
            $albumMedias[$mediasCount]['image']   = '';
            ++$nbVideos;
        }       
        
    }

    usort($albumMedias, "comparePositionGreatter");
    
    $mediasCount = 0;
    foreach ($albumMedias as $key => $value) {
        ++$mediasCount;
        $albumMediasSorted['media-'.$mediasCount] = $value;
    }

    if ( get_post_meta( $post_id, 'media', true )       != $albumMediasSorted ) update_post_meta( $post_id, 'media', $albumMediasSorted );

    $mediaTypeCount = [ 'videos' => $nbVideos, 'photos' => $nbPhotos ];
    if ( get_post_meta( $post_id, 'mediaCount', true )  != $mediaTypeCount ) update_post_meta( $post_id, 'mediaCount', $mediaTypeCount );

}

function createAlbumMedia( $object, $box ) { 
    $mediasMetas = get_post_meta( $object->ID, 'media', true );
    if ( !$mediasMetas ) $mediasMetas = [ 'media-1' => ['type' => '', 'image' => '', 'video' =>'' ] ];
    
    $mediaCount = 0;
    ob_start();
    foreach ($mediasMetas as $key => $value) {
        ++$mediaCount;
        if( $value['type'] != '' || $mediaCount == 1 ) {
            $tabs .= '<div class="tab '.($mediaCount == 1?'current':'').'" data-link="'.$key.'" >'.$key.'</div>';
            ?>  
            
            <div class="content <?php echo($mediaCount == 1?'current':'') ?>" data-link="<?= $key ?>" style="padding:10px;">

                <div class="header">
                    <label data-type="for" class="checkbox" for="<?= $key ?>_type_full">
                        <input data-type="checked name id" type="radio" id="<?= $key ?>_type_image" name="media[<?= $key ?>][type]" value="image" <?php if ( $value['type']=='image' || $value['type'] =='' ) { ?>checked="true"<?php } ?> />
                        <strong>Image</strong>
                    </label>
                    &nbsp;
                    <label data-type="for" class="checkbox" for="<?= $key ?>_type_video">
                        <input data-type="unchecked name id" type="radio" id="<?= $key ?>_type_video" name="media[<?= $key ?>][type]" value="video" <?php if ( $value['type']=='video' ) { ?>checked="true"<?php } ?> />
                        <strong>Vidéo</strong>
                    </label>
                    <div class="blocposition">
                        <label>Ordre</label>
                        <input data-type="value name" class="margin" name="media[<?= $key ?>][position]" value="" type="number"  />
                    </div>
                </div>
                

                <div class="bloc blocImage <?php if($value['type']=='image' || $value['type']=='') echo ' active'; ?>" data-type="activated" style="padding:10px;">
                    <div class='image'>
                        <img data-type="src" src='<? echo ($value['image']== "" ? get_template_directory_uri()."/includes/default.jpg": $value['image'] ); ?>' >
                    </div>
                    <input data-type="value name" class="fileField" name="media[<?= $key ?>][image]" value='<?= $value['image'] ?>' type="hidden" />
                    <input class="button button-secondary mediaBtn" name="mediaBtn" type="button" value="changer l'image" />
                    <input class="button button-secondary removeMediaBtn" name="removeMediaBtn" type="button" value="retirer l'image" />
                </div>

                <div class="bloc blocVideo <?php if($value['type']=='video') echo ' active'; ?>" data-type="activable" style="padding:10px;">
                    <div class='video'>
                        <textarea data-type="html name" name="media[<?= $key ?>][video]" placeHolder="l'identifiant youtube"><?= $value['video'] ?></textarea>
                    </div>
                </div>

            </div>

    <?php 
       
    }}

    $tabs   .=  '<input type="button" name="addBtn" value="+" class="add-btn button button-primary" />';
    $tabs   .=  '<input type="button" name="removeBtn" value="-" class="remove-btn button button-danger" />';
    $content = ob_get_clean(); 
    ?>
    <div class="tableList" data-type="media" data-count="<?= $mediaCount ?>">
        <div class="tabs"><?= $tabs ?></div>
        <div class="container">
            <?= $content ?>
            <input type="hidden" name="medias_nonce" value="<?php echo wp_create_nonce( 'mediasNONCE'); ?>" />
        </div>
        <script type="text/javascript">
            var defaultImage = '<?= get_template_directory_uri()."/includes/default.jpg" ?>';
        </script>
    </div>
    
    <?php
 }

