<div class="col-md-12 col-sm-12 ">

  
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >AGREGAR USUARIO</h5>              
    </div>

    <?php
      echo form_open_multipart('controller_usuarios/agregarbdd');
      ?>
    <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="row" id="dist">
        <div class="col-md-6">
		   <label class="usuario" style="font-weight: bold;">* Empleado:</label>
		   <select name="idEmpleado" class="col-md-12 form-control" required autocomplete="off">
            <option>Seleccione empleado</option>
                <?php
                 foreach ($seleccion->result() as  $row)
              {?> <option value="<?php echo $row->idEmpleado;?>">
                <?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?>
                </option><?php
                }?>
          </select>
        </div>
        <div class="col-md-6">
         <label class="float-left" style="font-weight: bold;">* Usuario:</label><br>
          <input type="text" name="usuario" class="col-md-12 form-control" value="<?php echo set_value('usuario'); ?>" placeholder="Ingrese el Usuario" autocomplete="off">
          <?php echo form_error('usuario');
          if($msg=='1'){?>
              <p id="validar" >  (*) Agregue un número correlativo al nombre de usuario </p>
          <?php } ?>
        </div>
      </div>
      <div class="row" id="dist">
      	<div class="col-md-6">
         <label class="float-left" style="font-weight: bold;">* Tipo:</label><br>
          <select name="tipo" class="col-md-12 form-control" required autocomplete="off">
            <option >Seleccione un tipo de usuario</option>
            <option value="jefe">Jefe</option>
            <option value="ejecutor">Ejecutor</option>
            <option value="auditado">Auditado</option>
            <option value="invitado">Invitado</option>
          </select>
    
        </div>
        <div class="col-md-6">
          <label class="float-left" style="font-weight: bold;">* Contraseña:</label> <br>
          <input type="password" name="contrasena" class="col-md-12 form-control" placeholder="Ingrese la contraseña" autocomplete="off">
          <?php if($msg=='2'){?>
              <p id="validar" >  (*) Agregue otra contraseña </p>
          <?php } ?>
        </div>
      </div>
        <hr>
        <button type="submit" class="btn btn-success"><i class="fa fa-database"></i>  Crear Usuario</button>
      </div>
      <div class="col-md-2"></div>
      </div>
      <?php 
      echo form_close();
      ?>
    </div>
    </div>
  </div>
</div>