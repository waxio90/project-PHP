<!DOCTYPE html>
<html lang="pl">
    <head>
        <title>IT Job offers</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
        <link href="public/style.css" rel="stylesheet">
    </head>
    <body>
    	<header>
    		<a href="#" class="logo">It Job Offers</a>
    		<ul class="navigation">
    			<li><a href="/">Oferty</a></li>
    			<li><a href="/?action=create">Dodaj ogłoszenie</a></li>
    			<li><a href="/?action=login">Moje Konto</a></li>
    		</ul>
    		<div class="search">
    			<form action="/" method="get">
    			<input type="text" name="phrase" placeholder="Szukaj ofert">
    			<i class="fa fa-search" aria-hidden="true"></i>
    			</form>
    		</div>
    	</header>
    	<?php require_once("templates/pages/$page.php") ?>
    </body>
</html>