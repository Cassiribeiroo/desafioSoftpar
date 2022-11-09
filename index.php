<?php
include_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4>Todo List</h4>
                </div>
                <div>
                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadIngredienteModal">
                Incluir
                </button>
                </div>
            </div>
        </div>
        <hr>

        <span id="msgAlerta"></span>

        <div class="row">
            <div class="col-lg-12">
                <span class="listar-ingredientes">

                </span>
                    

            </div>
        </div>
    </div>

    <div class="modal fade" id="cadIngredienteModal" tabindex="-1" aria-labelledby="cadIngredienteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="cadIngredienteModal">Tarefa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="cad-ingrediente-form">
          <span id="msgAlertaErroCad"></span>          
          <div class="mb-3">
            <label for="Nome_Ingredientes" class="col-form-label">Tarefa</label>
            <input type="text" name="Nome_Ingredientes" class="form-control" id="Nome_Ingredientes" placeholder="Digite o nome da tarefa" >
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
            <input type="submit" class="btn btn-outline-success btn-sm" id="cad-ingrediente-btn" value="Cadastrar" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="visIngredienteModal" tabindex="-1" aria-labelledby="visIngredienteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="visIngredienteModal">Detalhes da Tarefa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <span id="msgAlertaErroVis"></span>
          <dl class="row">
            <dt class="col-sm-3">Id</dt>
            <dd class="col-sm-9"><span id="idIngrediente"></span></dd>   
            
            <dt class="col-sm-3">Tarefa</dt>
            <dd class="col-sm-9"><span id="nomeIngrediente"></span></dd>  
          </dl>      
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editIngredienteModal" tabindex="-1" aria-labelledby="editIngredienteModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="editIngredienteModal">Editar Tarefa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="edit-ingrediente-form">
          <span id="msgAlertaErroEdit"></span>

            <input type="hidden" name="Id_Ingredientes" id="editId">          

          <div class="mb-3">
            <label for="Nome_Ingredientes" class="col-form-label">Tarefa</label>
            <input type="text" name="Nome_Ingredientes" class="form-control" id="editNome" placeholder="Digite o nome da tarefa" >
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
            <input type="submit" class="btn btn-outline-warning btn-sm" id="edit-ingrediente-btn" value="Salvar" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="js/custom.js"></script>
</body>
</html>