<?php 
    global $rockschool_pageurl;
    global $rockschool_pagecss;
    global $rockschool_pagetitle;
    global $rockschool_pageDesc;
    $rockschool_pageImg = get_stylesheet_directory_uri() . "/static/img/share.jpg";
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="author" content="LANFOSTER"/>
    <meta name="dcterms.rightsHolder" content="Rock School">
    <meta name="description" content="><?= $rockschool_pageDesc ?>"/>
    <meta name="keywords" content=""/>
    <meta name="robots" content="index, follow"/>
    <meta name="viewport" content="width=1024, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <title>ROCK SCHOOL - <?= $rockschool_pagetitle ?></title>

    <?
        $albumID = get_query_var( 'albumID', null );
        if( $albumID && !is_nan( $albumID )) {
            $album = get_post( $albumID );
            $rockschool_pagetitle = $album->post_title;
            $rockschool_pageDesc = $album->post_excerpt;
            $rockschool_pageImg = wp_get_attachment_url( get_post_thumbnail_id( $albumID ) );
        }
    ?>
    <!-- Metas FB -->
    <meta property="og:title" content=">ROCK SCHOOL - <?= $rockschool_pagetitle ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://www.rockschool.paris/<?= $rockschool_pageurl ?>">
    <meta property="og:image" content="<?= $rockschool_pageImg ?>">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:description" content="<?= $rockschool_pageDesc ?>">
    <meta property="og:site_name" content="ROCK SCHOOL">
    
    <script type='text/javascript'>
        document.createElement("header");
        document.createElement("footer");
        document.createElement("section");
        document.createElement("aside");
        document.createElement("nav");
        document.createElement("article");
        document.createElement("figure");
        document.createElement("figcaption");
        document.createElement("hgroup");
        document.createElement("time");

        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>
    

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/reset.css"/>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/fonts.css"/>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/global.css"/>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/nav.css"/>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/albumViewer.css"/>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/<?= $rockschool_pagecss ?>.css"/>
    
    <!-- Favicon -->
    <link rel="shortcut icon"          href="<?= get_stylesheet_directory_uri() ?>/static/img/favicon.png"/>
    <link rel="icon" type="image/png"  href="<?= get_stylesheet_directory_uri() ?>/static/img/favicon.png" />

</head>

<body class="<?= $rockschool_pagecss ?>">

    <!-- HEADER -->
    <header>

        <a href="/" class="logo"></a>
        <ul>
            <li><a <? if(is_page('ecole'))       echo 'class="active"'; ?>href="/ecole">L'ÉCOLE</a></li>
            <li><a <? if(is_page('agenda'))      echo 'class="active"'; ?>href="/agenda">AGENDA</a></li>
            <li><a <? if(is_page('cours'))       echo 'class="active"'; ?>href="/cours">COURS</a></li>
            <li><a <? if(is_page('stages'))      echo 'class="active"'; ?>href="/stages">STAGES</a></li>
            <li><a <? if(is_page('temoignages')) echo 'class="active"'; ?>href="/temoignages">TÉMOIGNAGES</a></li>
            <li><a <? if(is_page('medias'))      echo 'class="active"'; ?>href="/medias">MÉDIAS</a></li>
        </ul>
        
    </header>
