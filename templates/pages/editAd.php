<main>
    <div class="navi">
		</div>
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
<div>
<?php $ad = $params['ad'] ?? null; ?>
<?php if($ad): ?>

<div class="container">	
		<h2>Edycja ogłoszenia</h2>
		<div class="formAd">
			<form action="/?action=editAd" method="post">
			<input name="id" type="hidden" value="<?php echo $ad['id']?>"/>
			<div class="formBox">
				<div class="inputBox w50">
					<input type="text" name="company" placeholder="firma" required minlength="3" maxlength="150" value="<?php echo $ad['company']?>"/>
				</div>
				<div class="inputBox w50">
					<input type="text" name="locationCompany" placeholder="miasto" required minlength="3" maxlength="30" value="<?php echo $ad['locationCompany']?>">
				</div>
				<div class="inputBox w50">
					<input type="text" name="title" placeholder="tytuł" required minlength="5" maxlength="100" value="<?php echo $ad['title']?>">
				</div>
				<div class="inputBox w100">
					<textarea name="descriptionCompany" required placeholder="opis firmy" minlength="10" maxlength="10000"><?php echo $ad['descriptionCompany']?></textarea>
				</div>
				<div class="inputBox w50">
					<input type="text" name="position" placeholder="stanowisko" required minlength="5" maxlength="100" value="<?php echo $ad['position']?>">
				</div>
				<div class="inputBox w50">
        			<select name="level" class="field-long">
        				<option><?php echo $ad['level']?></option>
        				<option>Junior</option>
        				<option>Mid</option>
        				<option>Senior</option>
        			</select>
				</div>
				<div class="inputBox w50">
        			<select name="contract" class="field-long">
        				<option><?php echo $ad['contract']?></option>
        				<option>B2B</option>
        				<option>UoP</option>
        				<option>UoZ</option>
        				<option>UoD</option>
        				<option>Do ustalenia</option>
        			</select>
				</div>
				<div class="inputBox w50">
        			<select name="locationJob" class="field-long">
        				<option><?php echo $ad['locationJob']?></option>
        				<option>Zdalnie</option>
        				<option>Sidziba firmy</option>
        				<option>Hybrydowo</option>
        			</select>
				</div>
				<div class="inputBox w50">
					<input type="number" name="salaryFrom" placeholder="wynagrodzenie od" required  minlength="3" maxlength="6" value="<?php echo $ad['salaryFrom']?>">
				</div>
				<div class="inputBox w50">
					<input type="number" name="salaryTo" placeholder="wynagrodzenie do" required minlength="3" maxlength="6" value="<?php echo $ad['salaryTo']?>">
				</div>
				<div class="inputBox w50">
        			<select name="salary" class="field-long">
        				<option><?php echo $ad['salary']?></option>
        				<option>netto</option>
        				<option>brutto</option>
        			</select>
				</div>
				<div class="inputBox w50">
        			<select name="currency" class="field-long">
        				<option><?php echo $ad['currency']?></option>
        				<option>PLN</option>
        				<option>EUR</option>
        				<option>USD</option>
        			</select>
				</div>
				<div class="inputBox w100">
					<textarea name="descriptionNeeds" required placeholder="tresć ogłoszenia" minlength="10" maxlength="10000"><?php echo $ad['descriptionNeeds']?></textarea>
				</div>
				<div class="inputBox w100">
					<input type="submit" value="Zapisz">
				</div>
				<div class="inputBox w100">
					<a href="/?action=listUserAd"><input type="button" value="Wróć"/></a>
				</div>
			</div>
			</form>
		</div>
	</div>
        <?php else: ?>
		<div>Brak ogłoszenia do wylenia</div>
	<?php endif; ?>
	</div>
	</main>