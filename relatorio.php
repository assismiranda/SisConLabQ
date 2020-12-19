<?php 
	session_start();
	include"header.php"; 
	include_once 'conexao.php'; 
	$pdo = conectar(); 
	if (isset($_SESSION['user'])) {
?>
<div id="portal-column-content" class="cell width-3:4 position-1:4">
	<a name="acontent" id="acontent" class="anchor">conteúdo</a>

	<div style="background-color: #19882c; color: white;"><center>Reagente</center></div>
	<br>
	<div>
		<?php  
			$sql = $pdo->prepare("SELECT count(*) AS qtd from lab.reagente");
		    $result = $sql->execute();
		 	$cad = $sql->fetch(PDO::FETCH_ASSOC);
	    ?>
	    <p>- <?php echo $cad['qtd'];?> Reagente(s) cadastrado(s).</p>
		<?php
		 	$dataAtual = date("Y-m-d");
			$sql = $pdo->prepare("SELECT count(*) AS qtd from lab.reagente AS R, lab.EstoqueReag AS E WHERE E.validade < '$dataAtual' AND R.cas = E.cas AND R.lote = E.lote");
		    $result = $sql->execute();
		 	$vencido = $sql->fetch(PDO::FETCH_ASSOC);
	 	?>
		<p>- <?php echo $vencido['qtd'];?> Reagente(s) vencido(s).</p>
		<?php  
			$sql = $pdo->prepare("SELECT count(*) AS qtd from lab.reagente AS R, lab.EstoqueReag AS E WHERE E.validade - '$dataAtual' > 10 AND R.cas = E.cas AND R.lote = E.lote");
		    $result = $sql->execute();
		 	$ok = $sql->fetch(PDO::FETCH_ASSOC);
		?>
		<p>- <?php echo $ok['qtd'];?> Reagente(s) OK.</p>
		<?php  
			$sql = $pdo->prepare("SELECT count(*) AS qtd from lab.reagente AS R, lab.EstoqueReag AS E WHERE E.validade - '$dataAtual'> 0 AND E.validade - '$dataAtual' < 11 AND R.cas = E.cas AND R.lote = E.lote");
		    $result = $sql->execute();
		 	$quase = $sql->fetch(PDO::FETCH_ASSOC);
		?>
		<p>- <?php echo $quase['qtd'];?> Reagente(s) quase vencido(s).</p>
		<?php  
			$sql = $pdo->prepare("SELECT count(*) AS qtd from lab.reagente WHERE controlado = 'Sim'");
		    $result = $sql->execute();
		 	$controlado = $sql->fetch(PDO::FETCH_ASSOC);
		?>
		<p>- <?php echo $controlado['qtd'];?> Reagente(s) controlado(s).</p>
		
	</div>
	
    <div id="piechart" style="margin:-30% 0% 0% 43%;"></div>
  
	<p><br></p>
	
	<div style="background-color: #19882c; color: white;"><center>Equipamento</center></div>
	<br>
	<?php  
		$sql = $pdo->prepare("SELECT count(*) AS qtd from lab.equipamento");
	    $result = $sql->execute();
	 	$exibir = $sql->fetch(PDO::FETCH_ASSOC);
    ?>
    <p>- <?php echo $exibir['qtd'];?> Equipamento(s) cadastrado(s).</p>
    <br>

	<div style="background-color: #19882c; color: white;"><center>Material</center></div>
	<br>
	<?php  
		$sql = $pdo->prepare("SELECT count(*) AS qtd from lab.material");
	    $result = $sql->execute();
	 	$exibir = $sql->fetch(PDO::FETCH_ASSOC);
    ?>
    <p>- <?php echo $exibir['qtd'];?> Material(is) cadastrado(s).</p>
</div>
<?php
  } else { //CASO NÃO ESTEJA AUTENTICADO
    echo '<div class="alert alert-warning" style="text-align:center;">Esta é uma área reservada, só usuários autorizados podem ter acesso. 
            <br/><a href="Index.php">Se identifique aqui</a></div>';
  }
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">google.charts.load('current', {'packages':['corechart']});google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Ok',   <?php echo $ok['qtd'];?>],
          ['Vencido',      <?php echo $vencido['qtd'];?>],
          ['Quase Vencido',  <?php echo $quase['qtd'];?>]
        ]);

        var options = {
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
</script>

<?php include"footer.php"; ?>