<?
    /*
    Template Name: page medias
    */
    global $rockschool_pageurl;
	global $rockschool_pagecss;
	global $rockschool_pagetitle;
	global $rockschool_pageDesc;

    $rockschool_pageurl 	= '';
    $rockschool_pagecss 	= 'medias';
    $rockschool_pagetitle 	= 'EN IMAGES';
    $rockschool_pageDesc 	= 'Souvenirs souvenirs ! Les archives de la Rock School en photos et vidéos';

    get_header()
?>

	<section class="intro">
		<div class="bg"></div>
		<div class="text">en<h1>IMAGES</h1></div>
		<div class="scrolldown"></div>
	</section>

	<section class="presentation hiddenBlock">
		<p>Souvenirs souvenirs !</p><p>Les archives de la Rock School</p><p>en photos et vidéos</p><span></span>
	</section>

	<section class="transition">
		<div class="content"></div>
	</section>
	
	<?  $query = new WP_Query(array('post_type'=>'album', 'order'=>'DESC', 'posts_per_page' => -1 ));
		$mediaList = $query->posts;
		$photosList = array();
		$videosList = array();
		foreach ($mediaList as $key => $album) { 
			$infos = get_post_meta( $album->ID );
			if( $infos['type'][0] == 'Photos' ){
				array_push( $photosList, $album );
			} else {
				array_push( $videosList, $album );
			}
		}

	?>
	<section class="enphotos">
		<h2>EN PHOTOS</h2>

		<div class="wall">
		<?
		$wallCount = -1;
		$nbAlbums = count($photosList);
		$restModulo = 3-($nbAlbums - intval($nbAlbums/3)*3);
		$extra = 0;
		$wallColor = array('orange','lightpurple','darkpurple','lightpurple','darkpurple','orange');
		
		foreach ($photosList as $album) { 
			$color = $wallColor[ (++$wallCount)%6 ];
			$infos = get_post_meta( $album->ID );
            $mediasCount = maybe_unserialize($infos['mediaCount'][0]);
            $urlCouverture = wp_get_attachment_url( get_post_thumbnail_id($album->ID) );
            if( $restModulo == 2 && $wallCount == 5 ) { --$restModulo; ++$extra; ?>
					<div class="littleline hiddenBlock empty" ></div>
        		<? } elseif( $restModulo == 1 && $restModulo == $nbAlbums%3 && $wallCount == 5) { --$restModulo; ++$extra;?>
					<div class="littleline hiddenBlock empty" ></div>
        		<? }
            if( $wallCount + $extra <= 5 ){ 
            	

            	?>
			<div class="littleline hiddenBlock rollimage_parent_vertical <?= $color ?>" >
				<div class="rollimage">
					<div class="img" style="background-image: url('<?= $urlCouverture; ?>');" ></div>
				</div>
				<div class="text">
					<div class="title"><?= $album->post_title ?></div>
					<div class="baseline">
				 		<?
                            echo $mediasCount .' ';
                            if( $mediasCount > 1 ) echo 'photos';
                            else echo 'photo'; 
                        ?>
					</div>
					<div class="moreinfosbtn">
						<div class="button" data-link="<?= $album->ID ?>">VOIR</div>
					</div>
				</div>
			</div>	
            

        <?    } else {  

        	if( $restModulo == 1 && ($wallCount+$extra)%3 == 1 ){ 
        		--$restModulo; ++$extra;
        		echo '<div class="smallAlbum empty" ></div>';
        	}
        	?>


        	<div class="smallAlbum <?= $color ?>" data-link="<?= $album->ID ?>">
				<div class="text">
					<div class="title"><?= $album->post_title ?></div>
					<div class="baseline">
				 		<?
                            echo $mediasCount .' ';
                            if( $mediasCount > 1 ) echo 'photos';
                            else echo 'photo'; 
                        ?>
					</div>
				</div>
			</div>
		<? }} ?>
		</div>
		<div>
			<div class="button morepictures">+ DE PHOTOS</div>
		</div>
	</section>

	<section class="transition transition2">
		<div class="content"></div>
	</section>

	<section class="envideo">
		<h2>EN VIDÉOS</h2>

		<div class="wall">
		<?
		foreach ($videosList as $album) { 
			$infos = get_post_meta( $album->ID );
            $mediasCount = maybe_unserialize($infos['mediaCount'][0]);
            $urlCouverture = wp_get_attachment_url( get_post_thumbnail_id($album->ID) );
		?>
			<div class="littleline white hiddenBlock rollimage_parent_vertical">
				<div class="rollimage">
					<div class="img" style="background-image: url('<?= $urlCouverture; ?>');" ></div>
				</div>
				<div class="text">
					<div class="title"><?= $album->post_title ?></div>
					<div class="baseline">
				 		<?
                            echo $mediasCount .' ';
                            if( $mediasCount > 1 ) echo 'vidéos';
                            else echo 'vidéo';
                        ?>
					</div>
					<div class="moreinfosbtn">
						<div class="button" data-link="<?= $post->ID ?>" >VOIR</div>
					</div>
				</div>
			</div>
		<? } ?>
		</div>
		<div>
			<div class="button morepictures">+ DE VIDÉOS</div>
		</div>
	</section>

<? get_footer() ?>