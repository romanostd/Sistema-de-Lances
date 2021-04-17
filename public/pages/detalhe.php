<?php require_once("../../conexao/conexao.php"); ?>
<?php

    // variavel de sessão
    session_start();

    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');

    //confere se o parametro esta configurado
    if ( isset($_GET["codigo"]) ) {
        $produto_id = $_GET["codigo"];
    } else {
        Header("Location: listagem.php");
    }

    // Consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM produtos ";
    $consulta .= "WHERE produtoID = {$produto_id} ";
    $detalhe    = mysqli_query($conecta,$consulta);

    // Testar erro
    if ( !$detalhe ) {
        die("Falha no Banco de dados");
    } else {
        $dados_detalhe = mysqli_fetch_assoc($detalhe);
        $produtoID      = $dados_detalhe["produtoID"];
        $nomeproduto    = $dados_detalhe["nomeproduto"];
        $precounitario  = $dados_detalhe["precounitario"];
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
        
        <?php include_once("../_incluir/topo.php"); ?>

        <main>  
            <div class="container mt-5 mb-5 text-center">
                <div class="row">
                    <div class="col ">
                        <div class="card pr-5 pl-5">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo utf8_encode($nomeproduto) ?></h5>
                                <h5 class="card-title mt-4">Lance atual: <?php echo "R$ " . number_format($precounitario,2,",",".") ?></h5>
                                <a href="lance.php?codigo=<?php echo $produtoID?>" class="btn bg-pink text-light mt-5">DAR LANCE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>