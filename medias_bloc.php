<link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/mediasBloc.css"/>

    <section class="action">
        <h2 class="hiddenBlock">en action</h2>
        <div class="content">
            <?  $query = new WP_Query(array('post_type'=>'album', 'order'=>'asc', 'posts_per_page' => 6 )); 
                if( $query->post_count > 3 ) { 
            ?>
            <div class="hiddenBlock arrow prev"><div class="icon"></div></div>
            <div class="hiddenBlock arrow next"><div class="icon"></div></div>
            <? } ?>
            <div class="slider">
                <ul class="albums hiddenBlock rollimage_parent_vertical">
                <?
                   if($query->have_posts()) : while($query->have_posts()) : $query->the_post();

                        $infos = get_post_meta( $post->ID );
                        $mediasCount = maybe_unserialize($infos['mediaCount'][0]);
                        $urlCouverture = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                ?>
                    <li class="album" data-link="<?= $post->ID ?>">
                        <div class="image rollimage">
                            <div class="img" style="background-image: url('<?= $urlCouverture; ?>');" ></div>
                        </div>
                        <div class="text">
                            <div class="title"><?= get_the_title( $post->ID ); ?></div>
                            <div class="baseline">
                                <?
                                    echo $mediasCount .' ';
                                    if( $infos['type'][0] == 'Photos') {
                                        if( $mediasCount > 1 ) echo 'photos';
                                        else echo 'photo';
                                    } else {
                                        if( $mediasCount > 1 ) echo 'vidéos';
                                        else echo 'vidéo';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="hover"><span></span></div>
                    </li>
                <?
                    endwhile;endif;
                ?>
                </ul>   
            </div>
        </div>
        <a href="/medias" class="button">+ de médias</a>
    </section>