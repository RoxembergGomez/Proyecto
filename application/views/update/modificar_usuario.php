<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000; " >MODIFICAR USUARIO</h5>              
    </div>
    <?php 
        foreach ($infousuario->result() as $row) {
        echo form_open_multipart('controller_usuarios/modificarbd');
        ?>
        <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>"required>
      <div class="row">
        <div class="col-md-6">
         <label class="float-left" style="font-weight: bold;">* Nombre(s) y Apellido(s):</label><br>
          <input type="text" name="nombreCompleto" class="col-md-12 form-control" value="<?php echo $row->nombres.' '.$row->primerApellido.' '.$row->segundoApellido;?>">
          <?php echo form_error('usuario');?><br><br><br>
        </div>
        <div class="col-md-6">
         <label class="float-left" style="font-weight: bold;">* Usuario:</label><br>
          <input type="text" name="usuario" class="col-md-12 form-control" value="<?php echo $row->usuario; ?>">
          <?php echo form_error('usuario');?><br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
         <label class="float-left" style="font-weight: bold;">* Tipo:</label><br>
          <select name="tipo" class="col-md-12 form-control">
            <option><?php echo $row->tipo; ?></option>
            <option value="jefe">Jefe</option>
            <option value="ejecutor">Ejecutor</option>
            <option value="auditado">Auditado</option>
            <option value="invitado">Invitado</option>
          </select> <br><br><br>
        </div>
        <div class="col-md-6">
          <label class="float-left" style="font-weight: bold;">* Contraseña:</label> <br>
          <input type="password" name="contrasena" class="col-md-12 form-control">
        </div>
      </div>
      <hr>
      <div class="row float-left">
      <button type="submit" class="btn btn-success"><i class="fa fa-edit (alias)"></i>  Modificar Usuario</button>
      <?php 
      echo form_close();
      }
      echo form_open_multipart('controller_usuarios/index');
        ?>
        <button type="submit" class="btn btn-primary"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
      <?php echo form_close();?>
    </div>
    </div>
    </div>
</div>
</div>
</div>