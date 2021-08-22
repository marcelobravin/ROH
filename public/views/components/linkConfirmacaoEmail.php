<?php if ( !empty($_GET) ): ?>
	<?php if ( $obj['email_confirmado'] ): ?>
		Email confirmado!
	<?php else: ?>
		<a href="app/Controller/ConfirmationController.php?id=<?php echo $obj['id'] ?>">Reenviar confirmação de email</a>
	<?php endif ?>
<?php endif ?>
