<?php if( !empty($this->data['msg_error']) ): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Atenção!</strong> <?php echo $this->data['msg_error']; ?>
</div>
<?php endif; ?>

<?php if( !empty($this->data['msg_success']) ): ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">
		×
	</button>
	<strong>Sucesso!</strong> <?php echo $this->data['msg_success']; ?>
</div>
<?php endif; ?>