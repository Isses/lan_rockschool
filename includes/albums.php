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
        
        add_meta_box( 'album-photos', 'Photos', 'createAlbumPhotos', 'album', 'normal', 'high' );
        add_meta_box( 'album-videos', 'Videos', 'createAlbumVideos', 'album', 'normal', 'high' );

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
    
    $albumMedias        = [];
    $albumMediasSorted  = [];
    $mediasCount        = 0;

    if( $_POST['type'] == 'Photos' ) {
        foreach ($_POST['photos'] as $key => $value) {
            ++$mediasCount;

            if( $value['position'] && !is_nan($value['position'])){
                if( $value['position'] > $mediasCount ) $albumMedias[$mediasCount]['position'] = $value['position'] + 1;   
                else $albumMedias[$mediasCount]['position']    = $value['position'];                 
                $albumMedias[$mediasCount]['positionWanted']   = true;
            } else {
                $albumMedias[$mediasCount]['position']         = $mediasCount;    
            }
            
            $albumMedias[$mediasCount]['value']   = $value['value'];
        }

        usort($albumMedias, "comparePositionGreatter");
        $mediasCount = 0;
        foreach ($albumMedias as $key => $value) {
            ++$mediasCount;
            $albumMediasSorted['photo-'.$mediasCount] = $value['value'];
        }

        if ( get_post_meta( $post_id, 'photos', true )       != $albumMediasSorted ) update_post_meta( $post_id, 'photos', $albumMediasSorted );
    }

    if( $_POST['type'] == 'Vidéos' ) {
        foreach ($_POST['videos'] as $key => $value) {
            ++$mediasCount;

            if( $value['position'] && !is_nan($value['position'])){
                if( $value['position'] > $mediasCount ) $albumMedias[$mediasCount]['position'] = $value['position'] + 1;   
                else $albumMedias[$mediasCount]['position']    = $value['position'];                 
                $albumMedias[$mediasCount]['positionWanted']   = true;
            } else {
                $albumMedias[$mediasCount]['position']         = $mediasCount;    
            }
            
            $albumMedias[$mediasCount]['value']   = $value['value'];
        }

        usort($albumMedias, "comparePositionGreatter");
        $mediasCount = 0;
        foreach ($albumMedias as $key => $value) {
            ++$mediasCount;
            $albumMediasSorted['video-'.$mediasCount] = $value['value'];
        }

        if ( get_post_meta( $post_id, 'videos', true )       != $albumMediasSorted ) update_post_meta( $post_id, 'videos', $albumMediasSorted );
    }

    if ( get_post_meta( $post_id, 'mediaCount', true )  != $mediasCount ) update_post_meta( $post_id, 'mediaCount', $mediasCount );
}

function createAlbumVideos( $object, $box ) { 
    $mediasVideos = get_post_meta( $object->ID, 'videos', true );
    if ( !$mediasVideos ) $mediasVideos = [ 'video-1' => '' ];
    
    $videosCount = 0;
    ob_start();
    foreach ($mediasVideos as $key => $value) {
        ++$videosCount;
        if( $value != '' || $videosCount == 1 ) {
            $tabs .= '<div class="tab '.($videosCount == 1?'current':'').'" data-link="'.$key.'" >'.$key.'</div>';
            ?>  
            
            <div class="content <?php echo($videosCount == 1?'current':'') ?>" data-link="<?= $key ?>" style="padding:10px;">

                <div class="header">
                    <div class="blocposition">
                        <label>Ordre</label>
                        <input data-type="value name" class="margin" name="videos[<?= $key ?>][position]" value="" type="number"  />
                    </div>
                </div>

                <div class="bloc blocVideo" data-type="activable" style="padding:10px;">
                    <div class='video'>
                        <textarea data-type="html name" name="videos[<?= $key ?>][value]" placeHolder="l'identifiant youtube"><?= $value ?></textarea>
                    </div>
                </div>

            </div>

    <?php 
       
    }}

    $tabs   .=  '<input type="button" name="addBtn" value="+" class="add-btn button button-primary" />';
    $tabs   .=  '<input type="button" name="removeBtn" value="-" class="remove-btn button button-danger" />';
    $content = ob_get_clean(); 
    ?>
    <div class="tableList" data-type="video" data-count="<?= $videosCount ?>">
        <div class="tabs"><?= $tabs ?></div>
        <div class="container">
            <?= $content ?>
        </div>
    </div>
    
    <?php
 }

 function createAlbumPhotos( $object, $box ) { 
    $mediasPhotos = get_post_meta( $object->ID, 'photos', true );
    if ( !$mediasPhotos ) $mediasPhotos = [ 'photo-1' => '' ];
    
    $photosCount = 0;
    ob_start();
    foreach ($mediasPhotos as $key => $value) {
        ++$photosCount;
        if( $value != '' || $photosCount == 1 ) {
            $tabs .= '<div class="tab '.($photosCount == 1?'current':'').'" data-link="'.$key.'" >'.$key.'</div>';
            ?>  
            
            <div class="content <?php echo($photosCount == 1?'current':'') ?>" data-link="<?= $key ?>" style="padding:10px;">

                <div class="header">
                    <div class="blocposition">
                        <label>Ordre</label>
                        <input data-type="value name" class="margin" name="photos[<?= $key ?>][position]" value="" type="number"  />
                    </div>
                </div>
                

                <div class="bloc blocImage" data-type="activated" style="padding:10px;">
                    <div class='image'>
                        <img data-type="src" src='<? echo ($value== "" ? get_template_directory_uri()."/includes/default.jpg": $value ); ?>' >
                    </div>
                    <input data-type="value name" class="fileField" name="photos[<?= $key ?>][value]" value='<?= $value ?>' type="hidden" />
                    <input class="button button-secondary mediaBtn" name="mediaBtn" type="button" value="changer l'image" />
                    <input class="button button-secondary removeMediaBtn" name="removeMediaBtn" type="button" value="retirer l'image" />
                </div>

            </div>

    <?php 
       
    }}

    $tabs   .=  '<input type="button" name="addBtn" value="+" class="add-btn button button-primary" />';
    $tabs   .=  '<input type="button" name="removeBtn" value="-" class="remove-btn button button-danger" />';
    $content = ob_get_clean(); 
    ?>
    <div class="tableList" data-type="photo" data-count="<?= $photosCount ?>">
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

