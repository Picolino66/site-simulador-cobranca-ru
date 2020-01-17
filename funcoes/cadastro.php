<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
</head>
<body>
<?php
	session_start(); 
	//Chama a conexao com o banco de dados
	require_once('conexao.php'); 
	//Tud que _POST está vindo do formulário
	$email = $_POST['email'];
	$senha = MD5($_POST['senha']);
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$matricula = $_POST['matricula'];
	$tipo = $_POST['tipo'];

	//Faz um consulta ao banco de dados
	//Verificando se o email ja existe
	$sql = 	"SELECT $email FROM usuario";
	$pegaEmail = $conn->query($sql);

	//Se sim, avisa que foi cadastrado
	if($pegaEmail->num_rows > 0){
	  echo "Email ja cadastrado";
	}
	//Se nao, cadastra
	else
	{
	 //Aqui insere os dados na tabela
	  $sql = "INSERT INTO usuario (email, senha, nome, sobrenome, matricula, tipo)
	  VALUES ('$email', '$senha', '$nome', '$sobrenome', '$matricula', '$tipo')";
	  //Veridica se ocorreu o cadastro
		if ($conn->query($sql) === TRUE) {
			$_SESSION['cadastro'] = 'Cadastro com sucesso!';
		} 
		else 
			{
				//caso de erro da um alerta
				echo "Erro: " . $sql . "<br>" . $conn->error;
				$_SESSION['cadastro'] = 'Cadastro nao efetuado!';
			}
	}
	$conn->close();
	header("Location: ../index.php"); exit;
?>
</body>
</html>
