<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
</head>
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

	//Conexao com banco de dados
	require_once('conexao.php'); 

	//Armazena variaveis quantidade de credito, matricula e define pago como N
	$quantidade = $_POST['quantidade'];
	$matricula = $_SESSION['usuarioMatricula'];
	$pago = 'N';

	//Verifica o tipo A ou B
	if ($_SESSION['usuarioTipo'] == 'A')
	{
		$valor = 2 * (int)$quantidade;
	}else $valor = $quantidade;

	//Insere no banco de dados na tabela boleto, o boleto acabado de ser criado.
	$sql = "INSERT INTO boleto (valor, usuario_mat, pago)
	VALUES ('$valor', '$matricula', '$pago')";
	if ($conn->query($sql) === TRUE) {
		echo "Cadastro feito com sucesso";
	} 
	else 
	{
	 	echo "Erro: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	header("Location: ../boleto.php"); exit;
?>
</body>
</html>
