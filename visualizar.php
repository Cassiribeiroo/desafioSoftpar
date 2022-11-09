<?php
include_once "conexao.php";

$Id_Ingredientes = filter_input(INPUT_GET, "Id_Ingredientes", FILTER_SANITIZE_NUMBER_INT);

if(!empty($Id_Ingredientes)){

    $query_ingrediente = "SELECT Id_Ingredientes, Nome_Ingredientes FROM ingredientes WHERE Id_ingredientes =:Id_Ingredientes LIMIT 1 ";
    $result_ingrediente = $conn->prepare($query_ingrediente);
    $result_ingrediente->bindParam(':Id_Ingredientes', $Id_Ingredientes);
    $result_ingrediente->execute();

    $row_ingrediente = $result_ingrediente->fetch(PDO::FETCH_ASSOC);
     
    $retorna = ['erro' => false, 'dados' => $row_ingrediente];

} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger'role='alert'>Erro: Nenhum ingrediente encontrado!</div>"];

}

echo json_encode($retorna);