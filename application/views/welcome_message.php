<h3>Database Connection</h3>		

<?php echo isset($sys_msg) ? $sys_msg : ''  ?>

<?php echo form_open() ?>
	<p>
		<label>Host</label>
		<input type="text" name="host" value="<?php echo set_value('host',$this->input->post('host') ? $this->input->post('host') : 'localhost') ?>">
	</p>
	<p>
		<label>User</label>
		<input type="text" name="user" value="<?php echo set_value('user',$this->input->post('user') ? $this->input->post('user') : "root") ?>">
	</p>
	<p>
		<label>Password</label>
		<input type="text" name="pass" value="<?php echo set_value('pass',$this->input->post('pass')) ?>">
	</p>
	<p>
		<label>Database</label>
		<input type="text" name="db" value="<?php echo set_value('db',$this->input->post('db')) ?>">
	</p>
	<p>
		<input type="submit" name="login" value="Submit">
	</p>
<?php echo form_close() ?>

