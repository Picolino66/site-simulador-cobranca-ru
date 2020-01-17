<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>Sair</title>

</head>
<body>
	<!-- Função que destroi a sessão iniciada, essa função é chamada pelo botão logout-->
<?php
	session_start(); // Inicia a sessão
	session_destroy(); // Destrói a sessão limpando todos os valores salvos
	session_unset();
	header("Location: ../index.php"); exit; // Redireciona o visitante
?>

															
</body>
</html>
