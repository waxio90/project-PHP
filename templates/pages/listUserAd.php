<main>
	<div class="box-message">
		<?php 
		  if (!empty($params['error'])) {
		      switch($params['error']) {
		          case 'notFound':
		              echo 'nie znaleziono ogłoszenia';
		              break;
		      }
		  }
		?>
		<?php 
		  if (!empty($params['before'])) {
		      switch($params['before']) {
		          case 'delete':
		              echo 'ogłoszenie zostało usunięte';
		              break;
		          case 'update':
		              echo 'zaktualizowano ogłoszenie';
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
	<?php if(!empty($params['listAd'])):?>
	<div class="tableBox">
		<div class="top">
			<div class="col">id</div>
			<div class="col">Tytuł</div>
			<div class="col">Dodano</div>
			<div class="col">Odsłony</div>
			<div class="col">Opcje</div>
		</div>
		<?php foreach ($params['listAd'] ?? [] as $ad): ?>
		<div class="box">
			<div class="col"><?php echo $ad['id']?></div>
			<div class="col"><?php echo $ad['title']?></div>
			<div class="col"><?php echo $ad['created']?></div>
			<div class="col"><?php echo $ad['counter']?></div>
			<div class="col">
				<a href="/?action=editAd&id=<?php echo $ad['id']?>" title="Edytuj"><i class="far fa-edit"></i></a>
    			<a href="/?action=deleteAd&id=<?php echo $ad['id']?>" title="Usuń"><i class="far fa-trash-alt"></i></a>
    			<a href="/?action=show&id=<?php echo $ad['id']?>" title="Link do ogłoszenia"><i class="fas fa-link"></i></a>
			</div>
		</div>
		<?php endforeach; ?> 
    	<?php else:?>
    	<div class="box-message">Nie posiadasz ogłoszeń</div>
    	<?php endif;?>
	</div>
</main>
	
	
	












