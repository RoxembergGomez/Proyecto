<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >AGREGAR EMPLEADO</h5>              
      <?php
      echo form_open_multipart('controller_empleados/agregarbdd');
      ?>
    </div>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Nombre Completo:</label>
        </div>
        <div class="col-md-8">
          <input type="text" name="nombres" class="col-md-12 form-control" placeholder="Ingrese el nombre completo" required autocomplete="off"> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
         <label class="float-right">* Primer Apellido:</label>
        </div>
        <div class="col-md-8">
          <input type="text" name="primerApellido" class="col-md-12 form-control" placeholder="Ingrese el primer apellido" required autocomplete="off"> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">Segundo Apellido:</label>
        </div>
        <div class="col-md-8">
          <input type="text" name="segundoApellido" class="col-md-12 form-control" placeholder="Ingrese el segundo apellido" autocomplete="off"> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Cédula de Identidad:</label>
        </div>
        <div class="col-md-3">
          <input type="text" name="ci" class="col-md-12 form-control" placeholder="Ingrese el número de ci." required autocomplete="off"> <br><br><br>
        </div>
        <div class="col-md-2">
          <label class="float-right">* Expedición:</label>
        </div>
        <div class="col-md-3">
          <select name="expedicion" class="col-md-12 form-control" required autocomplete="off">
            <option value="">Seleccione</option>
            <option value="CH">CH</option>
            <option value="LP">LP</option>
            <option value="CB">CB</option>
            <option value="OR">OR</option>
            <option value="PT">PT</option>
            <option value="TJ">TJ</option>
            <option value="SC">SC</option>
            <option value="BE">BE</option>
            <option value="PD">PD</option>
          </select> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">Nro. Celular:</label>
        </div>
        <div class="col-md-3">
          <input type="text" name="celular" class="col-md-12 form-control" placeholder="Ingrese el número de celular" autocomplete="off"> <br><br><br>
        </div>
        <div class="col-md-2">
          <label class="float-right">Nro. Teléfono Interno:</label>
        </div>
        <div class="col-md-3">
          <input type="text" name="telefonoInterno" class="col-md-12 form-control" placeholder="Ingrese el número de teléfono interno" autocomplete="off"> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Correo Institucional:</label>
        </div>
        <div class="col-md-8">
          <input type="email" name="correoInstitucional" class="col-md-12 form-control" placeholder="Ingrese el correo institucional" required autocomplete="off"> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label class="float-right">* Cargo</label>
        </div>
        <div class="col-md-8">
            <select name="idCargo" class="col-md-12 form-control" required autocomplete="off">
            <option>Selecione un cargo</option>
                <?php
                 foreach ($seleccion->result() as  $row)
              {?> <option value="<?php echo $row->idCargo;?>">
                <?php echo $row->denominacionCargo;?>
                </option><?php
                }?>
          </select> <br><br><br> 
        </div>
      </div>
      <hr>
      <button type="submit" class="btn btn-success"><i class="fa fa-database"></i>  Agregar Empleado</button>
      <?php 
      echo form_close();
      ?>
    </div>
    </div>
  </div>
</div>
