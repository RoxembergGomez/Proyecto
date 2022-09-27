<style type="text/css">
  label{
    font-weight: bold;
    color: #000000;
  }

  input {
    border-radius:0.5em;
    border-color: #6F6E69;
    height: 38px;
    border-width: 1px;
    border-style: solid;
  }
  select {
    border-radius:0.5em;
    border-color: #6F6E69;
    height: 38px;
    border-width: 1px;
  }

  input:hover{
    background-color: #ECEBEA;
  }


  select:hover{
    background-color: #ECEBEA;
  }

  hr{
    border-width: 2px;
    border-color: #6F6E69;
  }

  button:hover{
    background-color: #ECEBEA;
  }

</style>

<div class="col-md-12 col-sm-12 ">
  <div class="x_panel" style="background:#F6F6F6 ; ">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >DATOS DE EMPLEADO</h5>              
      <?php
      echo form_open_multipart('controller_empleados/agregarbdd');
      ?>
    </div>
      <div class="row">
        <div class="col-md-4">
          <label class="float-left">NOMBRE(S)</label> <br>
          <input type="text" name="nombres" class="col-md-12" placeholder="Ingrese el nombre completo" required autocomplete="off">
        </div>
        <div class="col-md-4">
         <label class="float-left">PRIMER APELLIDO</label>
          <input type="text" name="primerApellido" class="col-md-12" placeholder="Ingrese el primer apellido" required autocomplete="off">
        </div>
        <div class="col-md-4">
          <label class="float-left">SEGUNDO APELLIDO</label>
          <input type="text" name="segundoApellido" class="col-md-12" placeholder="Ingrese el segundo apellido" autocomplete="off"> <br><br><br>
        </div>
      </div> <br><br>
      <div class="row">
        <div class="col-md-4">
          <label class="float-left">CÉDULA DE IDENTIDAD:</label>
          <input type="text" name="ci" class="col-md-12" placeholder="Ingrese el número de ci." required autocomplete="off">
        </div>
        <div class="col-md-4">
          <label class="float-left">EXPEDICIÓN</label>
          <select name="expedicion" class="col-md-12" required autocomplete="off">
            <option>Seleccione...</option>
            <option value="CH">CH</option>
            <option value="LP">LP</option>
            <option value="CB">CB</option>
            <option value="OR">OR</option>
            <option value="PT">PT</option>
            <option value="TJ">TJ</option>
            <option value="SC">SC</option>
            <option value="BE">BE</option>
            <option value="PD">PD</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="float-left" >CELULAR</label>
          <input type="text" name="celular" class="col-md-12" placeholder="Ingrese el número de celular" autocomplete="off">
        </div>
      </div> <br><br>
      <div class="row">
         <div class="col-md-4">
          <label class="float-left">TELÉFONO INTERNO</label>
          <input type="text" name="telefonoInterno" class="col-md-12" placeholder="Ingrese número de teléfono interno" autocomplete="off">
        </div>
        <div class="col-md-4">
          <label class="float-left">CORREO INSTITUCIONAL</label>
          <input type="email" name="correoInstitucional" id="minus" class="col-md-12" placeholder="Ingrese el correo institucional" required autocomplete="off">
        </div>
        <div class="col-md-4">
          <label class="float-left">CARGO</label>
          <select name="idCargo" class="col-md-12" required autocomplete="off">
            <option>Selecione...</option>
                <?php
                 foreach ($seleccion->result() as  $row)
              {?> <option value="<?php echo $row->idCargo;?>">
                <?php echo $row->denominacionCargo;?>
                </option><?php
                }?>
          </select>
        </div>
      </div> <br>
      <hr>
      <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >DATOS DE USUARIO</h5>              
    </div>
      <div class="row">
         <div class="col-md-4">
         <label class="float-left">NOMBRE DE USUARIO</label><br>
          <input type="text" name="usuario" class="col-md-12" value="<?php echo set_value('usuario'); ?>" placeholder="Ingrese el Usuario" id="minus" autocomplete="off">
          <?php echo form_error('usuario');
          if($msg=='1'){?>
              <p>  (*) Agregue otro usuario</p>
          <?php }?>
        </div>
        <div class="col-md-4">
         <label class="float-left">ROL</label><br>
          <select name="tipo" class="col-md-12" id="rol" required autocomplete="off">
            <option >Seleccione...</option>
            <option value="jefe">Jefe</option>
            <option value="ejecutor">Ejecutor</option>
            <option value="auditado">Auditado</option>
            <option value="invitado">Invitado</option>
          </select>
    
        </div>
        <div class="col-md-4">
          <label class="float-left" style="font-weight: bold;">CONTRASEÑA</label> <br>
          <input type="password" name="contrasena" class="col-md-12" placeholder="Ingrese la contraseña" autocomplete="off">
          <?php if($msg=='2'){?>
              <p>  (*) Agregue otra contraseña </p>
          <?php } ?>
        </div>
      </div> <br>
      <hr>
      <button type="submit" class="btn btn-primary float-right"><i class="fa fa-database"></i>  Guardar</button>
      <?php 
      echo form_close();
      ?>
    </div>
    </div>
  </div>
</div>
