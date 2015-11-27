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
				$textEl = str_replace("%description%", get_the_excerpt() , $textEl );
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
		<div class="actu">
			<div class="date">
				<div class="content">
					22 FEV <b>/</b><br>
					24 MARS<br>
					<b>2016</b>
				</div>
			</div>
			<div class="image"><img src="<?= get_stylesheet_directory_uri() ?>/static/img/home/actu1.jpg" alt=""></div>
			<div class="text">
				<div class="content">
					<div class="title">stage d’ hiver</div>
					<div class="baseline">Inscriptions ouvertes</div>
					<div class="description">
						<p>Pendant une semaine, nous travaillerons la mise en place d'une ou plusieurs chansons avec répétition en studio, son enregistrement pro et en souvenir un clip vidéo !</p>
					</div>
					<div class="button smallButton">+ détails</div>
				</div>
			</div>
		</div>
		<div class="actu">
			<div class="date">
				<div class="content">
					17h <b>/</b><br>
					12 DÉC<br>
					<b>2015</b>
				</div>
			</div>
			<div class="image"><img src="<?= get_stylesheet_directory_uri() ?>/static/img/home/actu2.jpg" alt=""></div>
			<div class="text">
				<div class="content">
					<div class="title">concert de noël</div>
					<div class="baseline">Pour finir ensemble 2015 en beauté !</div>
					<div class="description">
						<p>Rien de mieux qu'un concert des élèves et des professeurs pour se souhaiter de bonnes fêtes de fin d’année !</p>
						<p>L'évènement se passera dans le sympathique bar le Charlie. Les élèves ouvriront le bal avec leurs morceaux et les professeurs animeront la deuxième partie de soirée.<br>
						Concert gratuit ! P.S. : gâteaux fait maison bienvenus !</p>
						<p>INFOS PRATIQUES : Le Charlie - 29 Rue de Cotte 75012 Paris Métro : ligne 8 station Ledru Rollin. </p>
					</div>
				</div>
			</div>
		</div>
		<a href="/agenda"class="button">tout l’agenda</a>
		<div class="mediators">
			<div class="mediator1"></div>
			<div class="mediator2"></div>
			<div class="mediator3"></div>
		</div>
	</section>


<? include('medias_bloc.php'); ?>

<? get_footer() ?>