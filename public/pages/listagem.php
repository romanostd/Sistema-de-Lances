<?php require_once("../../conexao/conexao.php"); ?>

<?php
    // teste de segurança
    session_start();

    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');

    // Consulta ao banco de dados
    $produtos = "SELECT produtoID, nomeproduto, precounitario ";
    $produtos .= "FROM produtos ";
    
    $resultado = mysqli_query($conecta, $produtos);
    if(!$resultado) {
        die("Falha na consulta ao banco");   
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>IBAY</title>
        <link rel="shortcut icon" href=""/>
        <!-- estilo -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../style/css_main_page.css" rel="stylesheet">

    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>
        
            <!-- Produtos -->
            
            <div class="container mt-5">
                <h3 class="mb-5">PRODUTOS</h3>
                <div class="row">
                    <?php
                        while($linha = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <div class="col-sm-3 mb-4">
                        <div class="card" style="width: 15rem;">    
                            <div class="card-body">
                                <a href="detalhe.php?codigo=<?php echo $linha['produtoID'] ?>">
                                    <h5 class="card-title"><?php echo utf8_encode ($linha["nomeproduto"]) ?></h5>
                                </a>
                                <p class="card-text">Preço Atual : <?php echo real_format($linha["precounitario"]) ?></p>
                            </div>
                        </div>
                    </div>
                <?php    
                }
                ?>  
            </div> 
        </main>
        <?php include_once("../_incluir/rodape.php"); ?>
        
        <!-- Scripts-->
        
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
    
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>