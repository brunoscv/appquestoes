$(document).ready(function() {
	alternativa_id = $(this).attr('alternativa_id');
	questao_id     = $(this).attr('questao_id');
 	$("#adicionarCampo").click(function(event) {
		$.ajax({
		url: '<?php echo base_url(); ?>alternativas/criar/"',
		type: 'POST',
		dataType: 'html/json',
		data: {questao_id: questao_id, alternativa_id: alternativa_id},

	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	});
});