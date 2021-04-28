$(document).ready(function() {  


var result_val = true;
/*
(function () {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
    result_val = true;
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
     .forEach(function (form) {
       form.addEventListener('submit', function (event) {
         if (!form.checkValidity()) {
           event.preventDefault()
           event.stopPropagation()
           result_val = false;
           console.log("aqui"+result_val);
         }else{
            result_val = true;
           console.log("aqui"+result_val);
         }

         form.classList.add('was-validated')
       }, false)
     })
})()
*/
(function() {
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    //var forms = document.querySelectorAll('.needs-validation')
    var forms = document.querySelectorAll('#formDesenvolvedor')
    result_val = true;
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
     .forEach(function (form) {
       form.addEventListener('submit', function (event) {
         if (!form.checkValidity()) {
           event.preventDefault()
           event.stopPropagation()
           result_val = false;
           //console.log("aqui"+result_val);
         }else{
            result_val = true;
           //console.log("aqui"+result_val);
         }

         var texto_textarea = $('#developer_hobby').val();
         //console.log("texto_textatea"+texto_textarea);
         if(texto_textarea.trim().length > 0){
            $('#developer_hobby').addClass('is-valid');
            $('#developer_hobby').addClass('valid');
            $('#developer_hobby').removeClass('is-invalid');
            $('#developer_hobby').removeClass('invalid');
            //console.log("validado ok texto_textatea");
         }else{
            $('.caracteres').text('255');
            $('#developer_hobby').val('');
            $('#developer_hobby').addClass('is-invalid');
            $('#developer_hobby').removeClass('is-valid');
            $('#developer_hobby').addClass('invalid');
            $('#developer_hobby').removeClass('valid');
            result_val = false;
         }
         form.classList.add('was-validated')
       }, false)
     })     
})();

/*
function valida_form(event){
    console.log("aqui");
    'use strict'
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    //var forms = document.querySelectorAll('.needs-validation')
    var form = $("#formDesenvolvedor");
    var result_val = true;
    // Loop over them and prevent submission

    Array.prototype.slice.call(forms)
     .forEach(function (form) {   
       //form.addEventListener('submit', function (event) {   
         if (!form.checkValidity()) {
           event.preventDefault()
           event.stopPropagation()
           result_val = false;
           console.log("aqui"+result_val);

         }else{
            result_val = true;
           console.log("aqui"+result_val);
         }

         form.classList.add('was-validated')
      }, false)
     
    })
    

     return result_val;
};
*/
 

$('#developer_dataNascimento').datepicker({
    format: 'dd/mm/yyyy',
    //startDate: '-1d',
    language:'pt-BR'
});

tabelaDesenvolvedores = $('#tabelaDesenvolvedores').DataTable({
//para cambiar el lenguaje a español
    "order":[[0, "desc"]],
    "columnDefs":[{
    "targets": -1,
    "data":null,
    "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnEliminar'>Borrar</button></div></div>"  
    }],
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "Não se encontraram resultados",
        "info": "Mostrando registros do _START_ ao _END_ de um total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros do 0 ao 0 de um total de 0 registros",
        "infoFiltered": "(filtrado de um total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sFirst": "Primeiro",
            "sLast":"Último",
            "sNext":"Seguinte",
            "sPrevious": "Anterior"
	     },
	     "sProcessing":"Processando...",
    },
    "ajax":{            
        "url": "/crud-spa/action/desenvolvedorAction.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{acao:'getTodos'}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "desenvolvedorId"},
        {"data": "nome"},
        {"data": "sexo"},
        {"data": "idade"},
        {"data": "hobby"},
        {"data": "dataNascimento"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnEliminar'>Borrar</button></div></div>"}
    ],
});


var user_id, opcion;
opcion = 4;
var converterData = function(data){
   return data+"1";
}


$(document).on("keydown", "#developer_hobby", function () {
    var caracteresRestantes = 255;
    var caracteresDigitados = parseInt($(this).val().length);
    var caracteresRestantes = caracteresRestantes - caracteresDigitados;
    $(".caracteres").text(caracteresRestantes);
});


var fila; //captura a fila, para editar ou eliminar
/**
*
* submit para salvar e Actuazar
*/

$('#formDesenvolvedor').submit(function(e){                        
    e.preventDefault(); //evita o comportamento normal do submit, a recarga total da página
    e.stopPropagation();
    /*
    var result_val1 = valida_form(e);
    //if(valida_form()==true){
    var x = result_val1;
    console.log("click"+result_val1);
    */
    //valida_form_desenvolvedores();
    if(result_val){
       
       nome = $.trim($('#developer_nome').val());    
       idade = $.trim($('#developer_idade').val());
       hobby = $.trim($('#developer_hobby').val());    
       dataNascimento = $.trim($('#developer_dataNascimento').val());    
       sexo = $.trim($('#developer_sexo').val());
       if(user_id === null && opcion == 1){
           //url = "http://localhost:8080/developers";
           //method = "POST";
           acao = 'salvar';
           //data_entrada = JSON.stringify({nome:nome, sexo:sexo, idade:idade, hobby:hobby, dataNascimento:dataNascimento, acao:acao});
           data_entrada = {nome:nome, sexo:sexo, idade:idade, hobby:hobby, dataNascimento:dataNascimento, acao:acao};
           //console.log(data_entrada);
       }else if(opcion==2 && user_id > 0) {
           //url = "http://localhost:8080/developers/"+user_id;
           //method = "PUT";
           acao = 'salvar';
           //data_entrada = JSON.stringify({desenvolvedorId:desenvolvedorId, nome:nome, sexo:sexo, idade:idade, hobby:hobby, dataNascimento:dataNascimento, acao:acao});
           data_entrada = {desenvolvedorId:user_id, nome:nome, sexo:sexo, idade:idade, hobby:hobby, dataNascimento:dataNascimento, acao:acao};
           //console.log(user_id);
       }
       //console.log(data_entrada);
       url = "desenvolvedorAction.php";
       /*
       $.ajax({
         url: url,
         type: "POST",
         contentType: "application/json; charset=utf-8",
         datatype:"json",    
         data: data_entrada,   
         success: function(data) {
           console.log(data);
           tabelaDesenvolvedores.ajax.reload(null, false);
          }
       });
       */
       $.ajax({
         url: "desenvolvedorAction.php",
         type: "POST",
         //contentType: "application/json; charset=utf-8",
         dataType:'json',    
         data:data_entrada,   
         success: function(data) {
           console.log(data);
           //data = JSON.parse(data);
           console.log(data.length);
           //if(data[0].length == 0 ){
           if(data.length == 0 ){ 
            //alert("Erro ao salvar. Codigo: "+data[1]);
            alert("Erro ao salvar. Codigo: 400");
           }
           /*
           data = JSON.parse(data);
           //console.log(data);
           
           desenvolvedorId = data[0].desenvolvedorId;            
           nome = data[0].nome;
           idade = data[0].idade;
           sexo = data[0].sexo;
           hobby = data[0].hobby;
           dataNascimento = data[0].dataNascimento;
           if(opcion == 1){tabelaDesenvolvedores.row.add([desenvolvedorId.toString(),nome,sexo,idade,hobby,dataNascimento]).draw();}
           else{tabelaDesenvolvedores.row(fila).data([desenvolvedorId.toString(),nome,sexo,idade,hobby,dataNascimento]).draw();}
           */
           tabelaDesenvolvedores.ajax.reload(null, false);

         },
          error: function (xhr, ajaxOptions, thrownError) {
            alert('Erro ao salvar. Status:'+xhr.status+' '+thrownError);
            //alert(thrownError);
          }
       });
       $('#formDesenvolvedor').trigger('reset');
       $('#formDesenvolvedor').removeClass('was-validated');
       $('#modalDesenvolvedor').modal('hide');  
    }
                                                            
});

$('#modalDesenvolvedor').on('hidden.bs.modal', function (event) {
  $('#formDesenvolvedor').trigger('reset');
  $('#formDesenvolvedor').removeClass('was-validated');
})
        
 

//limpar os campos antes de cadastrar novo
$("#btnNovo").click(function(){
    opcion = 1; //cadastrar           
    user_id=null;
    $("#formDesenvolvedor").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Novo Desenvolvedor");
    $('#modalDesenvolvedor').modal('show');      
});

//Editar        
$(document).on("click", ".btnEditar", function(){
    opcion = 2;//editar
    fila = $(this).closest("tr");           
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
    nome = fila.find('td:eq(1)').text();
    sexo = fila.find('td:eq(2)').text();
    idade = parseInt(fila.find('td:eq(3)').text());
    hobby = fila.find('td:eq(4)').text();
    dataNascimento = fila.find('td:eq(5)').text();
    //dataNascimento = dataNascimento.replace(/(\d*)\/(\d*)\/(\d*)/, '$3-$2-$1');
    $("#developer_nome").val(nome);
    $("#developer_sexo").val(sexo);
    $("#developer_idade").val(idade);
    $("#developer_hobby").val(hobby);
    $("#developer_dataNascimento").val(dataNascimento);
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Desenvolvedor");       
    $('#modalDesenvolvedor').modal('show');         
});

//Borrar
$(document).on("click", ".btnEliminar", function(){
    fila = $(this);           
    user_id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;     
    opcion = 3; //eliminar        
    var respuesta = confirm("¿Quer deletar o registro "+user_id+"?");                
    if (respuesta) {            
        $.ajax({
          url: "desenvolvedorAction.php",
          type: "POST",
          dataType:"json",    
          data: {desenvolvedorId:user_id, acao:"eliminar"},    
          success: function() {
              tabelaDesenvolvedores.row(fila.parents('tr')).remove().draw();                  
           }
        }); 
    }
 });
         
});