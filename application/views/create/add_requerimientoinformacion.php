<style>
  table
{
    counter-reset: rowNumber;
     background-color:white;
}

table tr > td:first-child
{
    counter-increment: rowNumber;
}

table tr td:first-child::before
{
    content: counter(rowNumber);
    min-width: 20em;
    margin-right: 10em;
}
</style>
<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000;" >AGREGAR SUBPROCESOS</h5>              
        <input type="hidden" name="idProceso" id="idProceso" value="<?php echo $_POST['idmpa']; ?>" required>
    </div>
      <div class="row">
        <div class="col-md-12">
          <label class="float-left">UNIDAD NEGOCIO</label>
          <select name="gradocriticidad" id="gradoCriticidad" class="col-md-12 form-control" autocomplete="off">
            <option value="0">Selecione...</option>
                <?php
                 foreach ($lista->result() as  $row)
              {?> <option value="<?php echo $row->idUnidadNegocio;?>">
                <?php echo $row->lineaNegocio;?>
                </option><?php
                }?>
          </select>
        </div>
      </div> <br>
      <div class="row">
        <div class="col-md-12">
          <label class="float-left">REQUERIMIENTO</label>
          <input type="text" name="suproceso" id="subProceso" class="col-md-12 form-control" placeholder="Describa el requerimiento" autocomplete="off" >
            <div class="valid-feedback">
        Please select a valid state.
        </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          <button style="margin:5px 0px 0px 0px;" type="button" id="btnAgregarSubproceso" onclick="agregarSubproceso()" class="btn btn-warning float-left btn-sm"><i class="glyphicon glyphicon-chevron-down"></i>  Agregar</button>
        </div>
      </div>

<hr>
      
      <table class="table table-striped table-bordered" id="tableSubProceso" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                  <th class="text-center">Detalle Requerimiento</th>
                  <th class="text-center">Unidad Negocio</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
        </table>
<hr>
<div class="row float-right">
<button type="submit" id="btnEnviar" class="btn btn-primary btn-sm" ><i class="fa fa-database"></i>  Guardar</button>
<?php echo form_open_multipart('controller_memorandumplanificacion/index');?>
  <input type="hidden" name="idMpa" id="idmpa" value="<?php echo $_POST['idmpa']; ?>">
  <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
<?php echo form_close();?>
</div>
    </div>
    </div>
  </div>
</div>

<script type="text/javascript">

let txtSubproceso = document.getElementById("subProceso");
let cbxGradoCriticidad = document.getElementById("gradoCriticidad");
let proceso = document.getElementById("idProceso");
let subProcesosArray = [];
let numFilas = 0;
var tabla =  document.getElementById('tableSubProceso');
document.getElementById("btnEnviar").addEventListener("click",function(){
  var baseUrl = "<?php echo base_url(); ?>";
  console.log(baseUrl);
    let elementos = tabla.children[1].children;
    for(let i = 0; i<elementos.length;i++){
      subProcesosArray.push({subProceso:elementos[i].children[1].innerHTML,gradoCriticidad:elementos[i].children[2].innerHTML,proceso:proceso.value});
    } 


    if(subProcesosArray.length>0){
      fetch("<?php echo base_url(); ?>" + "index.php/controller_requerimientoinformacion/agregarbdd",{
        method:'POST',
        body:JSON.stringify({data:subProcesosArray})
      }).then(datos=> datos.json())
      .then(datosDevueltos => {
        if(datosDevueltos.status === true){
          window.location.replace("<?php echo base_url(); ?>"+"index.php/controller_requerimientoinformacion/index");
        }else{
          new PNotify({
                  title: 'Error',
                  text: 'No se pudo guardar los registros.',
                  type: 'error',
                  hide: false,
                  styling: 'bootstrap3'
              });
        }
      
      }).catch(er => {
          new PNotify({
                  title: 'Error',
                  text: 'Comuniquese con el administrador.',
                  type: 'error',
                  hide: false,
                  styling: 'bootstrap3'
              });
      })
    }else{
      new PNotify({
                  title: 'Validacion',
                  text: 'Por favor agregue subprocesos.',
                  type: 'error',
                  hide: false,
                  styling: 'bootstrap3'
              });
    }
})

function modificarSubproceso(subproceso){
    let auxProceso = $(subproceso).parent().parent().children();
    txtSubproceso.value = auxProceso[1].innerText;
    cbxGradoCriticidad.value = auxProceso[2].innerText;
    $(subproceso).closest('tr').remove();
}

function eliminarSubproceso(data){
  $(data).closest('tr').remove();
}
function agregarSubproceso(){
  let validate = true;
  if(txtSubproceso.value!=="" && txtSubproceso.value.length>2){
      validate=true;
      if(txtSubproceso.classList.contains('is-invalid')){
        txtSubproceso.classList.remove('is-invalid');
      }
  }else{
    txtSubproceso.classList.add('is-invalid');
    validate = false;
  }
  if(cbxGradoCriticidad.value!=="0" && txtSubproceso.value.length>1){
      validate=true;
      if(cbxGradoCriticidad.classList.contains('is-invalid')){
        cbxGradoCriticidad.classList.remove('is-invalid');
      }
  }else{
    cbxGradoCriticidad.classList.add('is-invalid');
    validate = false;
  }
  if(validate){
    let data = {subProceso:txtSubproceso.value,gradoCriticidad:cbxGradoCriticidad.value,proceso:proceso.value}
    tabla.children[1].insertRow(-1).innerHTML = '<td class="text-center"></td><td>'+ data.subProceso +'</td><td class="text-center">' +data.gradoCriticidad+'</td><td class="text-center"><button type="button" class="btn btn-warning btn-sm modificar" onclick="modificarSubproceso(this);"><i class="fa fa-pencil-square-o"></i>Modificar</button><button type="button" class="btn btn-danger btn-sm borrar" onclick="eliminarSubproceso(this);"><i class="fa fa-trash"></i> Eliminar</button></td>'
    txtSubproceso.value = "";
  }
}


</script>