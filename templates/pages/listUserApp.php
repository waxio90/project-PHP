<main>
	<div class="box-message">
		<?php 
		  if (!empty($params['error'])) {
		      switch($params['error']) {
		          case 'emptyApp':
		              echo 'aplikacja nie istnieje';
		              break;
		          case 'notFound':
		              echo 'nie znaleziono aplikacji';
		      }
		  }
		?>
		<?php 
		  if (!empty($params['before'])) {
		      switch($params['before']) {
		          case 'delete':
		              echo 'aplikacja została usunięta';
		              break;
		      }
		  }
		?>
	</div>
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
	<?php if(!empty($params['app'])):?>
	<div class="tableBox">
		<div class="top">
			<div class="col">Imię</div>
			<div class="col">Nazwisko</div>
			<div class="col">Tytuł</div>
			<div class="col">Data</div>
			<div class="col">CV</div>
			<div class="col">Opcje</div>
		</div>
		<?php foreach ($params['app'] ?? [] as $app): ?>
		<div class="box">
			<div class="col"><?php echo $app['name']?></div>
			<div class="col"><?php echo $app['last_name']?></div>
			<div class="col"><?php echo $app['title']?></div>
			<div class="col"><?php echo $app['sended']?></div>
			<div class="col"><a href="/uploads/<?php echo $app['cv']?>"><i class="far fa-file-pdf"></i></a></div>
			<div class="col">
				<a href="/?action=deleteApp&id=<?php echo $app['id']?>" title="Usuń"><i class="far fa-trash-alt"></i></a>
				<a href="/?action=show&id=<?php echo $app['id_offer']?>" title="Link do ogłoszenia"><i class="fas fa-link"></i></a>
			</div>
		</div>
		<?php endforeach; ?> 
    	<?php else:?>
    	<div class="box-message">Brak aplikacji</div>
    	<?php endif;?>
	</div>
</main>