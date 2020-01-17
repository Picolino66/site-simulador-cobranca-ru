<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>
<body>

<?php
    
    session_start(); 
    //Conecta no banco de dados
    require_once('conexao.php');       

    //O campo usuário e senha preenchido entra no if para validar
    //Inicio do login
    if((isset($_POST['email'])) && (isset($_POST['senha']))){
        $email = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        $senha = md5($senha);
        
        //Buscar na tabela usuario, o usuário que corresponde com os dados digitado no formulário
        $result_usuario = "SELECT * FROM usuario WHERE email = '$email' && senha = '$senha' LIMIT 1";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
        $resultado = mysqli_fetch_assoc($resultado_usuario);
        //Fim do login

        //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        if(isset($resultado)){
            //Para nao ter que ficar fazendo login toda vez
            $_SESSION['usuarioMatricula'] = $resultado['matricula'];
            $_SESSION['usuarioNome'] = $resultado['nome'];
            $_SESSION['usuarioSobrenome'] = $resultado['sobrenome'];
            $_SESSION['usuarioNivel'] = $resultado['nivel'];
            $_SESSION['usuarioTipo'] = $resultado['tipo'];
            $_SESSION['usuarioCredito'] = $resultado['credito'];
            $_SESSION['usuarioEmail'] = $resultado['email'];
            //Verifica se adm ou usuario padrao
            if($_SESSION['usuarioNivel'] == "1"){
                header("Location: ../nivel1.php");
            }elseif($_SESSION['usuarioNivel'] == "2"){
                header("Location: ../nivel2.php");
            }else{
                header("Location: ../index.php");
            }
        //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        //redireciona o usuario para a página de login
        }else{    
            //Váriavel global recebendo a mensagem de erro
            $_SESSION['loginErro'] = "Usuário ou senha Inválido";
            header("Location: ../index.php");
        }
    //O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
    }else{
        $_SESSION['loginErro'] = "Usuário ou senha inválido";
        header("Location: ../index.php");
    }
?>  
</body>
</html>
