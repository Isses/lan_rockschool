<?
    /*
    Template Name: page home
    */
    global $rockschool_pagename; 
    $rockschool_pagename = 'home';

    get_header()
?>
	<section class="intro">
		<div class="bg"></div>
		<div class="text">Bienvenue à la <h1>rock school</h1><span class="endIntro">de P<span class="icon"></span>ris</span></div>
		<div class="scrolldown"></div>
	</section>

	<section class="news">
		<h2 class="hiddenBlock">AUX NOUVELLES !</h2>
		<?	
			// GET NEWS DATAS
			$pictures = array();
			$texts = array();
			$newsCount = 0;
			$news = get_posts( array('posts_per_page' => 3 ) );
			foreach ($news as $post) : setup_postdata( $post );
				
				++$newsCount;

				// THUMBNAIL
				$pictureEl = '<div class="picture" style="background-image:url(%linkThumbnail%);"></div>';
				array_push( $pictures, str_replace("%linkThumbnail%", wp_get_attachment_url(get_post_thumbnail_id($post->ID)) , $pictureEl ) );

				// TEXT
				$textEl = '<div class="text"><div class="date">%date%</div><div class="title">%title%</div><div class="description">%description%</div><a href="%link%" class="button">En savoir +</a></div>';

				$textEl = str_replace("%date%", get_the_time('d M Y') , $textEl );
				$textEl = str_replace("%title%", get_the_title() , $textEl );
				$textEl = str_replace("%description%", wpautop( get_the_content() ) , $textEl );
				$textEl = str_replace("%link%", get_the_permalink() , $textEl );
				array_push( $texts, $textEl );

			endforeach; wp_reset_postdata(); 
		?>

		<div class="content">
			<div class="pictures appearImg">
				<div class="navigation">
					<div class="btn prevBtn"><div class="icon"></div></div>
					<div class="count">1 / <?= $newsCount ?></div>
					<div class="btn nextBtn"><div class="icon"></div></div>
				</div>
				<? 
					foreach ($pictures as $picture) {
						echo $picture; 
					} 
				?>
			</div>

			

			<div class="texts">
				<? 
					foreach ($texts as $text) {
						echo $text; 
					}
				?>
			</div>	
		</div>		
	</section>

	<section class="cours">
		<h2 class="hiddenBlock">les cours</h2>
		<div class="text">
			<p>La Rock School de Paris est une jeune école de musique qui enseigne le chant, la guitare, le piano, la basse et la batterie de manière ludique, fun et pédagogique à Paris et en proche banlieue. Les cours sont adaptés à la demande de l' élève et sont ouverts à tous âges et tous niveaux.
			L’école enseigne aussi bien du rock que du blues, de la funk, du reggae ou du jazz. A vous de décider !
			</p>
			<p>Car nous avons pleinement conscience que le solfège rebute beaucoup d'entre vous (nous récupérons un grand nombre d'élèves du conservatoire), nos professeurs en enseignent seulement les bases théoriques afin d'avoir les clés essentielles pour avancer rapidement.</p>
			<p>Dans les cas particuliers de la guitare et de la basse, nous utilisons aussi l'écriture simplifiée par tablatures (système de notation basé sur la position des doigts sur les cases et les cordes de l' instrument).</p>
			<p><img src="<?= get_stylesheet_directory_uri() ?>/static/img/home/coursTablature.jpg"  width="100%" alt=""></p>
			<p>Cette méthode permet d'acquérir des résultats rapidement et donne goût à la musique aux élèves en quelques accords.Bien évidemment, si nos musiciens en herbe souhaitent approfondir leurs connaissances solfègiques, nous serons tout à fait en mesure de leur enseigner.</p>
			<p class="subtitle">Le Petit Plus</p>
			<p>Lorsqu'un thème ou une chanson est en place, le professeur réalise une vidéo avec l'élève pour la partager sur notre site sur la page médias et les réseaux sociaux !</p>
		</div>
		<a href="/cours"class="button">En savoir + sur les cours</a>
		<div class="hands">
			<div class="hand1"></div>
			<div class="hand2"></div>
			<div class="hand3"></div>
		</div>
	</section>
	
	<section class="transition">
		<div class="content"></div>
	</section>

	<section class="prochainement">
		<h2 class="hiddenBlock">prochainement</h2>
		<?	
			// GET NEWS DATAS
			$months = array(
				'01' => 'JAN',
				'02' => 'FEV',
				'03' => 'MARS',
				'04' => 'AVR',
				'05' => 'MAI',
				'06' => 'JUIN',
				'07' => 'JUI',
				'08' => 'AOUT',
				'09' => 'SEPT',
				'10' => 'OCT',
				'11' => 'NOV',
				'12' => 'DEC'
				);
			$events = get_posts( array('post_type' => 'event','posts_per_page' => 2 ) );
			foreach ($events as $event) : setup_postdata( $event );
				$eventMetas = get_post_meta( $event->ID );
				if( $eventMetas['type'][0] == 'Période' ) {
					if( strtotime($eventMetas['fin'][0]) < time() ) continue;
				} else {
					if( strtotime($eventMetas['date'][0]) < time() ) continue;
				}
			?>
				<div class="actu hiddenBlock rollimage_parent_horizontal">
					<div class="image rollimage">
						<div class="date">
							<div class="content">
								<?
								if( $eventMetas['type'][0] == 'Période' ) {
									list($y, $m, $d) = split('[/.-]', $eventMetas['début'][0] );
									echo $d.' '. $months[$m] .'<b>/</b><br>';
									list($y, $m, $d) = split('[/.-]', $eventMetas['fin'][0] );
									echo $d.' '. $months[$m] .'<br><b>'.$y.'</b>';
								} else { 
									echo $eventMetas['heure'][0] .'h <b>/</b><br>';
									list($y, $m, $d) = split('[/.-]', $eventMetas['date'][0] );
									echo $d.' '. $months[$m] .'<br><b>'.$y.'</b>';
								} ?>
								
							</div>
						</div>
						<img src="<?= wp_get_attachment_url( get_post_thumbnail_id( $event->ID ) ) ?>" alt="">
					</div>
					<div class="text">
						<div class="content">
							<div class="title"><?= $event->post_title ?></div>
							<div class="baseline"><?= $eventMetas['baseline'][0] ?></div>
							<div class="description">
								<?= wpautop( $event->post_content ) ?>
							</div>
							<? if( $eventMetas['lien'][0] != '' ) { ?>
							<a href='<?= $eventMetas['lien'][0] ?>' <?if( $eventMetas['fenetre'][0] != '' ) echo 'target="_blank"'; ?> class="btn button smallButton">+ détails</a>
							<? } ?>
						</div>
					</div>
				</div>
			<?
			endforeach; wp_reset_postdata(); 
		?>
		<a href="/agenda"class="button">tout l’agenda</a>
		<div class="mediators">
			<div class="mediator1"></div>
			<div class="mediator2"></div>
			<div class="mediator3"></div>
		</div>
	</section>


<? include('medias_bloc.php'); ?>

<? get_footer() ?>