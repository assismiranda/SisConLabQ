<script>
	$(document).ready(function(){
		$('#insert_form_M').on('submit', function(event){
			event.preventDefault();
			//Receber os dados do formulário
			var dados = $("#insert_form_M").serialize();

            $.post("cadastrarM.php", dados, function (retorna){
				if(retorna){
					$.post("tableMateriais.php",1,function(valor) {
		                $("#tabela").html(valor);
		            });
					//Alerta sucesso
					$("#msg").html('<div class="alert alert-success" role="alert">Material cadastrado com sucesso!</div>');

				}else{
					//Alerta falha 
                    $("#msg").html('<div class="alert alert-warning" role="alert">Falha no cadastro do Material!</div>');
                    
				}	
				
				//Limpar os campos
				$('#insert_form_M')[0].reset();
							
				//Fechar a janela 
				$('#addMaterialModal').modal('hide');

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

            $.post("pesquisarM.php", dados, function (valor){
		        $("#tabela").html(valor);
		            
				$('#form_pesq')[0].reset();

			});
		});
	});
	

</script>