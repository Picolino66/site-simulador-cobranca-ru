<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>Sair</title>

</head>
<body>
	<!-- Fun��o que destroi a sess�o iniciada, essa fun��o � chamada pelo bot�o logout-->
<?php
	session_start(); // Inicia a sess�o
	session_destroy(); // Destr�i a sess�o limpando todos os valores salvos
	session_unset();
	header("Location: ../index.php"); exit; // Redireciona o visitante
?>

															
</body>
</html>
