<?php require_once("../../conexao/conexao.php"); ?>

<?php
    
    //variavel de sessão
    session_start();
    
    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:login.php");
    }

    // Determinar localidade BR
    setlocale(LC_ALL, 'pt_BR');

    if( isset($_POST['nomecliente']) ) {
        
        $nomecliente    = utf8_decode($_POST['nomecliente']); 
        $precounitario  = $_POST['precounitario'];
        
        // Insercao no banco
        
        $inserir = "INSERT INTO lances ";
        $inserir .="(nomecliente,precounitario) ";
        $inserir .="VALUES ";
        $inserir .="('$nomecliente',$precounitario)";
        $qInserir = mysqli_query($conecta,$inserir);
        if(!$qInserir) {
            die("Erro na insercao");   
        } else {
            $mensagem = "Inserção ocorreu com sucesso.";
        }
    }  
    
    
    // Consulta a tabela de produtos via codigo enviado como parametro
    
    $tr = "SELECT * ";
    $tr .= "FROM produtos "; 
    if(isset($_GET["codigo"]) ) {
        $id = $_GET["codigo"];
        $tr .= "WHERE produtoID = {$id} ";

    } else {
        $tr .= "WHERE produtoID = 1 ";
    }
    
    $con_produto = mysqli_query($conecta,$tr);
    if(!$con_produto) {
        die("Erro na consulta");
    }



    $info_produto = mysqli_fetch_assoc($con_produto);
    $precounitarioatual = $info_produto["precounitario"] ;
    
   //tentativa de executar a logica do maior preço

    if( isset($_POST["precounitario"]) && $precounitario > $precounitarioatual ) {

        $precounitario     = $_POST["precounitario"];
        $produtoID         = $_POST["produtoID"];
        
        // alterar valor do item
        
        $alterar = "UPDATE produtos ";
        $alterar .= "SET ";
        $alterar .= "precounitario = {$precounitario} ";
        $alterar .= "WHERE produtoID = {$produtoID} ";
        $operacao_alterar = mysqli_query($conecta, $alterar);
        if(!$operacao_alterar) {
            die("Erro na alteracao");   
        } else {
            header("location:listagem.php");   
        }
        
    }
    
    else {
        $mensagem = "não foi possivel realizar o lance.";  
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
        
        <main>  
            <div class="container mt-5 mb-5 text-center">
                <div class="row">
                    <div class="col ">
                        <div class="card pr-5 pl-5">
                            <div class="card-body">
                                <form action="lance.php" method="post">
                                    
                                    <!-- campo de preço -->
                                    
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="precounitario" placeholder="Novo lance">                     
                                    </div>

                                    <!-- campo de confirmação de nome -->

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nomecliente" placeholder="confirmar nome">                     
                                    </div>
                                    <input type="hidden" name="produtoID" value="<?php echo $info_produto["produtoID"] ?>">
                                    
                                    <!-- botão submit -->
                                    
                                    <input type="submit" value="Enviar" class="btn bg-pink text-light mt-5"></input>
                                
                                </form>
                                
                                <?php
                                    if ( isset($mensagem)) { 
                                ?>
                                <p><?php echo $mensagem ?></p>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>