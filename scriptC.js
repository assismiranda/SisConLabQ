<script>
  $(document).ready(function(){
    $('#insert_form_C').on('submit', function(event){
      event.preventDefault();
      //Receber os dados do formulário
      var dados = $("#insert_form_C").serialize();
      $.post("cadastrarC.php", dados, function (retorna){
        if(retorna){
          $.post("selectClasses.php",1,function(valor) {
            $("#selClasses").html(valor);
          });
          //Alerta sucesso
          $("#msg2").html('<div class="alert alert-success" role="alert">Cadastrado com sucesso!</div>');
                
        }else{
            //Alerta falha 
            $("#msg2").html('<div class="alert alert-warning" role="alert">Falha no cadastro!</div>');
        }   

        //Limpar os campos
        $('#insert_form_C')[0].reset();
                
        //Fechar a janela 
        //$('#addClasseModal').modal('hide');

        setTimeout(function() {
          $("#msg2").fadeOut().empty();
        }, 5000);
      });
    });
  });
</script>