<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Veeco
 * @since 1.0
 * @version 1.0
 */
?>
<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>veeco-homepage</title>
    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <?php wp_enqueue_style('bootstrap'); ?>
    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">

    <?php wp_head(); ?>
    <style>
    .navbar-toggler {
        position: relative;
    }

    .navbar-toggler:focus,
    .navbar-toggler:active {
        outline: 0;
    }

    .navbar-toggler span {
        display: block;
        background-color: #444;
        height: 3px;
        width: 25px;
        margin-top: 4px;
        margin-bottom: 4px;
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
        position: relative;
        left: 0;
        opacity: 1;
    }

    .navbar-toggler span:nth-child(1),
    .navbar-toggler span:nth-child(3) {
        -webkit-transition: transform .35s ease-in-out;
        -moz-transition: transform .35s ease-in-out;
        -o-transition: transform .35s ease-in-out;
        transition: transform .35s ease-in-out;
    }

    .navbar-toggler:not(.collapsed) span:nth-child(1) {
        position: absolute;
        left: 12px;
        top: 10px;
        -webkit-transform: rotate(135deg);
        -moz-transform: rotate(135deg);
        -o-transform: rotate(135deg);
        transform: rotate(135deg);
        opacity: 0.9;
    }

    .navbar-toggler:not(.collapsed) span:nth-child(2) {
        height: 12px;
        visibility: hidden;
        background-color: transparent;
    }

    .navbar-toggler:not(.collapsed) span:nth-child(3) {
        position: absolute;
        left: 12px;
        top: 10px;
        -webkit-transform: rotate(-135deg);
        -moz-transform: rotate(-135deg);
        -o-transform: rotate(-135deg);
        transform: rotate(-135deg);
        opacity: 0.9;
    }
    </style>
 
</head>
<body id="page-top">
<div class="header">
    <div class="menu-bar">
        <!-- <nav class="navbar navbar-expand-lg navbar-light"> -->
        <!-- <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img class="img-fluid" src="<?php  header_image(); ?>"
                    alt="" id="Logo" /></a> -->
        <nav class="navbar navbar-expand-lg bg-faded">
            <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img class="img-fluid"
                    src="<?php  header_image(); ?>" alt="" id="Logo" /></a>
            <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse"
                data-target="#collapsingNavbar">
                <span> </span>
                <span> </span>
                <span> </span>
            </button>
            <!-- <a class="navbar-brand" href="#">
            Brand <i class="hidden-sm-down fa fa-star-o"></i>
        </a> -->
            <div class="collapse navbar-collapse" id="collapsingNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php wp_nav_menu( array(
                                'theme_location' => 'top',
                                'menu_id'        => 'top-menu',		 
                                'class'          => 'nav-link',
                            ) ); ?>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
