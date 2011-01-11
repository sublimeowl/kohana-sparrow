<?php
    if(isset($errors))
    {
	foreach ($errors as $key => $error)
	{
	    echo '<div class="error">';
	    echo '<b>'.$error.'</b><br>';
	    echo '</div>';
	}
	var_dump($errors);
    }
?>
<?= form::open('owl/login') ?>
<h2>:: Login</h2>
<table>
    <tr>
	<td><b>Username</b></td>
	<td><?= form::input('username',isset($username)?$username:'') ?></td>
    </tr>
    <tr>
	<td><b>Password</b></td>
	<td><?= form::password('password') ?></td>
    </tr>
    <tr>
	<td>&nbsp;</td>
	<td><?= form::submit('submit', 'Login') ?></td>
    </tr>
</table>
<?= form::close() ?>

