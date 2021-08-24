<?php if ( !empty($_GET) ): ?>
	<?php if ( $user['email_confirmado'] ): ?>
		Email confirmado!
	<?php else: ?>
		<a href="app/Controller/ConfirmationController.php?id=<?php echo $user['id'] ?>">Reenviar confirmação de email</a>
	<?php endif ?>
<?php endif ?>
