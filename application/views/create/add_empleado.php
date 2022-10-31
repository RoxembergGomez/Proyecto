<div class="col-md-12 col-sm-12 ">
  <div class="x_panel" >
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >DATOS DE EMPLEADO</h5>              
    </div> <hr>
      <?php
      echo form_open_multipart('controller_empleados/agregarbdd');
      ?>
      <div class="row">
        <div class="col-md-4">
          <label class="float-left">NOMBRE(S):</label>
          <input type="text" name="nombres" class="col-md-12 form-control" placeholder="Ingrese el nombre completo" autocomplete="off" value="<?php echo set_value('nombres'); ?>"> <br>
          <p style="color: red;"><?php echo form_error('nombres');?></p>
        </div>
        <div class="col-md-4">
         <label class="float-left">PRIMER APELLIDO:</label>
          <input type="text" name="primerApellido" class="col-md-12 form-control" placeholder="Ingrese el primer apellido" autocomplete="off"> <br>
          <p style="color: red;"><?php echo form_error('primerApellido');?></p>
        </div>
        <div class="col-md-4">
          <label class="float-left">SEGUNDO APELLIDO:</label>
          <input type="text" name="segundoApellido" class="col-md-12 form-control" placeholder="Ingrese el segundo apellido" autocomplete="off" value="<?php echo set_value('segundoApellido'); ?>"> <br>
          <p style="color: red;"><?php echo form_error('segundoApellido');?></p>
        </div>
      </div> <br>
      <div class="row">
        <div class="col-md-4">
          <label class="float-left">CÉDULA DE IDENTIDAD:</label>
          <input type="text" name="ci" class="col-md-12 form-control" placeholder="Ingrese el número de ci." autocomplete="off" value="<?php echo set_value('ci'); ?>"> <br>
          <p style="color: red;"><?php echo form_error('ci');?></p>
        </div>
        <div class="col-md-4">
          <label class="float-left">EXPEDICIÓN:</label>
          <select name="expedicion" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('expedicion'); ?>">
            <option value="">Seleccione...</option>
            <option value="CH">CH</option>
            <option value="LP">LP</option>
            <option value="CB">CB</option>
            <option value="OR">OR</option>
            <option value="PT">PT</option>
            <option value="TJ">TJ</option>
            <option value="SC">SC</option>
            <option value="BE">BE</option>
            <option value="PD">PD</option>
          </select><br>
          <p style="color: red;"><?php echo form_error('expedicion');?></p>
        </div>
        <div class="col-md-4">
          <label class="float-left" >CELULAR:</label>
          <input type="text" name="celular" class="col-md-12 form-control" placeholder="Ingrese el número de celular" autocomplete="off" value="<?php echo set_value('celular'); ?>"> <br>
          <p style="color: red;"><?php echo form_error('celular');?></p>
        </div>
      </div> <br>
      <div class="row">
         <div class="col-md-4">
          <label class="float-left">TELÉFONO INTERNO:</label>
          <input type="text" name="telefonoInterno" class="col-md-12 form-control" placeholder="Ingrese número de teléfono interno" autocomplete="off" value="<?php echo set_value('telefonoInterno'); ?>"> <br>
          <p style="color: red;"><?php echo form_error('telefonoInterno');?></p>
        </div>
        <div class="col-md-4">
          <label class="float-left">CORREO INSTITUCIONAL:</label>
          <input type="text" name="correoInstitucional" class="col-md-12 form-control" placeholder="Ingrese el correo institucional" autocomplete="off" value="<?php echo set_value('correoInstitucional'); ?>"> <br>
          <p style="color: red;"><?php echo form_error('correoInstitucional');?></p>
        </div>
        <div class="col-md-4">
          <label class="float-left">CARGO:</label>
          <select name="idCargo" class="col-md-12 form-control" autocomplete="off" value="<?php echo set_value('idCargo'); ?>">
            <option value=" ">Selecione...</option>
                <?php
                 foreach ($seleccion->result() as  $row)
              {?> <option value="<?php echo $row->idCargo;?>">
                <?php echo $row->denominacionCargo;?>
                </option><?php
                }?>
          </select> <br>
          <p style="color: red;"><?php echo form_error('idCargo');?></p>
        </div>
      </div>
      <hr>
      <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >DATOS DE USUARIO:</h5>              
    </div>
      <div class="row">
         <div class="col-md-4">
         <label class="float-left">NOMBRE DE USUARIO:</label>
          <input type="text" name="usuario" class="col-md-12 form-control" value="<?php echo set_value('usuario'); ?>" placeholder="Ingrese el Usuario"  autocomplete="off"><br>
          <p style="color: red;"><?php echo form_error('usuario');?></p>
          <?php if($msg=='1'){?>
              <p>  (*) Agregue otro usuario</p>
          <?php }?>
        </div>
        <div class="col-md-4">
         <label class="float-left">ROL:</label>
          <select name="tipo" class="col-md-12 form-control" id="rol" autocomplete="off" value="<?php echo set_value('tipo'); ?>">
            <option value="">Seleccione...</option>
            <option value="jefe">Jefe</option>
            <option value="ejecutor">Ejecutor</option>
            <option value="auditado">Auditado</option>
          </select> <br>
           <p style="color: red;"><?php echo form_error('tipo');?></p>
    
        </div>
        <div class="col-md-4">
          <label class="float-left">CONTRASEÑA:</label>
          <input type="password" name="contrasena" class="form-control" placeholder="Ingrese la contraseña" autocomplete="off" id="password1" value="<?php echo set_value('contrasena'); ?>">
          <span class=" form-control-feedback right" style="cursor: pointer; margin: 35px 0px 0px 0px;"  onclick="hideshow()" >
              <i id="slash" class="fa fa-eye-slash"></i>
              <i id="eye" class="fa fa-eye"></i>
          </span>
          <p style="color: red;"><?php echo form_error('contrasena');?></p>
          <?php if($msg=='2'){?>
              <p>  (*) Agregue otra contraseña </p>
          <?php } ?>
        </div>
      </div>
      <hr>
      <div class="row float-right">
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-database"></i>  Guardar</button>
      <?php 
      echo form_close();
       echo form_open_multipart('controller_empleados/index');
          ?>
          <button type="submit" class="btn btn-secondary btn-sm" id="botright"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
        <?php echo form_close();?>
      </div>
    </div>
    </div>
  </div>
</div>

<script>
    function hideshow(){
      var password = document.getElementById("password1");
      var slash = document.getElementById("slash");
      var eye = document.getElementById("eye");
      
      if(password.type === 'password'){
        password.type = "text";
        slash.style.display = "block";
        eye.style.display = "none";
      }
      else{
        password.type = "password";
        slash.style.display = "none";
        eye.style.display = "block";
      }

    }
  </script>
