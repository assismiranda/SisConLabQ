<script>
  $(document).ready(function(){
    $('#insert_form_R').on('submit', function(event){
      event.preventDefault();
      //Receber os dados do formulário
      var dados = $("#insert_form_R").serialize();
      $.post("cadastrarR.php", dados, function (retorna){
        if(retorna){
          $.post("selectRiscos.php",1,function(valor) {
            $("#selRiscos").html(valor);
          });
          //Alerta sucesso
          $("#msg3").html('<div class="alert alert-success" role="alert">Cadastrado com sucesso!</div>');
                
        }else{
            //Alerta falha 
            $("#msg3").html('<div class="alert alert-warning" role="alert">Falha no cadastro!</div>');
        }   

        //Limpar os campos
        $('#insert_form_R')[0].reset();
                
        //Fechar a janela 
        //('#addRiscoModal').modal('hide');

        setTimeout(function() {
          $("#msg3").fadeOut().empty();
        }, 5000);
      });
    });
  });
</script>