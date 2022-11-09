const tbody = document.querySelector(".listar-ingredientes");
const cadForm = document.getElementById("cad-ingrediente-form");
const editForm = document.getElementById("edit-ingrediente-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadIngredienteModal")); 

const listarIngredientes = async (pagina) => {
    const dados = await fetch("./list.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarIngredientes(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("cad-ingrediente-btn").value = "Salvando...";
    
    if(document.getElementById("Nome_Ingredientes").value === ""){
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo nome!</div>";
    }else{
        const dadosForm = new FormData(cadForm);
        dadosForm.append("add", 1);

        const dados = await fetch("cadastrar.php", {
            method:"POST",
            body: dadosForm,
        });

        const resposta = await dados.json();

        if(resposta['erro']){
            msgAlertaErroCad.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            cadForm.reset();     
            cadModal.hide();
            listarIngredientes(1);
        }
    }

    document.getElementById("cad-ingrediente-btn").value = "Cadastrar";
});

async function visIngrediente(Id_Ingredientes){
    //console.log("Acessou: " + Id_Ingredientes);
    const dados = await fetch('visualizar.php?Id_Ingredientes=' + Id_Ingredientes);
    const resposta = await dados.json();
    //console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    }else{
        const visModal = new bootstrap.Modal(document.getElementById("visIngredienteModal"));
        visModal.show();

        document.getElementById("idIngrediente").innerHTML = resposta['dados'].Id_Ingredientes;
        document.getElementById("nomeIngrediente").innerHTML = resposta['dados'].Nome_Ingredientes;
    }

}

async function editIngredienteDados(Id_Ingredientes){
    msgAlertaErroEdit.innerHTML = "";
    
    const dados = await fetch('visualizar.php?Id_Ingredientes=' + Id_Ingredientes);
    const resposta = await dados.json();
    //console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    }else{
        const editModal = new bootstrap.Modal(document.getElementById("editIngredienteModal"));   
        editModal.show(); 

        document.getElementById("editId").value = resposta['dados'].Id_Ingredientes;
        document.getElementById("editNome").value = resposta['dados'].Nome_Ingredientes;

    }
}

editForm.addEventListener("submit", async(e) => {
    e.preventDefault();

    document.getElementById("edit-ingrediente-btn").value = "Salvando...";
    
    const dadosForm = new FormData(editForm);
    //console.log(dadosForm);
    /*for(var dadosFormEdit of dadosForm.entries()){
        console.log(dadosFormEdit[0]+'-'+dadosFormEdit[1]);
    }*/

    const dados = await fetch ("editar.php", {
        method: "POST",
        body:dadosForm
    });

    const resposta = await dados.json();
    //console.log(resposta);

    if(resposta['erro']){
        msgAlertaErroEdit.innerHTML = resposta['msg'];
    }else{
        msgAlertaErroEdit.innerHTML = resposta['msg'];
        listarIngredientes(1);
    }

    document.getElementById("edit-ingrediente-btn").value = "Salvar";
});

async function apagarIngredienteDados(Id_Ingredientes){
    //console.log("Acessou a função: "+ Id_Ingredientes);
    var confirmar = confirm("Tem certeza que deseja excluir o item selecionado?");

    if(confirmar == true){
        const dados = await fetch('apagar.php?Id_Ingredientes='+Id_Ingredientes);

        const resposta = await dados.json();
        if(resposta['erro']){
            msgAlerta.innerHTML = resposta['msg'];
        }else{
            msgAlerta.innerHTML = resposta['msg'];
            listarIngredientes(1);
        }

    }else{
        
    }

}