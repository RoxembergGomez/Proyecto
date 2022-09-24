<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000;" >AGREGAR SUBPROCESOS</h5>              
      <?php
      foreach ($infoid->result() as $row)
        {
        ?>
        <input type="text" name="idProceso" value="<?php echo $row->idProceso; ?>" required>
       <?php
        }
      echo form_open_multipart('controller_subprocesos/agregar');
      ?>

    </div>
      <div class="row">
        <div class="col-md-2">
          <label class="float-right">* Descripción de Subproceso:</label>
        </div>
        <div class="col-md-4">
          <input type="text" name="suproceso" class="col-md-12 form-control" placeholder="Describa el subproceso" autocomplete="off" >
        </div>
        <div class="col-md-2">
          <label class="float-right">* Grado de Criticidad:</label>
        </div>
        <div class="col-md-2">
          <select name="gradocriticidad" class="col-md-12 form-control" autocomplete="off">
            <option>Seleccione</option>
            <option value="Crítico">Crítico</option>
            <option value="No Crítico" > No Crítico</option>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-warning"><i class="fa fa-database"></i>  Agregar</button>
        </div>
      </div>
      <?php 
      echo form_close();
      ?>
<hr>
      <table class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Nro.</th>
                  <th class="text-center">SubProcesos</th>
                  <th class="text-center">Clasificación Criticidad</th>
                </tr>
              </thead>
              <tbody>
      
                 <tr>
                  <td ></td>
                  <td ></td>
                  <td ></td>
                </tr>
              </tbody>
            </table>
<hr>
<button type="submit" class="btn btn-success"><i class="fa fa-database"></i>  Insertar</button>
    </div>
    </div>
  </div>
</div>