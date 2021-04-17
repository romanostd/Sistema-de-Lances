<?php
    // Passo 1 - Abrir conexao
    $servidor   = "localhost";
    $usuario    = "root";
    $senha      = "";
    $banco      = "banco";
    $conecta = mysqli_connect($servidor,$usuario,$senha,$banco);

    // Passo 2 - Testar conexao
    if ( mysqli_connect_errno()  ) {
        die("Conexao falhou: " . mysqli_connect_errno());
    }
?>