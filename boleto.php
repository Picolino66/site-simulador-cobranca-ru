<!DOCTYPE html>
<html lang="pt">
<head>
	<?php
        include('head.php');
	?>
</head>
<body>
    <div class="container">
	
	<?php
	//Chama função de gerar o boleto visual.
		require_once('funcoes/barcode.inc.php'); 

		// A sessão precisa ser iniciada em cada página diferente
		if (!isset($_SESSION)) session_start();

		// Verifica se não há a variável da sessão que identifica o usuário
		if (!isset($_SESSION['usuarioMatricula'])) {
		// Destrói a sessão por segurança
		session_destroy();
		// Redireciona o visitante de volta pro login
		header("Location: index.php"); exit;
		}

		//Conexao com banco de dados.
		require_once('funcoes/conexao.php'); 

		//Pega a matricula do usuario, e pesquisa o boleto referente a ele.
		$matricula = $_SESSION['usuarioMatricula'];
		$pago = 'N';

		//seleciona o numero do boleto
		$result_usuario = "SELECT * FROM boleto WHERE usuario_mat = '$matricula' && pago = '$pago' ORDER BY boleto DESC limit 1";
	    $resultado_usuario = mysqli_query($conn, $result_usuario);
	    //Pega o boleto que acabou de criar
	    $resultado = mysqli_fetch_assoc($resultado_usuario);
	    
	    $numero = (int)$resultado['boleto'] * 2147483647;
	    //Mostra na tela o boleto
	    new barCodeGenrator($numero,1,'imgs/barcode_'.$numero.'.gif',190,130, true);
	    echo '<div class="row">';
	    echo '<div class="col">';
	    echo '<div class="card">';
	    echo '<div class="card-body">';
	    echo '<img src="imgs/barcode_'.$numero.'.gif" class="card-img-top" />';
	    echo '<h2 class="card-title">Usuário: ',$resultado['usuario_mat'],'</h2><br>';
		echo '<h2 class="card-text">Valor: R$',$resultado['valor'],',00 </h2><br>';
		echo '<a href="nivel1.php" class="btn btn-primary">Voltar</a>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	?>
	</div>

</body>
</html>
