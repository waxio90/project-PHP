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
	<div class="box-info">
		<form action="/?action=deleteUser" method="post">
			<div class="box">
    			<div class="top">Czy chcesz usunąć konto z serwisu?</div>
    			<div class="button">
        			<input name="id" type="hidden" value="" />
        			<input type="submit" value="Tak"/>
        			<a href="/?action=settingsUser"><input type="button" value="Nie"/></a>
    			</div>
			</div>
		</form>
	</div>
</main>
