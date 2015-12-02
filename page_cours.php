<?
    /*
    Template Name: page cours
    */
    global $rockschool_pagename; 
    $rockschool_pagename = 'cours';

    get_header()
?>

	<section class="intro">
		<div class="bg"></div>
		<div class="text">les<h1>COURS</h1></div>
		<div class="scrolldown"></div>
	</section>

	<section class="presentation">
		<p>Des cours ludiques adaptés pour tout âge, tout niveau,<br>tout style pour progresser seul, en duo, en groupe<br>et en famille !<br><span></span></p>
	</section>

	<section class="transition">
		<div class="content"></div>
	</section>

	<section class="formules">

		<h2 class="hiddenBlock">LES FORMULES</h2>
		
		<div class="contain">

			<div class="paragraphintro hiddenBlock">
				<h3>À VOUS DE CHOISIR</h3>

				<p>La ROCK SCHOOL vous propose 4 types de formules adaptées à vos envies et besoins :<br><a href="">cours particulier à domicile</a>, <a href="">en binôme</a>, <a href="">en famille</a> et <a href="">en groupe</a>.</p>

				<p>Nous vous invitons à nous <a href="">CONTaCTER</a> pour toute autre demande (cours de 45min, de 2h, cours le dimanche etc.) afin de vous proposer un devis adapté à votre situation.</p>

				<p>Nos professeurs sont des prestataires de services travaillant sous le régime d'auto-entrepreneur. Nous vous proposons donc une alternative au chèque emploi service lourd de charges et de démarches administratives. Comme il s' agit d' un service à domicile vous bénéficiez d' une déduction fiscale de 50%.<br><i>ex. : 1h de cours facturée 40 euros vous reviendra donc à 20 euros après déduction.</i></p>

				<h4>Le Petit Plus</h4>

				<p><b>Tous nos nouveaux inscrits recevront un pack de Bienvenue Rock School de Paris contenant des médiators, stickers, casquette, t-shirt !</b></p>
			</div>

			<div class="line hiddenBlock rollimage_parent_horizontal">
				<div class="img rollimage">
					<img src="<?= get_stylesheet_directory_uri() ?>/static/img/cours/cours_domicile.jpg">
				</div>
				<div class="text smallbaseline">
					<div class="alignparent">
						<div class="alignchild">
							<h3>cours particulier<br>à domicile</h3>
								<div class="description">
								<h4>Forfait 1 trimestre</h4>
								<p>Frais d’inscription : <b class="blue">40€</b><br><span class="blue">12</span> cours à 240€ (après déduction fiscale)<br>soit <b>480€</b> en amont.</p>
								<h4>Forfait 2 trimestres</h4>
								<p>* Inscription offerte<br><span class="blue">24</span> cours à <b class="blue">480€</b> (après déduction fiscale)<br>soit <b>960€</b> en amont.</p>
								<h4>Forfait à l’année</h4>
								<p>* Inscription offerte + 1 cours offert<br><span class="blue">36</span> cours à <b class="blue">700€</b> (après déduction fiscale)<br>soit <b>1400€</b> en amont.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="line hiddenBlock rollimage_parent_horizontal">
				<div class="img rollimage">
					<img src="<?= get_stylesheet_directory_uri() ?>/static/img/cours/cours_duo.jpg">
				</div>
				<div class="text smallbaseline">
					<div class="alignparent">
						<div class="description alignchild">
							<h3>cours DUO</h3>

							<p>Frais d’inscription : <b class="blue">40€</b> par élève<br>Le cours d'une heure en binôme revient à <b class="blue">17,50€</b> (après déduction fiscale) soit <b>35€</b> en amont par élève au lieu de <b>40€</b>.</p>

							<div class="btn btnprice">17,50€ <span>/</span> Heure</div>
						</div>
					</div>
				</div>
			</div>

			<div class="line hiddenBlock rollimage_parent_horizontal">
				<div class="img rollimage">
					<img src="<?= get_stylesheet_directory_uri() ?>/static/img/cours/cours_famille.jpg">
				</div>
				<div class="text smallbaseline">
					<div class="alignparent">
						<div class="description alignchild">
							<h3>cours Famille</h3>

							<p>Frais d’inscription : <b class="blue">40€</b> par élève<br>En famille, le cours d'une heure revient à <b class="blue">18,75€</b> (après déduction fiscale) soit <b>37,50€</b> en amont par élève au lieu de <b>40€</b>.</p>

							<div class="btn btnprice">18,75€ <span>/</span> Heure</div>
						</div>
					</div>
				</div>
			</div>

			<div class="line hiddenBlock rollimage_parent_horizontal">
				<div class="img rollimage">
					<img src="<?= get_stylesheet_directory_uri() ?>/static/img/cours/cours_groupe.jpg">
				</div>
				<div class="text smallbaseline">
					<div class="alignparent">
						<div class="description alignchild">
							<h3>cours en groupe</h3>

							<p>Frais d’inscription : <b class="blue">15€</b> par élève<br>La formule idéale pour les étudiants et jeunes travailleurs.</p>
							<p>Les sessions ont lieu en studio professionel : <a href="">lA luna rossa</a>, <a href="">studio campus</a>, <a href="">studio bleu</a></p>
							<p>Elles sont composées de 4 à 6 élèves; l'ambiance est conviviale et permet de vivre une réelle expérience de groupe de Rock !</p>

							<div class="btn btnprice">15€ <span>/</span> Heure</div>
						</div>
					</div>
				</div>
			</div>

			<div class="line">
				<div class="button btnsummer">nous contacter sur les cours</div>
			</div>
		</div>

	</section>

	<section class="transition transition2">
		<div class="content"></div>
	</section>

<? include('medias_bloc.php'); ?>

<? get_footer() ?>