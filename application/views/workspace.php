<h3>Selected Table : <small><?php echo $tbname ?></small></h3>

<div class="alert alert-info"><?php echo isset($sys_msg) ? $sys_msg : ''  ?></div>

<div class="col">
	<div class='col-md-4' >
		<ul>
			<?php if ($tables): ?>
				<?php foreach ($tables as $k => $v): ?>
					<li>
						<?php echo $v ?>
						<a href="<?php echo base_url('home/workspace/'.$v) ?>">Edit</a>	
					</li>
				<?php endforeach ?>
			<?php endif ?>
		</ul>
	</div>	

	<div class='col-md-8' >
		<ul>
			<?php if ($fields): ?>
				<?php foreach ($fields as $k => $v): ?>
					<li>
						<?php echo $v ?>
						<a href="<?php echo base_url("home/workspace/$tbname/reshuffle/$v") ?>" title="Value will reshuffle.">Reshuffle</a>	
						|
						<a href="<?php echo base_url("home/workspace/$tbname/reshuffle/$v") ?>" title="Value will reshuffle.">Remove</a>	
					</li>
				<?php endforeach ?>
			<?php endif ?>
		</ul>
	</div>
</div>
<div class="clearfix"></div>