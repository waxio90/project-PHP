<section>
	<div class="box-message">
		<?php 
		  if (!empty($params['error'])) {
		      switch($params['error']) {
		          case 'emptyData':
		              echo 'nie podano wszystkoch wymaganych danych do rejestracji';
		              break;
		          case 'nameLogin':
		              echo 'podany login jest już zarejestrowany';
		              break;
		          case 'nameEmail':
		              echo 'podany email jest już zarejstrowany';
		              break;
		          case 'validLogin':
		              echo 'nie poprawna forma loginu';
		              break;
		          case 'confirmPassword':
		              echo 'podane hasła nie są takie same';
		              break;
		      }
		  }
		?>
	</div>
    <login>
        <div class="form">
        	<form action="/?action=register" method="post">
        		<h2>Utwórz konto</h2>
        		<div class="input-box">
        			<i class="fas fa-user"></i>
        			<input type="text" name="login" placeholder="login" required="" maxlength="30"/>
        		</div>
        		<div class="input-box">
        			<i class="fas fa-unlock"></i>
        			<input type="password" name="password" placeholder="hasło" required="" maxlength="30"/>
        		</div>
        		<div class="input-box">
        			<i class="fas fa-unlock"></i>
        			<input type="password" name="confirmPassword" placeholder="powtórz hasło" required="" maxlength="30"/>
        		</div>
        		<div class="input-box">
        			<i class="fas fa-at"></i>
        			<input type="email" name="email" placeholder="email" required="" maxlength="50"/>
        		</div>
        		<div class="input-box">
        			<input type="submit" name="" value="Utwórz"/>
        		</div>
        	</form>
        </div>
    </login>
</section>
