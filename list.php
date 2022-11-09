<?php
include_once "conexao.php";

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if(!empty($pagina)){

    //Calcular o inicio visualização
    $qnt_result_pg = 10; //Quantidade de registro por pagina
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

$query_ingredientes = "SELECT Id_Ingredientes, Nome_Ingredientes FROM ingredientes LIMIT $inicio, $qnt_result_pg";
$result_ingredientes = $conn->prepare($query_ingredientes);
$result_ingredientes->execute();

$dados = "<div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID </th>
                        <th>Tarefa</th>
                        <th>View</th>
                    </tr>
                </thead>
            <tbody>";
while($row_ingrediente = $result_ingredientes->fetch(PDO::FETCH_ASSOC)){
    extract($row_ingrediente);
    $dados .= "<tr>
                <td>$Id_Ingredientes</td>
                <td>$Nome_Ingredientes</td>
                <td>
                    <button id='$Id_Ingredientes' class='btn btn-outline-primary btn-sm' onclick='visIngrediente($Id_Ingredientes)'>Visualizar</button>

                    <button id='$Id_Ingredientes' class='btn btn-outline-warning btn-sm' onclick='editIngredienteDados($Id_Ingredientes)'>Editar</button>

                    <button id='$Id_Ingredientes' class='btn btn-outline-danger btn-sm' onclick='apagarIngredienteDados($Id_Ingredientes)'>Apagar</button>
                </td>
               </tr>";

}

$dados .= "</tbody>
        </table>
    </div>";

// Paginação - somar a quantidade de usuario    
$query_pg = "SELECT COUNT(Id_Ingredientes) AS num_result FROM ingredientes";
$result_pg = $conn->prepare($query_pg);
$result_pg->execute();
$row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

//Quantidade de paginas
$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

$max_links = 2;

$dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';

$dados .= "<li class='page-item'><a href='#' class='page-link' onclick='listarIngredientes(1)'>Primeira</a></li>";  

for($pag_ant = $pagina - $max_links; $pag_ant<= $pagina-1; $pag_ant++){
    if($pag_ant >= 1){
        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarIngredientes($pag_ant)'>$pag_ant</a></li>";
    }
}

$dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";     

for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
    if($pag_dep <= $quantidade_pg){
        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarIngredientes($pag_dep)'>$pag_dep</a></li>"; 
    }
}

  
$dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarIngredientes($quantidade_pg)'>Última</a></li>";   
    
$dados .= '</ul></nav>';     
      
echo $dados;
} else {
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhum ingrediente encontrado! </div>";
}

