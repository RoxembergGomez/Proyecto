<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000;" >AGREGAR SUBPROCESOS</h5>              
      <?php
      echo form_open_multipart('controller_subprocesos/agregarbdd');
      
      foreach ($infoid->result() as $row)
        {
        ?>
        <input type="hidden" name="idProceso" value="<?php echo $row->idProceso; ?>" required>
       <?php
        }
      ?>

    </div>
      <div class="row">
        <div class="col-md-2">
          <label class="float-right">* Descripción Sub-Proceso:</label>
        </div>
        <div class="col-md-5">
          <input type="text" name="unidadnegocio" class="col-md-12 form-control" placeholder="Ingrese la unidad de negocio" required> <br><br><br>
        </div>
        <div class="col-md-2">
          <label class="float-right">* Clasificación Criticidad:</label>
        </div>
        <div class="col-md-3">
          <select name="expedicion" class="col-md-12 form-control" required autocomplete="off">
            <option value="">Seleccione</option>
            <option value="Crítico">Crítico</option>
            <option value="No Crítico">No Crítico</option>
          </select> <br><br><br>
        </div>
      </div>
      <hr>
      <button type="submit" class="btn btn-success"><i class="fa fa-database"></i>  Agregar Unidad de Negocio</button>
      <?php 
      echo form_close();
      ?>
    </div>
    </div>
  </div>
</div>


if(isset($_POST['insertar']))

      {
        $items1 = ($_POST['descripcionSubProceso']);
        $items2 = ($_POST['clasificacionCriticidad']);
        $items3 = ($_POST['idUsuario']);
        $items4 = ($_POST['idProceso']);

        while(true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
            $item1 = current($items1);
            $item2 = current($items2);
            $item3 = current($items3);
            $item4 = current($items4);

            ////// ASIGNARLOS A VARIABLES ///////////////////
            $id=(( $item1 !== false) ? $item1 : ", &nbsp;");
            $nom=(( $item2 !== false) ? $item2 : ", &nbsp;");
            $carr=(( $item3 !== false) ? $item3 : ", &nbsp;");
            $gru=(( $item4 !== false) ? $item4 : ", &nbsp;");

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores='('.$id.',"'.$nom.'","'.$carr.'","'.$gru.'"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ= substr($valores, 0, -1);
          $this->Subprocesos_Model->agregarsubproceso($valoresQ);
           // Up! Next Value
            $item1 = next( $items1 );
            $item2 = next( $items2 );
            $item3 = next( $items3 );
            $item4 = next( $items4 );
            
            // Check terminator
            if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;
           }
          
    }