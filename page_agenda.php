<?
    /*
    Template Name: page agenda
    */
  	global $rockschool_pageurl;
	global $rockschool_pagecss;
	global $rockschool_pagetitle;
	global $rockschool_pageDesc;

    $rockschool_pageurl 	= '';
    $rockschool_pagecss 	= 'agenda';
    $rockschool_pagetitle 	= 'L\'AGENDA';
    $rockschool_pageDesc 	= 'C\'est quand le tournage de mon prochain clip ? Et le prochain concert ? à vos agendas !';

    get_header()
?>

	<section class="intro">
		<div class="bg"></div>
		<div class="text"><h1>AGENDA</h1></div>
		<div class="scrolldown"></div>
	</section>

	<section class="presentation hiddenBlock">
		<p>C'est quand le tournage de mon prochain clip ?</p><p>Et le prochain concert ? à vos agendas !</p><span></span>
	</section>

	<section class="transition">
		<div class="content"></div>
	</section>

	<section class="prochainement">
		<h2 class="hiddenBlock">prochainement...</h2>
		<?				
		$events 		= getEvents();
		$eventsCount 	= count($events);

		switch ($eventsCount) {
			case 3:
			case 2:
			case 1:
				$firstBlocCount = $eventsCount;
				break;

			case 5:
			case 4:
				$firstBlocCount = 2;
				break;
			
			default:
				if( $firstBlocCount%3 == 0 ) $firstBlocCount = 3;
				else $firstBlocCount = 2;
				break;
		}
		$eventNumber = 0 ; 
		foreach ($events as $event) {
			if( $eventNumber < 3 && $eventNumber < $firstBlocCount ) {
		?>
		<div class="actu hiddenBlock rollimage_parent_horizontal">
			<div class="image rollimage">
				<div class="date">
					<div class="content">
						<?
						if( $event['type'] == 'Période' ) {
							list($y, $m, $d) = split('[/.-]', $event['début'] );
							echo $d.' '. $months[$m] .'<b>/</b><br>';
							list($y, $m, $d) = split('[/.-]', $event['fin'] );
							echo $d.' '. $months[$m] .'<br><b>'.$y.'</b>';
						} else { 
							echo $event['heure'][0] .'h <b>/</b><br>';
							list($y, $m, $d) = split('[/.-]', $event['date'] );
							echo $d.' '. $months[$m] .'<br><b>'.$y.'</b>';
						} ?>
						
					</div>
				</div>
				<img src="<?= $event['imgSrc'] ?>" alt="">
			</div>
			<div class="text">
				<div class="content">
					<div class="title"><?= $event['title'] ?></div>
					<div class="baseline"><?= $event['baseline'] ?></div>
					<div class="description">
						<?= $event['description'] ?>
					</div>
					<? if( $event['lien'] != '' ) { ?>
					<a href='<?= $event['lien'] ?>' <?if( $event['fenetre'] != '' ) echo 'target="_blank"'; ?> class="btn button smallButton">+ détails</a>
					<? } ?>
				</div>
			</div>
		</div>
		<? ++$eventNumber;
			}
		} ?>

		<div class="mediators">
			<div class="mediator mediator1"></div>
			<div class="mediator mediator2"></div>
			<div class="mediator mediator3"></div>
			<div class="mediator mediator4"></div>
		</div>
	</section>


	<section class="transition transition2">
		<div class="content"></div>
	</section>
	
	<? if( $firstBlocCount < $eventsCount ) { ?>
	<section class="plustard">
		<h2 class="hiddenBlock">...ET UN PEU PLUS TARD</h2>

		<div class="wall">
			<?
			$wallCount = 0;
			$wallColor = array('white','red','brown','brown','red','white');
			foreach ($events as $event) {
				if( $wallCount >= $firstBlocCount ){
					$color = $wallColor[($wallCount-$firstBlocCount)%6];
					
			?>
			<div class="littleline <?= $color ?> hiddenBlock rollimage_parent_vertical">
				<div class="date">
					<div class="content">
						<?
						if( $event['type'] == 'Période' ) {
							list($y, $m, $d) = split('[/.-]', $event['début'] );
							echo $d.' '. $months[$m] .'<b>/</b><br>';
							list($y, $m, $d) = split('[/.-]', $event['fin'] );
							echo $d.' '. $months[$m] .'<br><b>'.$y.'</b>';
						} else { 
							echo $event['heure'][0] .'h <b>/</b><br>';
							list($y, $m, $d) = split('[/.-]', $event['date'] );
							echo $d.' '. $months[$m] .'<br><b>'.$y.'</b>';
						} ?>
						
					</div>
				</div>
				<div class="rollimage">
					<div class="img" style="background-image:url('<?= $event['imgSrc']?>');"></div>
				</div>
				<div class="text">
					<div class="title"><?= $event['title'] ?></div>
					<div class="baseline"><?= $event['baseline'] ?></div>
					<div class="moreinfos"><?= $event['description'] ?></div>
					<? /*if( $event['lien'] != '' ) { ?>
					<div class="moreinfosbtn">
						<a href='<?= $event['lien'] ?>' <?if( $event['fenetre'] != '' ) echo 'target="_blank"'; ?> class="button btn">+ DÉTAILS</a>
					</div>
					<? } */?>
					<div class="moreinfosbtn">
						<a href='#' class="button btn">+ DÉTAILS</a>
					</div>
					
				</div>
			</div>
			<? } ++$wallCount; } 

			if( ($wallCount-$firstBlocCount)%3 != 0 ) {?>
			<div class="littleline empty hiddenBlock rollimage_parent_vertical">				
				<div class="rollimage">
					<div class="img" style="background:url('<?= get_stylesheet_directory_uri() ?>/static/img/agenda/emptyEvent.jpg') no-repeat center;"></div>
				</div>				
			</div>
			<? } ?>
		</div>
	</section>
	<? } ?>

<? get_footer() ?>