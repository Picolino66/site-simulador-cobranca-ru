<!-- Index.php é a primeira tela a ser exibida -->
<!DOCTYPE html>
<html lang="pt">
<head>    
    <?php
        //Inclui o cabeçalho das páginas, buscando os arquivos css e js.
        include('head.php');
        //Inicializa para salvar dados no cache do navegador.
        if (!isset($_SESSION)) session_start();
    ?>
</head>
<!--Trecho HTML onde é construido o corpo do site e os formulários para cadastro e login -->
<body>
    <div class="container">
        <div class="row py-5">
            <div class="col bg-info py-3 rounded-left">
                <h3>Cadastrar</h3>
                <!-- Criação do formulário -->
                <!-- HTML puro para o usuario interagir
                    com a tela. Informando os dados -->
                <form id="cadastro" method="post" enctype="multipart/form-data" action="funcoes/cadastro.php">
                    <div class="form-group">
                        <label for="nome">Nome: </label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Entre com seu nome">
                    </div>

                    <div class="form-group">
                        <label for="sobrenome">Sobrenome: </label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Entre com seu sobrenome">
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matricula: </label>
                        <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Entre com sua matricula">
                    </div>
                            
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Entre com seu email">
                    </div>
                    
                    <div class="form-group">
                        <label for="senha">Senha: </label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Entre com sua senha">
                    </div>

                    <div class="form-group form-check">
                        <label for="senha">Vulneravel: </label>
                        <input type="checkbox" class="form-check-input ml-2" id="tipo" name="tipo" value="B">
                        <label class="form-check-label ml-4" for="exampleCheck1">Sim</label>
                        <input type="checkbox" class="form-check-input ml-2" id="tipo" name="tipo" value="A">
                        <label class="form-check-label ml-4" for="exampleCheck1">Não</label>
                    </div>
                    <button type="submit" class="btn btn-outline-dark btn-lg btn-block">Cadastrar</button>
                </form>
                <!-- Fim formulário de cadastro -->
            </div>
            <!--Formulário de login -->
            <div class="col bg-info py-3 rounded-right">
                <h3>Login</h3>
                <form id="login" method="post" action="funcoes/login.php">                    
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Entre com seu email">
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha: </label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Entre com sua senha">
                    </div>    
                    <button type="submit" class="btn btn-outline-dark btn-lg btn-block">Login</button>             
                </form>
            </div>
        </div>
    </div>
</body>
</html>
