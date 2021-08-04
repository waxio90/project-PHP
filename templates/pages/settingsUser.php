<main>
	<div class="box-message">
		<?php 
		  if (!empty($params['error'])) {
		      switch($params['error']) {
		          case 'wrongPassword':
		              echo 'aktualne hasło jest niepoprawne';
		              break;
		          case 'confirmPassword':
		              echo 'podane nowe hasła nie są takie same';
		              break;
		          case 'checkPassword':
		              echo 'nowe hasło musi być inne niż stare hasło';
		              break;
		          case 'emptyData':
		              echo 'aby zmienić hasło należy wypełnić wszystkie pola';
		              break;
		      }
		  }
		?>
		<?php 
		  if (!empty($params['before'])) {
		      switch($params['before']) {
		          case 'changePassword':
		              echo 'hasło zostało zmienione';
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
	<div class="settingsBox">
		<div class="pass">
			<h2>Zmiana hasła</h2>
			<div class="formBox">
				<form action="/?action=settingsUser" method="post">
					<div class="box">
    					<span>Aktualne hasło</span>
    					<input type="password" name="oldPassword" />
					</div>
					<div class="box">
    					<span>Nowe hasło</span>
    					<input type="password" name="newPassword" />
					</div>
					<div class="box">
    					<span>Powtórz hasło</span>
    					<input type="password" name="confirmNewPassword" />
					</div>
					<div class="box">
    					<input type="submit" value="Zmień" />
					</div>
				</form>
			</div>
		</div>
		<div class="account">
			<h2>Usunięcie konta</h2>
			<a href="/?action=deleteUser"><input type="button" value="Usuń konto"/></a>
		</div>
	</div>
</main>