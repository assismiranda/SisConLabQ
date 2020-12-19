<script>
	$(document).ready(function(){
		$('#insert_form_A').on('submit', function(event){
			event.preventDefault();
			//Receber os dados do formulário
			var dados = $("#insert_form_A").serialize();

            $.post("cadastrarA.php", dados, function (retorna){
				if(retorna){
					$.post("tableAgendamentos.php",1,function(valor) {
		                $("#tabela").html(valor);
		            });
					//Alerta sucesso
					$("#msg").html('<div class="alert alert-success" role="alert">Agendamento realizado com sucesso!</div>');						
				}else{
					//Alerta falha 
                    $("#msg").html('<div class="alert alert-warning" role="alert">Falha no Agendamento!</div>');
				}
				//Limpar os campos
				$('#insert_form_A')[0].reset();
							
				//Fechar a janela 
				$('#addAgendaModal').modal('hide');		

				setTimeout(function() {
		          $("#msg").fadeOut().empty();
		        }, 5000);
			});
		});
	});

	$(document).ready(function(){
		$('#form_pesq').on('submit', function(event){
			event.preventDefault();
			//Receber os dados do formulário
			var dados = $("#form_pesq").serialize();

            $.post("pesquisarA.php", dados, function (valor){
		        $("#tabela").html(valor);
		            
				$('#form_pesq')[0].reset();

			});
		});
	});
	
</script>