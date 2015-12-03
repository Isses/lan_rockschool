<?
    /*
    Template Name: page ecole
    */
    global $rockschool_pageurl;
	global $rockschool_pagecss;
	global $rockschool_pagetitle;
	global $rockschool_pageDesc;

    $rockschool_pageurl 	= '';
    $rockschool_pagecss 	= 'ecole';
    $rockschool_pagetitle 	= 'L\'ÉCOLE';
    $rockschool_pageDesc 	= 'Une équipe de jeunes musiciens professionnels et passionnés à votre service !';

    get_header()
?>

	<section class="intro">
		<div class="bg"></div>
		<div class="text"><h1>L'ÉCOLE</h1></div>
		<div class="scrolldown"></div>
	</section>

	<section class="presentation">
		<p>Une équipe de jeunes musiciens professionnels<br>et passionnés à votre service !<br><span></span></p>
	</section>

	<section class="transition">
		<div class="content"></div>
	</section>

	<section class="apropos">
		<h2 class="hiddenBlock">À PROPOS</h2>
		<div class="line line1 hiddenBlock rollimage_parent_horizontal">
			<p class="left"><span class="letterspace"></span><b>La Rock School de Paris est une jeune école de musique qui enseigne le chant, la guitare, le piano, la basse et la batterie de manière ludique, fun et pédagogiqueà Paris et en proche banlieue.</b><br><br>C’est une initiative du musicien professionnel <span class="blue">Tristan Gauthier</span>, professeur de guitare sur Paris depuis <span class="blue">2007</span>.<br><br>Sa méthode séduit rapidement un grand nombre d’élèves et il recrute alors des professeurs correspondants à son profil pour satisfaire la demande toujours croissante. C'est ainsi que naît la <span class="blue">Rock School</span> de Paris en <span class="blue">2013</span> !</p>
			<div class="rollimage right">
				<img src="<?= get_stylesheet_directory_uri() ?>/static/img/ecole/apropos_tristan_gauthier.jpg">
			</div>
		</div>
		<div class="line line2 hiddenBlock rollimage_parent_horizontal">
			<div class="rollimage left" style="border-radius: 160px; z-index:1;">
				<img src="<?= get_stylesheet_directory_uri() ?>/static/img/ecole/apropos_logo.jpg" >
			</div>
			<p class="right"><span class="letterspace"></span>L’équipe dee professeurs est constituée de jeunes professionnels multi-instrumentistes, pédagogues et bilingues qui transmettent le goût de la musique de la meilleure manière qu'il soit : ludique, adaptée aux envies et goûts de chacun !<br><br>L'école propose essentiellement des cours à domicile (le professeur se déplace chez l'élève), des cours en groupe en studio (plutôt destinés aux étudiants et jeunes travailleurs), ainsi que des stages de perfectionnement pendant les vacances tels que le <a href="/stages">SUMMER CAMP ROCK & SURF</a> à Royan en Charente-Maritime.<br><br><a href="/cours" class="button">En savoir + sur les cours</a></p>
		</div>

	</section>

	<section class="transition transition2">
		<div class="content"></div>
	</section>

	<section class="equipe">
		<h2 class="hiddenBlock">L'ÉQUIPE</h2>

		<div class="wall">
			
			<div class="mainline hiddenBlock rollimage_parent_horizontal">
				<div class="img rollimage">
					<div class="img" style="background:url('<?= get_stylesheet_directory_uri() ?>/static/img/ecole/tristan_gauthier.jpg') no-repeat center;"></div>
				</div>
				<div class="text">
					<div class="content">
					<div class="title">TRISTAN GAUTHIER</div>
					<div class="baseline">Fondateur, guitariste, batteur, chanteur</div>
					<div class="description">
						<p>Passionné de musique, il débute le piano à l’âge de 8 ans.<br>Son baladeur le suit alors partout avec les classiques de Mozart dans les oreilles ! La mode « Grunge » qui envahit les radios avec Nirvana en tête est une vraie révélation pour lui. Il se met alors à la guitare et apprend les bases nécessaires pour reprendre les chansons de ses artistes favoris avec un professeur.</p>
						<p>C'est l'heure des premières compositions et premiers concerts avec le groupe du lycée. Motivé comme jamais, il se met au chant, à la basse et à la batterie et s'intéresse au blues, la funk et le jazz.</p>
						<p>A 24 ans, Il quitte la Côte Atlantique pour Paris où il intègre plusieurs groupes et donne alors ses premiers cours. En parallèle, il poursuit une carrière solo et sort son premier <a href="">E.P. 5 titres “The Sunny Side Of The Street”</a> en Novembre 2015.</p>
					</div>
				</div>
				</div>
			</div>

			<div class="littleline lightblue hiddenBlock rollimage_parent_vertical">
				<div class="img rollimage">
					<div class="img" style="background:url('<?= get_stylesheet_directory_uri() ?>/static/img/ecole/desmond.jpg') no-repeat center;"></div>
				</div>
				<div class="text">
					<div class="title">DesmonD</div>
					<div class="baseline">guitare, chant</div>
				</div>
			</div>
			<div class="littleline white hiddenBlock rollimage_parent_vertical">
				<div class="img rollimage">
					<div class="img" style="background:url('<?= get_stylesheet_directory_uri() ?>/static/img/ecole/antoine.jpg') no-repeat center;"></div>
				</div>
				<div class="text">
					<div class="title">antoine</div>
					<div class="baseline">piano, guitare, chant</div>
				</div>
			</div>
			<div class="littleline blue hiddenBlock rollimage_parent_vertical">
				<div class="img rollimage">
					<div class="img" style="background:url('<?= get_stylesheet_directory_uri() ?>/static/img/ecole/louis_marin.jpg') no-repeat center;"></div>
				</div>
				<div class="text">
					<div class="title">Louis marin</div>
					<div class="baseline">batterie, basse, guitare</div>
				</div>
			</div>
			<div class="littleline white hiddenBlock rollimage_parent_vertical">
				<div class="img rollimage">
					<div class="img" style="background:url('<?= get_stylesheet_directory_uri() ?>/static/img/ecole/baptiste.jpg') no-repeat center;"></div>
				</div>
				<div class="text">
					<div class="title">Baptiste</div>
					<div class="baseline">guitare</div>
				</div>
			</div>
			<div class="littleline blue hiddenBlock rollimage_parent_vertical">
				<div class="img rollimage">
					<div class="img" style="background:url('<?= get_stylesheet_directory_uri() ?>/static/img/ecole/remi.jpg') no-repeat center;"></div>
				</div>
				<div class="text">
					<div class="title">rémi</div>
					<div class="baseline">piano, guitare</div>
				</div>
			</div>
			<div class="littleline lightblue hiddenBlock rollimage_parent_vertical">
				<div class="img rollimage">
					<div class="img" style="background:url('<?= get_stylesheet_directory_uri() ?>/static/img/ecole/victor.jpg') no-repeat center;"></div>
				</div>
				<div class="text">
					<div class="title">VICTOR</div>
					<div class="baseline">piano, chant</div>
				</div>
			</div>

		</div>

	</section>

<? get_footer() ?>