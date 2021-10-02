	<?php $ad = $params['ad'] ?? null; ?>
	<?php 
	   $date = date('Y-m-d H:m:s');
	   $day = round((strtotime($date) - strtotime($ad['created']))/86400);
	?>
	<?php if($ad): ?>

<section>
	<div class="box-message">
		<?php 
		  if (!empty($params['before'])) {
		      switch($params['before']) {
		          case 'apply':
		              echo 'aplikacja została wysłana';
		              break;
		      }
		  }
		?>
	</div>
	<div class="container">	
		<div class="box">
    		<div class="topBox">
    			<h2><?php echo $ad['position']?></h2>
    			<ul class="info1">
    				<li>
    					<span><i class="fas fa-building"></i></span>
    					<span><?php echo $ad['company']?></span>	
    				</li>
    				<li>
    					<span><i class="fas fa-hand-holding-usd"></i></span>
    					<span><b>
    						<?php if (!empty($ad['salaryFrom'] or $ad['salaryTo'])): ?>
        						<?php echo $ad['salaryFrom'] . " - " . $ad['salaryTo'] . " PLN "?>
        					<?php else :?>
        						<?php echo "Nie podano zarobków"?>
        					<?php endif;?>
    					</b></span>	
    				</li>
    				<li>
    					<span><i class="fas fa-map-marker-alt"></i></span>
    					<span><?php echo $ad['locationCompany']?></span>
    					<span>
    						<?php if ($ad['locationJob'] === 'Zdalnie'): ?>
        						<?php echo " - " . $ad['locationJob']?>
        					<?php endif; ?>
    					</span>	
    				</li>
    				<li>
    					<span>
    						<?php if ($ad['contract'] !== 'Do ustalenia'): ?>
        						<?php echo " - " . $ad['contract']?>
        					<?php endif; ?>
    					</span>	
    				</li>
    			</ul>
    		</div>
    		<div class="textBox">
    			<?php if (!empty($ad['descriptionPosition'])):?>
    			<h2>Opis stanowiska</h2>
    			<div class="text">
    				<?php echo $ad['descriptionPosition'] ?>
    			</div>
    			<?php endif;?>
    			<h2>Wymagania</h2>
    			<div class="text">
    				<?php echo $ad['descriptionNeeds'] ?>
    			</div>
    			<?php if (!empty($ad['descriptionWelcome'])):?>
    			<h2>Mile widziane</h2>
    			<div class="text">
    				<?php echo $ad['descriptionWelcome'] ?>
    			</div>
    			<?php endif;?>
    			<?php if (!empty($ad['descriptionCompany'])):?>
    			<h2>Opis firmy</h2>
    			<div class="text">
    				<?php echo $ad['descriptionCompany'] ?>
    			</div>
    			<?php endif;?>
    			<div class="button" onclick="window.location='/?action=apply&id=<?php echo $ad['id']?>'">Aplikuj</div>
				<div class="text">
					<?php if ($day <= 1) : ?>
						<?php echo "oferta dodana dziś" ?>	
					<?php else :?>
						<?php echo "oferta dodana " . $day . " dni temu"?>
					<?php endif; ?>
    			</div>
    		</div>
    		
		</div>
	</div>
</section>

<?php else: ?>
		<div>Brak ogłoszenia do wylenia</div>
	<?php endif; ?>
