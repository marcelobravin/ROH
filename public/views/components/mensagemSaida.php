<?php if ( isset($_SESSION['operacao']) ) : ?>
	<div id="caixaMensagem" class="<?php echo isset($_SESSION['operacao']['status']) ? $_SESSION['operacao']['status'] : "" ?>">
		<?php echo esvaziarMensagem() ?>
	</div>

	<script src="public/scripts/caixa-mensagem.js"></script>
<?php endif ?>
