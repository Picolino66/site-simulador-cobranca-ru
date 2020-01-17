<!DOCTYPE html>
<html lang="pt">
<head>
	<?php
        include('head.php');
		// A sessão precisa ser iniciada em cada página diferente
		if (!isset($_SESSION)) session_start();

		// Verifica se não há a variável da sessão que identifica o usuário
		if (!isset($_SESSION['usuarioMatricula'])) {
			// Destrói a sessão por segurança
			session_destroy();
			// Redireciona o visitante de volta pro login
			header("Location: index.php"); exit;
		}
		if ($_SESSION['usuarioNivel'] == 2)
		{
			header("Location: nivel2.php"); exit;
		}

	?>    
</head>
    <!--==============================header=================================-->
<body>
    <div class="container ">
    	<div class="mt-5">
    		<div class="bg-info rounded">
				<?php
				//Conexao com banco de dados e botão logout
        		include('nav.php');
				require_once('funcoes/conexao.php'); 
				//Salva matricula na variavel $matricula
				$matricula =  $_SESSION['usuarioMatricula'];
				//Busca no banco de dados com a matricula salva para exibir os valores.
			    $query = "SELECT * FROM usuario WHERE matricula = '$matricula'";
			    if ($result = mysqli_query($conn, $query))
			    {
			    	$obj = mysqli_fetch_object($result); 
			    }
					echo "<div class='row'>";
						echo "<div class='col ml-5 mt-3'>";
							echo "<h3><span class='font-weight-bold'>Nome: </span>", $obj->nome,"</h3>";
						echo "</div>";
						echo "<div class='col mr-5 mt-3'>";
							echo "<h3><span class='font-weight-bold'>Sobrenome: </span>",$obj->sobrenome,"</h3>";
						echo "</div>";
					echo "</div>";
					echo "<div class='row'>";
						echo "<div class='col ml-5'>";
							echo "<h3><span class='font-weight-bold'>Matricula: ",$obj->matricula,"</h3>";
						echo "</div>";
						echo "<div class='col mr-5'>";
							echo "<h3><span class='font-weight-bold'>Email: </span>",$obj->email,"</h3>";
						echo "</div>";
					echo "</div>";
					echo "<div class='row'>";
						echo "<div class='col ml-5'>";
							echo "<h3><span class='font-weight-bold'>Credito: </span>",$obj->credito,"</h3>";
						echo "</div>";
						echo "<div class='col mr-5'>";
							echo "<h3><span class='font-weight-bold'>Tipo: </span>",$obj->tipo,"</h3>";
						echo "</div>";
					echo "</div>";
				?>

				 <form id="boleto" method="post" action="funcoes/geraBoleto.php"">
				 	<div class="form-group ml-5 mr-5 pb-3">
				        <h3><label for="quantidade" class="font-weight-bold">Quantidade: </label></h3>
				        <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Entre com um numero de crédito que deseja comprar">
				        <button type="submit" class="btn btn-outline-dark btn-lg btn-block mt-3">Gerar Boleto</button>    
				    </div>
				 </form>
			</div>
		</div>
	</div>
</body>
</html>
