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
	<?php $app = $params['app'] ?? null; ?>
	<?php if($app): ?>
	<div class="tableBox">
		<div class="top">
    		<div class="col">Imię</div>
    		<div class="col">Nazwisko</div>
    		<div class="col">Email</div>
    		<div class="col">Telefon</div>
    		<div class="col">Przesłano</div>
    		<div class="col">CV</div>
    	</div>
    	<div class="box">
    		<div class="col"><?php echo $app['name']?></div>
    		<div class="col"><?php echo $app['last_name']?></div>
    		<div class="col"><?php echo $app['email']?></div>
    		<div class="col"><?php echo $app['phone']?></div>
    		<div class="col"><?php echo $app['sended']?></div>
    		<div class="col"><a href="/uploads/<?php echo $app['cv']?>"><i class="far fa-file-pdf"></i></a></div>
    	</div>
	</div>
	<div class="box-info">
		<form action="/?action=deleteApp" method="post">
			<div class="box">
    			<div class="top">Czy usunąć tą aplikacje?</div>
    			<div class="button">
        			<input name="id" type="hidden" value="<?php echo $app['id'] ?>" />
        			<input type="submit" value="Tak"/>
        			<a href="/?action=listUserApp"><input type="button" value="Nie"/></a>
    			</div>
			</div>
		</form>
	</div>
	<?php else: ?>
        <div>Brak aplikacji do wyświetlenia</div>
    <?php endif; ?>
</main>