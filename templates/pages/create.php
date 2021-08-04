<section>
	<div class="box-message">
		<?php 
		  if (!empty($params['error'])) {
		      switch($params['error']) {
		          case 'emptyData':
		              echo 'nie podano wszystkoch wymaganych danych do ogłoszenia';
		              break;
		          case 'locationCompany':
		              echo 'wprowadzono błędne miasto';
		              break;
		      }
		  }
		?>
	</div>
	<div class="container">	
		<h2>Formularz ogłoszenia</h2>
		<div class="formAd">
			<form action="/?action=create" method="post">
			<div class="formBox">
				<div class="inputBox w50">
					<input type="text" name="company" placeholder="firma" required minlength="3" maxlength="150">
				</div>
				<div class="inputBox w50">
					<input type="text" name="locationCompany" placeholder="miasto" required minlength="3" maxlength="30">
				</div>
				<div class="inputBox w50">
					<input type="text" name="title" placeholder="tytuł" required minlength="5" maxlength="100">
				</div>
				<div class="inputBox w100">
					<textarea name="descriptionCompany" required placeholder="opis firmy" minlength="10" maxlength="10000"></textarea>
				</div>
				<div class="inputBox w50">
					<input type="text" name="position" placeholder="stanowisko" required minlength="5" maxlength="100">
				</div>
				<div class="inputBox w50">
        			<select name="level" class="field-long">
        				<option>Junior</option>
        				<option>Mid</option>
        				<option>Senior</option>
        			</select>
				</div>
				<div class="inputBox w50">
        			<select name="contract" class="field-long">
        				<option>B2B</option>
        				<option>UoP</option>
        				<option>UoZ</option>
        				<option>UoD</option>
        				<option>Do ustalenia</option>
        			</select>
				</div>
				<div class="inputBox w50">
        			<select name="locationJob" class="field-long">
        				<option>Zdalnie</option>
        				<option>Sidziba firmy</option>
        				<option>Hybrydowo</option>
        			</select>
				</div>
				<div class="inputBox w50">
					<input type="number" name="salaryFrom" placeholder="wynagrodzenie od" required  minlength="3" maxlength="6">
				</div>
				<div class="inputBox w50">
					<input type="number" name="salaryTo" placeholder="wynagrodzenie do" required minlength="3" maxlength="6">
				</div>
				<div class="inputBox w50">
        			<select name="salary" class="field-long">
        				<option>netto</option>
        				<option>brutto</option>
        			</select>
				</div>
				<div class="inputBox w50">
        			<select name="currency" class="field-long">
        				<option>PLN</option>
        				<option>EUR</option>
        				<option>USD</option>
        			</select>
				</div>
				<div class="inputBox w100">
					<textarea name="descriptionNeeds" required placeholder="tresć ogłoszenia" minlength="10" maxlength="10000"></textarea>
				</div>
				<div class="inputBox w100">
					<input type="submit" value="Utwórz">
				</div>
			</div>
			</form>
		</div>
	</div>
</section>