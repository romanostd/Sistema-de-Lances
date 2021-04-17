<?php require_once("../../conexao/conexao.php"); ?>

<?php
    
    if( isset($_POST['nomeproduto']) ) {
        
        $nomeproduto    = utf8_decode($_POST['nomeproduto']); 
        $precounitario  = $_POST['precounitario'];
        
        // Insercao no banco
        $inserir = "INSERT INTO produtos ";
        $inserir .="(nomeproduto,precounitario) ";
        $inserir .="VALUES ";
        $inserir .="('$nomeproduto',$precounitario)";
        $qInserir = mysqli_query($conecta,$inserir);
        if(!$qInserir) {
            die("Erro na insercao");   
        } else {
            $mensagem = "Inserção ocorreu com sucesso.";
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
        <?php include_once("../_incluir/topo.php"); ?>
        
        <main>
            <div class="container mt-5">
                <h3 class="text-center">Incluir Novo Produto</h3>
                <form action="incluir.php" method="post" enctype="multipart/form-data">
                    <!-- campo de nome do produto -->
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nomeproduto" placeholder="Nome do Produto">
                            </div>
                        </div>
                    </div>
                    
                    <!-- campo de preco -->
                
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2">R$</span>
                                    </div>
                                    <input type="text" class="form-control" name="precounitario" placeholder="Preço Unitário">                      
                                </div>
                            </div>
                        </div>
                    </div>    
                    
                    <!-- botao submit -->
                    
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 offset-sm-4">
                            <button type="submit" value="Inserir novo produto" class="btn bg-pink text-light btn-block">Enviar</button>
                            <?php
                                if( isset($mensagem) ) {
                                    echo "<p>" . $mensagem . "</p>";
                                }
                            ?>
                        </div>
                    </div>                                  
                </form>
                
              
            </div>
        </main>

        

        <!-- Scripts -->

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
<?php
    // Fechar conexao
    mysqli_close($conecta);
?>