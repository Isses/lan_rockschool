<?  
	global $rockschool_pageurl;
	global $rockschool_pagecss;
	global $rockschool_pagetitle;
	global $rockschool_pageDesc;

    $rockschool_pageurl 	= '';
    $rockschool_pagecss 	= 'p404';
    $rockschool_pagetitle 	= 'PAGE INTROUVABLE';
    $rockschool_pageDesc 	= 'Cette page n\'existe pas';

    get_header();
?>

	<section>
		
		<div class="content">
			<div class="alert">page introuvable</div>
			<a class="backHome" href="/">ACCUEIL</a>
		</div>
			
	</section>
<? get_footer() ?>