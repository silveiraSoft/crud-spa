<?php
include_once(__DIR__."/../superior.php");
?>
<div style="height:10px"></div>
<div class="container card d-flex m-0 p-0">
  <div class="row">
    <div class="col-lg-12">
      <!-- Botão para acionar modal -->
      <button type="button" id="btnNovo" class="btn btn-success" data-toggle="modal" data-target="#modalDesenvolvedor">Novo</button>
    </div>
  </div>
<!--
</div>
<div style="height:10px"></div>
<div class="container">
-->
  <div class="row m-0 pt-2">
    <div class="col-lg-12">
      <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
        <table id="tabelaDesenvolvedores" class="table table-striped table-bordered" style="width:100%">
          <thead>
              <tr>
                  <th>Id</th>
                  <th>Nome</th>
                  <th>Sexo</th>
                  <th>Idade</th>
                  <th>Hobby</th>
                  <th>Data Nascimento</th>
                  <th>Ações</th>
              </tr>
          </thead>
          <tbody>
            <?php                            
            //foreach($data as $dat) {                                
            ?>
            <!--
            <tr>
                <td><?php // echo $dat['desenvolvedorId'] ?></td>
                <td><?php // echo $dat['nome'] ?></td>
                <td><?php // echo $dat['sexo'] ?></td>
                <td><?php // echo $dat['idade'] ?></td>
                <td><?php // echo $dat['hobby'] ?></td>
                <td><?php // echo $dat['dataNascimento'] ?></td>   
                <td></td>
            -->
            </tr>
            <?php
                //}
            ?>
          </tbody>
          <tfoot>
              <tr>
                  <th>Id</th>
                  <th>Nome</th>
                  <th>Sexo</th>
                  <th>Idade</th>
                  <th>Hobby</th>
                  <th>Data Nascimento</th>
                  <th>Ações</th>
              </tr>
          </tfoot>
        </table>
      </div>  
    </div>
  </div>         
</div>
<?php
//print_r($dat);exit;
?>
<!-- Modal -->
<div class="modal fade" id="modalDesenvolvedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desenvolvedorModalLabel">Novo Desenvolvedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formDesenvolvedor" class="needs-validation" novalidate>
        <div class="modal-body">
            <div class="form-group">
              <label for="nome" >Nome</label>
              <input type="text" minlength="1" maxlength="255" required class="form-control" id="developer_nome" data-error="Por favor, informe o nome." required>
              <div class="invalid-feedback">
                 Por favor, digite um nome com menos de 255 caracteres.
              </div>
              <div class="valid-feedback">
                 Validado ok
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="sexo">Sexo</label>
                <select class="form-control" required id="developer_sexo">
                  <option selected value="M">M</option>
                  <option value="F">F</option>
                </select>
              </div>  
              <div class="form-group col-md-3">  
                <label for="idade">Idade</label>
                <input type="number" required min=10 max=75 value="10" class="form-control" id="developer_idade">
              </div>
              <div class="form-group col-md-6">
                <label for="dataNacimento">Data Nascimento</label>
                <!--
                <input type="date" id="developer_dataNascimento" class="form-control" required>
                -->
                <div class="input-group date">
                  <input type="text" class="form-control" id="developer_dataNascimento" required>
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="hobby">Hobby</label>
              <span class="caracteres">250</span> Restantes <br>
              <textarea class="form-control is-invalid" id="developer_hobby" rows="3" minlength="1" maxlength="255" required>  
              </textarea>
              <div class="invalid-feedback">
                 Por favor, digite o(s) hobby(s) com menos de 255 caracteres.
              </div>
            </div>     
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="btnSalvar" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
include_once(__DIR__."/../inferior.php");