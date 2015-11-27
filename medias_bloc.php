    <section class="action">
        <h2>en action</h2>
        <div class="content">
            <div class="arrow prev"><div class="icon"></div></div>
            <div class="arrow next"><div class="icon"></div></div>
            <div class="slider">
                <ul class="albums">
                <?
                    $query = new WP_Query(array('post_type'=>'album', 'order'=>'asc', 'posts_per_page' => 6 ));
                    if($query->have_posts()) : while($query->have_posts()) : $query->the_post();

                        $infos = get_post_meta( $post->ID );
                        $mediasCount = maybe_unserialize($infos['mediaCount'][0]);
                        $urlCouverture = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                ?>      
                    <li class="album">
                        <img src="<?= $urlCouverture; ?>" alt="">
                        <div class="text">
                            <div class="title"><?= get_the_title( $post->ID ); ?></div>
                            <div class="infos">
                                <?
                                    $nbVideos   =  $mediasCount["videos"];
                                    $nbPhotos   =  $mediasCount["photos"];
                                    if( $nbPhotos > 0 ) {
                                        if( $nbPhotos == 1 ) echo '1 Photo';
                                        else echo $nbPhotos.' Photos';
                                    }
                                    if( $nbPhotos > 0 && $nbVideos > 0 ) echo ' / ';

                                    if( $nbVideos > 0 ) {
                                        if( $nbVideos == 1 ) echo '1 Vidéo';
                                        else echo $nbVideos.' Vidéos';
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