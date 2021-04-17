<?php require_once("../../conexao/conexao.php"); ?>
    
    <?php

    // conferir se é maior de 18
    
    if(isset($_POST["idade"])) {

        $usuario        = $_POST["usuario"];
        $idade          = $_POST["idade"];
        
        if ($idade < 18 ) {
            $mensagem = "é preciso ter mais de 18 anos parar criar uma conta."; 
        }
        
        else {

        // Insercao no banco
        $inserir    = "INSERT INTO clientes ";
        $inserir    .= "(usuario,idade) ";
        $inserir    .= "VALUES ";
        $inserir    .= "('$usuario', $idade)";
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir) {
            die("Erro no banco");
        }  
    }
    }
    ?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>IBAY</title>
        
        <link rel="shortcut icon" href="" />
        
        <!-- estilo -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../style/css_main_page.css" rel="stylesheet">
    
    </head>

    <body>
        
        <header>
            <nav class="navbar navbar-dark bg-dark-pink">
                <a class="navbar-brand" href="listagem.php">
                    <h1>IBAY</h1>
                </a>
            </nav>
        </header>
        
        <main>  
            <div class="container w-75 mt-5 border">
                <h3 class="text-center">Cadastre-se</h3>
                <form action="cadastro.php" method="post">
                    
                    <!-- campo de nome  -->
                    
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="usuario" placeholder="Nome de usuario">                     
                            </div>
                        </div>
                        
                    <!-- campo de idade -->    
                
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control" name="idade" placeholder="idade">                     
                            </div>
                        </div>
                    </div> 

                    <!-- botão de submit -->

                    <div class="row mt-3 mb-5">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <button type="submit" value="inserir" class="btn bg-pink text-light btn-block">Cadastrar</button>
                        </div>
                    </div>              
                </form>
                <?php
                    if ( isset($mensagem)) { 
                    ?>
                    <p><?php echo $mensagem ?></p>
                    <?php
                    }
                ?>
            </div>          
        </main>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>