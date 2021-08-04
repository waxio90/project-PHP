<main>
	<div class="navi">
		<div class="button" onclick="window.location='/?action=listUserAd'">
			<div class="ico"><i class="fas fa-clipboard-list"></i></div>
			<div class="title">Ogłoszenia</div>
		</div>
		<div class="button" onclick="window.location='/?action=listUserApp'">
			<div class="ico"><i class="far fa-envelope"></i></div>
			<div class="title">Aplikacje</div>
		</div>
		<div class="button" onclick="window.location='/?action=settingsUser'">
			<div class="ico"><i class="fas fa-cogs"></i></div>
			<div class="title">Ustawienia</div>
		</div>
		<div class="button" onclick="window.location='/?action=logout'">
			<div class="ico"><i class="fas fa-sign-out-alt"></i></div>
			<div class="title">Wyloguj</div>
		</div>
	</div>
	<?php $ad = $params['ad'] ?? null; ?>
	<?php if($ad): ?>
	<div class="tableBox">
		<div class="top">
    		<div class="col">Id</div>
    		<div class="col">Tytuł</div>
    		<div class="col">Dodano</div>
    		<div class="col">Odsłony</div>
    		<div class="col">Link</div>
    	</div>
    	<div class="box">
    		<div class="col"><?php echo $ad['id']?></div>
    		<div class="col"><?php echo $ad['title']?></div>
    		<div class="col"><?php echo $ad['created']?></div>
    		<div class="col"><?php echo $ad['counter']?></div>
    		<div class="col"><a href="/?action=show&id=<?php echo $ad['id']?>" title="Link do ogłoszenia"><i class="fas fa-link"></i></a></div>
    	</div>
	</div>
	<div class="box-info">
		<form action="/?action=deleteAd" method="post">
			<div class="info">!! Usunięcie ogłoszenia usunie również aplikacje powiązane z nim !!</div>
			<div class="box">
    			<div class="top">Czy usunąć to ogłoszenie?</div>
    			<div class="button">
        			<input name="id" type="hidden" value="<?php echo $ad['id'] ?>" />
        			<input type="submit" value="Tak"/>
        			<a href="/?action=listUserAd"><input type="button" value="Nie"/></a>
    			</div>
			</div>
		</form>
	</div>
	<?php else: ?>
        <div>Brak ogłoszenia do wyświetlenia</div>
    <?php endif; ?>
</main>