<style>
  table
{
    counter-reset: rowNumber;
}

table tr > td:first-child
{
    counter-increment: rowNumber;
}

table tr td:first-child::before
{
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
}
</style>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >CREAR REQUERIMIENTO DE INFORMACIÓN</h5>              

    </div>

      <input type="hidden" name="idMpa" id="idmpa" value="<?php echo $_POST['idmpa']; ?>">
    
      <div class="row">
        <div class="col-md-12">
          <label class="float-left">UNIDAD DE NEGOCIO:</label>
         <select name="unidadnegocio" id="unidadnegocio" class="col-md-12 form-control" autocomplete="off">
            <option value="0">Selecione...</option>
                <?php
                 foreach ($lista->result() as  $row)
              {?> <option value="<?php echo $row->idUnidadNegocio;?>">
                <?php echo $row->lineaNegocio;?>
                </option><?php
                }?>
          </select>
        </div>
      </div>  <br>
      <div class="row">
        <div class="col-md-12">
          <label class="float-left">REQUERIMIENTO:</label>
            <input type="text" name="requerimiento" id="requerimiento" class="col-md-12 form-control" placeholder="Describa el requerimiento" autocomplete="off">
            <div class="valid-feedback">
        Please select a valid state.
        </div>
        </div>
      </div> <br>
        <div class="row">
        <div class="col-md-12">
         <button type="submit" id="btnactividad" class="btn btn-warning float-right" onclick="agregarActividad()" ><i class="fa fa-database"></i>  Agregar</button>
        </div>
      </div>
      <hr>
      <table class="table table-striped table-bordered" id="tableActividad" style="width:100%">
              <thead>
                <tr>                
                  <th class="text-center ">Nro.</th>
                  <th class="text-center ">Requerimiento</th>
                  <th class="text-center ">Unidad de Negocio</th>
                  <th class="text-center ">Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
        </table>
       <hr>
      <button type="submit" class="btn btn-primary float-right" id="btnEnviar" ><i class="fa fa-database"></i>  Agregar Requerimiento</button>
    </div>
    </div>
  </div>
</div>

<script type="text/javascript">

let cbxSubproceso = document.getElementById("unidadnegocio");
let txtActividad = document.getElementById("requerimiento");
let mpa = document.getElementById("idmpa");
let actividadArray = [];
let numFilas = 0;
var tabla =  document.getElementById('tableActividad');
document.getElementById("btnEnviar").addEventListener("click",function(){
  var baseUrl = "<?php echo base_url(); ?>";
  console.log(baseUrl);
    let elementos = tabla.children[1].children;
    for(let i = 0; i<elementos.length;i++){
      actividadArray.push({requerimiento:elementos[i].children[1].innerHTML,unidadnegocio:elementos[i].children[2].innerHTML,mpa:mpa.value});
    }

    if(actividadArray.length>0){
      fetch("<?php echo base_url(); ?>" + "index.php/controller_requerimientoinformacion/agregarbdd",{
        method:'POST',
        body:JSON.stringify({data:actividadArray})
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

function modificarActividad(actividad){
    let auxActividad = $(actividad).parent().parent().children();
    txtActividad.value = auxActividad[1].innerText;
    $(actividad).closest('tr').remove();
}

function eliminarActividad(data){
  $(data).closest('tr').remove();
}
function agregarActividad(){
  let validate = true;
  if(txtActividad.value!=="" && txtActividad.value.length>2){
      validate=true;
      if(txtActividad.classList.contains('is-invalid')){
        txtActividad.classList.remove('is-invalid');
      }
  }else{
    txtActividad.classList.add('is-invalid');
    validate = false;
  }
  if(cbxSubproceso.value!=="0" && txtActividad.value.length>1){
      validate=true;
      if(cbxSubproceso.classList.contains('is-invalid')){
        cbxSubproceso.classList.remove('is-invalid');
      }
  }else{
    cbxSubproceso.classList.add('is-invalid');
    validate = false;
  }
  if(validate){
    let data = {actividad:txtActividad.value,subproceso:cbxSubproceso.value,mpa:mpa.value}
    tabla.children[1].insertRow(-1).innerHTML = '<td class="text-center" ></td><td>'+ data.actividad +'</td><td>'+ data.subproceso +'</td><td class="text-rigth"><button type="button" class="btn btn-danger btn-sm borrar float-right" onclick="eliminarActividad(this);"><i class="fa fa-trash"></i> Eliminar</button><button type="button" class="btn btn-warning btn-sm modificar float-right" onclick="modificarActividad(this);"><i class="fa fa-pencil-square-o"></i>Modificar</button></td>'
    txtActividad.value = "";
  }
}

</script>