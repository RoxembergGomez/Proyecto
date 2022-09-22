<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000;" >AGREGAR SUBPROCESOS</h5>              
      <?php
      
      echo form_open_multipart('controller_subprocesos/agregar');
      foreach ($infoid->result() as $row)
        {
        ?>
        <input type="" name="idProceso" value="<?php echo $row->idProceso; ?>" required>
       <?php
        }
      ?>

    </div>
      <div class="row">
        <div class="col-md-2">
          <label class="float-right">* Descripción de Subproceso:</label>
        </div>
        <div class="col-md-5">
          <input type="text" name="suproceso" class="col-md-12 form-control" placeholder="Describa el cargo" autocomplete="off" >
        </div>
        <div class="col-md-1">
          <label class="float-right">* Grado de Criticidad:</label>
        </div>
        <div class="col-md-2">
          <select name="gradocriticidad" class="col-md-12 form-control" autocomplete="off">
            <option>Sellecciones</option>
            <option value="Crítico">Crítico</option>
            <option value="No Crítico" > No Crítico</option>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-success"><i class="fa fa-database"></i>  Agregar</button>
        </div>
      </div>
       
      <?php 
      echo form_close();
      ?>
    </div>
    </div>
  </div>
</div>