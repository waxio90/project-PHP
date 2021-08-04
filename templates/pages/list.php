<section>
	<div class="box-message">
		<?php 
		  if (!empty($params['before'])) {
		      switch($params['before']) {
		          case 'created':
		              echo 'ogłoszenie opublikowano pomyślnie';
		              break;
		      }
		  }
		?>
	</div>
	<div class="container">	
		<h2>Oferty pracy</h2>
		<?php foreach ($params['ads'] ?? [] as $ad): ?>
		<div class="listBox" onclick="window.location='/?action=show&id=<?php echo $ad['id']?>'">
			<div class="position">
				<h2><?php echo $ad['position']?></h2>
			</div>
			<div class="info">
				<ul>
					<li><?php echo $ad['level']?></li>
					<li><?php echo $ad['salaryFrom'] . " - " . $ad['salaryTo'] . $ad['salary'] . " " . $ad['currency']?></li>
					<li>
						<?php if ($ad['locationJob'] === 'Zdalnie') : ?>
            				<?php echo $ad['locationJob']?>
            			<?php endif;?>
					</li>
					<li><?php echo $ad['contract']?></li>
				</ul>
			</div>
			<div class="company">
				<ul>
					<li><?php echo  $ad['locationCompany']?></li>
				</ul>
			</div>
		</div>
		<?php endforeach; ?> 
	</div>
</section>