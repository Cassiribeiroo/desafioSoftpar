<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['Nome_Ingredientes'])){
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
}else{
    $query_usuario = "INSERT INTO ingredientes (Nome_Ingredientes) VALUES (:Nome_Ingredientes)";
    $cad_ingrediente = $conn->prepare($query_usuario);
    $cad_ingrediente->bindParam(':Nome_Ingredientes', $dados['Nome_Ingredientes']);

    $cad_ingrediente->execute();

    if($cad_ingrediente->rowCount()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Ingrediente cadastrado com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Ingrediente não cadastrado com sucesso!</div>"];
    }
}



echo json_encode($retorna);