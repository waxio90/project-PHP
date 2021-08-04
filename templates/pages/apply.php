	
<?php if(!empty($params['ad'])): ?>
<?php $ad = $params['ad']; ?>
<section>
	<div class="box-message">
		<?php 
		  if (!empty($params['error'])) {
		      switch($params['error']) {
		          case 'emptyData':
		              echo 'nie podano wszystkich wymaganych danych';
		              break;
		          case 'name':
		              echo 'wprowadzono błędne imię';
		              break;
		          case 'lastName':
		              echo 'wprowadzono błędne nazwisko';
		              break;
		          case 'emptyFile':
		              echo 'nie wybrano pliku do przesłania';
		              break;
		          case 'sizeFile':
		              echo 'załączony plik przekracza rozmiar 3MB';
		              break;
		          case 'typeFile':
		              echo 'załączony plik nie posiada rozszerzenia .PDF';
		              break;
		      }
		  }
		?>
	</div>
	<div class="container">	
		<div class="companyinfo">
			<div>
				<h2><?php echo $ad['position']?></h2>
				<ul class="info">
					<li>
						<span><i class="fas fa-map-marker-alt"></i></span>
						<span><?php echo $ad['locationCompany']?></span>
					</li>
					<li>
						<span><i class="fas fa-hand-holding-usd"></i></span>
						<span>
							<?php if (!empty($ad['salaryFrom'] or $ad['salaryTo'])): ?>
								<?php echo $ad['salaryFrom'] . " - " . $ad['salaryTo'] . " PLN "?>
                			<?php else :?>
                				<?php echo "Nie podano zarobków"?>
                			<?php endif;?>
						</span>
					</li>
				</ul>
			</div>
			<ul class="sci">
				<li><a href="#"><i class="far" style="margin-right:15px;"><?php echo $ad['company']?></i></a></li>
			</ul>
		</div>
		<div class="appform">
			<form action="/?action=apply" method="post" ENCTYPE="multipart/form-data">
			<input name="idOffer" type="hidden" value="<?php echo $ad['id'] ?>" />
			<input name="idUser" type="hidden" value="<?php echo $ad['id_user'] ?>" />
			<h2>Wyślij aplikację</h2>
			<div class="formBox">
				<div class="inputBox w50">
					<input type="text" name="name" required>
					<span>Imię</span>
				</div>
				<div class="inputBox w50">
					<input type="text" name="lastName" required>
					<span>Nazwisko</span>
				</div>
				<div class="inputBox w50">
					<input type="text" name="email" required>
					<span>Email</span>
				</div>
				<div class="inputBox w50">
					<input type="text" name="phone" required>
					<span>Telefon</span>
				</div>
				<div class="inputBox w50">
					<span>Plik CV .PDF max 3MB</span>
				</div>
				<div class="inputBox w50">
					<input type="file" name="fileCV" required>
				</div>
				<div class="inputBox w100">
					<textarea name="message" required></textarea>
					<span>Wiadomość do pracodawcy</span>
				</div>
				<div class="inputBox w100">
					<input type="submit" value="Aplikuj">
				</div>
			</div>
			</form>
		</div>
	</div>
</section>
<?php else: ?>
        <div>
            Brak ogłoszenia
            <a href="/"><button>Powrót do listy ogłoszeń</button></a>
        </div>
    <?php endif; ?>
