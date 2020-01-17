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
		if ($_SESSION['usuarioNivel'] == 1)
		{
			header("Location: nivel1.php"); exit;
		}

	?>  
</head>
    <!--==============================header=================================-->
<body>
    <div class="container ">
    	<div class="mt-5">
    		<div class="bg-info rounded">
			<!-- Botão logout -->
			<?php
				include('nav.php');
			?>
			<!-- Fim botao -->
    			<h1 class="text-center pb-5"> Gerenciador de pagamento </h1>
			<?php
				//Conecta no banco de dados
				require_once('funcoes/conexao.php'); 
				$pago = 'N';
				//Verifica no banco de dados todos os boletos que tiverem pago iguais a não. 	
			    $query = "SELECT * FROM boleto WHERE pago = '$pago'";
			   
			    if ($result = mysqli_query($conn, $query))
			    {
					while ($obj = mysqli_fetch_object($result)) 
				    {
				    	//Lista matricula, valor e botão para pagar.
				    	//Exibe somente boletos que não estão pagos.
						echo "
								<form class='row pb-3 pl-5 pr-5' id='pagar' method='post' action='funcoes/pagar.php'> 
										<div class='col'>
											<h4><span>Matricula: ",$obj->usuario_mat,"</span></h4> 
										</div> 
										<div class='col'>
											<h4><span>Valor: ",$obj->valor,"</span></h4> 
										</div> 
										<div class='col'>
											<button type='submit' id='cod_boleto' name='cod_boleto' value=".$obj->boleto." class='btn btn-danger btn-lg btn-block'>Pagou</button>
										</div>             
								</form>
						";
				    } 
				}
			?>
			</div>
		</div>	
	</div>
</body>
</html>