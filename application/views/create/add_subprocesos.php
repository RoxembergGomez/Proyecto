<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5>AGREGAR SUBPROCESOS</h5>              
    </div> <hr>

    <?php foreach ($proceso->result() as $row) {?>
      <div class="row">
        <div class="col-md-12">
          <label >ACTIVIDAD:</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->informe;?>" disabled> <br>
        </div> 
      </div> <br>
       <div class="row">
        <div class="col-md-12">
          <label >PROCESO:</label>
          <input type="text" class="col-md-12 form-control" value="<?php echo $row->descripcionProceso;?>" disabled> <br>
        </div>
      </div> <br>
      <?php }

    echo form_open_multipart('controller_subprocesos/agregarbdd');
          ?>
      <input type="hidden" name="idproceso" value="<?php echo $_POST['idproceso'];?>">
      <input type="hidden" name="idPlan" value="<?php echo $_POST['idPlan'];?>">
      <div class="row">
        <div class="col-md-12">
          <label>DESCRIPCIÓN DEL SUBPROCESO:</label>
          <input type="text" name="subproceso" class="col-md-12 form-control" placeholder="Describa el subproceso" autocomplete="off" value="<?php echo set_value('subproceso'); ?>" > <br>
          <p style="color: red;"><?php echo form_error('subproceso');?></p>
        </div>
      </div> <br>
      <div class="row">
        <div class="col-md-12">
          <label >GRADO DE CRITICIDAD:</label>
          <select name="gradocriticidad" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('gradocriticidad'); ?>">
            <option value="">Seleccione el grado de criticidad</option>
            <option value="Crítico">Crítico</option>
            <option value="No Crítico" > No Crítico</option>
          </select><br>
          <p style="color: red;"><?php echo form_error('gradocriticidad');?></p>
        </div>
       </div>
       <hr>
        <div class="row float-right">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i>  Guardar</button>
         <?php 
        echo form_close();
        echo form_open_multipart('controller_subprocesos/index');
          ?>
          <input type="hidden" name="idproceso" value="<?php echo $_POST['idproceso']; ?>" >
          <input type="hidden" name="idPlan" value="<?php echo $_POST['idPlan']; ?>" >
          <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <?php echo form_close();?>
      </div>
    </div>
    </div>
  </div>
</div>