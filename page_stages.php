<?
    /*
    Template Name: page stages
    */
    global $rockschool_pagename; 
    $rockschool_pagename = 'stages';

    get_header()
?>

	<section class="intro">
		<div class="bg"></div>
		<div class="text">les<h1>STAGES</h1></div>
		<div class="scrolldown"></div>
	</section>

	<section class="presentation">
		<p>Des stages pour progresser et s’amuser<br>tout au long de l’année !<br><span></span></p>
	</section>

	<section class="unis">TRISTAN SKATE</section>

	<section class="formules">

		<h2 class="hiddenBlock">LES FORMULES</h2>
		
		<div class="contain">

			<div class="paragraphintro">
				<h3>KEEP ON SWINGING !</h3>

				<p>Chaque année pendant les vacances scolaires, l'école ne ferme pas ses portes ! Au contraire, nous profitons de ce temps libre pour mettre en place des stages en groupe qui mêlent travail de composition, répétitions en studio professionnel, enregistrement et même tournage de clip !</p>
				<p></p>

				<p>Découvrez nos stages de <a href="">summer camp</a> et <a href="">durant les vacances scolaires</a></p>

				<p>Nous proposons également une formule <b>stage intensiF individuel</b> où l'élève et le professeur se rencontre du lundi au vendredi pour se focaliser sur un style de musique en particulier ou bien une technique de jeu spécifique.<br>Nous vous invitons à nous <a href="">CONTACTER</a> afin de vous proposer un devis adapté.</p>
			</div>

			<div class="line hiddenBlock rollimage_parent_horizontal">
				<div class="img rollimage">
					<img src="<?= get_stylesheet_directory_uri() ?>/static/img/stages/summer_camp_1.jpg">
				</div>
				<div class="text">
					<h3>LE SUMMER CAMP</h3>
					
					<span class="baseline">1 semaine Rock’n’Surf pendant l’été</span>

					<p>Le stage dure 1 semaine (entre le 1er juillet et le 31 août) et se déroule à Royan en Charente-Maritime (17).</p>
					<p>Les élèves sont logés dans une grande maison de campagne typiquement charentaise. C'est une ancienne colonie de vacances avec une dizaine de chambres, un studio de musique, deux jardins, cuisine et salon.</p>
					<p>Plusieurs chansons sont mises en place dans l’objectif de les enregistrer avec un ingénieur du son professionel.  C’est aussi l’occasion de vivre une vraie expérience de  groupe tout en améliorant le jeu de chacun !</p>
					<p>Pour clore le stage, un ou plusieurs titres sont joués par les élèves au <a href="">tina’s café</a>, un café concert réputé de la région tenu par des artistes sur une plage de l’estuaire de la Gironde.</p>
				</div>
			</div>

			<div class="line hiddenBlock rollimage_parent_horizontal">
				<div class="img rollimage">
					<img src="<?= get_stylesheet_directory_uri() ?>/static/img/stages/summer_camp_2.jpg">
				</div>
				<div class="text">
					<span class="baseline">Good vibrations !</span>

					<p>En alternance avec les leçons, nous profiterons de l'océan (à 15 min. de l’hébergement) pour aller surfer !</p>
					<p>Les cours se font avec un professeur diplômé d’état de l'école de surf <a href="">le spot</a>.</p>
					<p>D'autres activités comme du bateau, une randonnée VTT, du cheval sur l'Île d'Oléron sont aussi au programme. Cette semaine sera filmée et une vidéo souvenir sera envoyée aux élèves et mise en ligne sur Youtube après le stage.</p>

					<div class="btnprice">850€ <span>/</span> Personne</div>
				</div>
			</div>

			<div class="line">
				<div class="button btnsummer">nous contacter pour le summer camp</div>
			</div>

			<h3 class="blue">et pendant les <span>(petites)</span> vacances</h3>

			<div class="line hiddenBlock rollimage_parent_horizontal">
				<div class="img rollimage">
					<img src="<?= get_stylesheet_directory_uri() ?>/static/img/stages/stages_vacances.jpg">
				</div>
				<div class="text smallbaseline">
					<span class="baseline">Printemps</span>
					<p>Du lundi 20 Octobre au vendredi 30 Octobre</p>

					<span class="baseline">Toussaint</span>
					<p>Du lundi 20 au vendredi 30 Octobre</p>

					<span class="baseline">Toussaint</span>
					<p>Du lundi 20 Octobre au vendredi 30 Octobre</p>
					<p>L'occasion pour les élèves de se rencontrer et de former un vrai groupe de rock !<br>Le stage se déroule du lundi au vendredi à raison de 3 heures par jour (en matinée ou après-midi selon la demande).</p>
					<p>Au programme : mise en place de chansons (reprises ou compositions), répétition dans un studio professionnel ( <a href="">lA luna rossa</a>, <a href="">studio campus</a>,  <a href="">studio bleu</a> ), enregistrement audio, réalisation d'un clip et initiation aux autres instruments.</p>

					<div class="btnprice">250€ <span>/</span> Personne</div>
				</div>
			</div>

			<div class="line">
				<div class="button btnsummer left">nous contacter pour les stages vacances</div>
			</div>
		</div>

	</section>

	<section class="transition">
		<div class="content"></div>
	</section>

<? include('medias_bloc.php'); ?>

<? get_footer() ?>