<!DOCTYPE html>
<html lang="pt">
<head>
</head>
    <!--==============================header=================================-->
<body>
<?php
	
	// A sessão precisa ser iniciada em cada página diferente
	if (!isset($_SESSION)) session_start();

	// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['usuarioMatricula'])) {
	// Destrói a sessão por segurança
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: index.php"); exit;
	}

	//Faz a conexão com o banco de dados
	require_once('conexao.php');       

	//Recebe o valor do codigo do boleto a ser pago, o valor é enviado ao clicar em pago.
	$cod_boleto = $_POST['cod_boleto'];
    //Faz uma busca na tabela boleto do banco de dados com o codigo do boleto.
    $query = "SELECT * FROM boleto WHERE boleto = '$cod_boleto'";

    if ($result = mysqli_query($conn, $query))
    {
		$obj = mysqli_fetch_object($result);
	    $matricula = $obj->usuario_mat;
	    $valor = $obj->valor;
	    //Atualiza valor de pago do boleto para S de sim.
	    $sql = "UPDATE boleto SET pago='S' WHERE boleto=$obj->boleto";
	    if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
		//Pega a matricula do usuario referente ao boleto
		$query = "SELECT * FROM usuario WHERE matricula = '$matricula'";		
		if ($result = mysqli_query($conn, $query))
    	{
    		$obj = mysqli_fetch_object($result);
    		//Verifica se o tipo de é A.
    		if ($obj->tipo == 'A')
    		{
    			//Divide por 2
    			$qntd = $valor / 2;
    		}else $qntd = $valor;
    		$qntd = $qntd + $obj->credito;
    		//Então atualiza os créditos do usuário, referente a matrícula que estava no boleto pago.
    		$sql = "UPDATE usuario SET credito=$qntd WHERE matricula=$matricula";
		    if ($conn->query($sql) === TRUE) {
				echo "Record updated successfully";
			} else {
				echo "Error updating record: " . $conn->error;
			}
    	}
	}
	$conn->close();
	 header("Location: ../nivel2.php");
?>
<footer>
</footer>
</body>
</html>