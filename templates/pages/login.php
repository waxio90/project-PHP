<section>
	<div class="box-message">
		<?php 
		  if (!empty($params['error'])) {
		      switch($params['error']) {
		          case 'errorLogin':
		              echo 'podany login nie istnieje';
		              break;
		          case 'wrongPassword':
		              echo 'podane hasło jest niepoprawne';
		              break;
		          case 'emptyData':
		              echo 'nie podano wymaganych danych do zalogowania';
		              break;
		          case 'loggedin':
		              echo 'aby dodać ogłoszenie należy się zalogować';
		              break;
		      }
		  }
		?>
		<?php 
		  if (!empty($params['before'])) {
		      switch($params['before']) {
		          case 'register':
		              echo 'rejestracja zakończona pomyślnie';
		              break;
		          case 'deleteUser':
		              echo 'konto zostało usunięte';
		              break;
		      }
		  }
		?>
	</div>
	<login>
    <div class="form">
    	<form action="/?action=login" method="post">
    		<h2>Zaloguj się</h2>
    		<div class="input-box">
    			<i class="fas fa-user"></i>
    			<input type="text" name="login" placeholder="login" required="" maxlength="30"/>
    		</div>
    		<div class="input-box">
    			<i class="fas fa-unlock"></i>
    			<input type="password" name="password" placeholder="hasło" required="" maxlength="30"/>
    		</div>
    		<div class="input-box">
    			<input type="submit" name="" value="Zaloguj"/>
    		</div>
    		<a href="/?action=register">Załóż konto</a>
    	</form>
    </div>
    </login>
</section>