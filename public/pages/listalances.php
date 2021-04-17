<?php require_once("../../conexao/conexao.php"); ?>

<?php

     // variavel de sessao
     session_start();

     // Determinar localidade BR
     setlocale(LC_ALL, 'pt_BR');

    // Consulta ao banco de dados
    $lances = "SELECT nomecliente, precounitario ";
    $lances .= "FROM lances ";
   
    // Algoritimo de pesquisa

    if ( isset($_GET["nomecliente"]) ) {
        $nome_cliente = $_GET["nomecliente"];
        $lances .= "WHERE nomecliente LIKE '%{$nome_cliente}%' ";
        
    }
    
    //Ordena do maior para o menor

    $lances .= "ORDER BY precounitario DESC ";

    $resultado = mysqli_query($conecta, $lances);

    if(!$resultado) {
        die("Falha na consulta ao banco");   
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
        <?php include_once("../_incluir/funcoes.php"); ?>
        
        <main>  
            <div class="container mt-5">
                <h3 class="mb-5">Lances realizados</h3>
               
                <!-- tabela com os lances realizados -->

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nome Clientet</th>
                        <th scope="col">Lances</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($linha = mysqli_fetch_assoc($resultado)) {
                    ?>
                        <tr>
                            <td><?php echo $linha["nomecliente"] ?></td>
                            <td><?php echo real_format($linha["precounitario"]) ?>
                        </td>
                    <?php    
                    }
                    ?>
                    </tbody>    
                </table>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>