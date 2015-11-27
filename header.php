<?php 
    global $rockschool_pagename; 
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="author" content="LANFOSTER"/>
    <meta name="dcterms.rightsHolder" content="Rock School">
    <meta name="description" content="<?=$translates['facebook_description'][$lang]?>"/>
    <meta name="keywords" content=""/>
    <meta name="robots" content="index, follow"/>
    <meta name="viewport" content="width=1024, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <title>ROCK SCHOOL - </title>

    <!-- Metas FB -->
    <meta property="og:title" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="">
    
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
    </script>
    

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/reset.css"/>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/fonts.css"/>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/global.css"/>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/nav.css"/>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/static/css/<?= $rockschool_pagename ?>.css"/>
    
    <!-- Favicon -->
    <link rel="shortcut icon"          href="<?= get_stylesheet_directory_uri() ?>/static/img/favicon.png"/>
    <link rel="icon" type="image/png"  href="<?= get_stylesheet_directory_uri() ?>/static/img/favicon.png" />

</head>

<body class="<?= $rockschool_pagename ?>">

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
