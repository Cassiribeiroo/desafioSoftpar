<?php
include_once "conexao.php";

$Id_Ingredientes = filter_input(INPUT_GET, "Id_Ingredientes", FILTER_SANITIZE_NUMBER_INT);

if(!empty($Id_Ingredientes)){

    $query_ingrediente = "DELETE FROM ingredientes WHERE Id_ingredientes=:Id_Ingredientes";
    $result_ingrediente = $conn->prepare($query_ingrediente);
    $result_ingrediente->bindParam(':Id_Ingredientes', $Id_Ingredientes);

    if($result_ingrediente->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success'role='alert'>Ingrediente excluido com sucesso!</div>"];
    }else{
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'role='alert'>Erro: Ingrediente não excluido com sucesso!</div>"];
    }    


} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'role='alert'>Erro: Nenhum ingrediente encontrado!</div>"];

}

echo json_encode($retorna);