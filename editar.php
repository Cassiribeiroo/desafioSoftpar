<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['Id_Ingredientes'])){
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Tente mais tarde!</div>"];
}elseif(empty($dados['Nome_Ingredientes'])){
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>"];
}else{
    $query_usuario= "UPDATE ingredientes SET Nome_Ingredientes=:Nome_Ingredientes WHERE Id_Ingredientes=:Id_Ingredientes";

    $edit_ingrediente = $conn->prepare($query_usuario);
    $edit_ingrediente->bindParam(':Nome_Ingredientes', $dados['Nome_Ingredientes']);
    $edit_ingrediente->bindParam(':Id_Ingredientes', $dados['Id_Ingredientes']);

    if($edit_ingrediente->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Ingrediente editado com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Ingrediente não editado com sucesso!</div>"];
    }
}

echo json_encode($retorna);