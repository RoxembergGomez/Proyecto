<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5  style="font-weight: bold; color: #000000; ">INGRESE LAS ACTIVIDADES A REALIZAR</h5>                 
      <?php
      echo form_open_multipart('controller_actividades/agregarbdd');
      ?>
    </div>
      <div class="row">
        <div class="col-md-2">
          <label class="float-right">* Informe:</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="informe" class="col-md-12 has-feedback-left form-control" placeholder="Ingrese el informe a realizar" required autocomplete="off"> <span class="fa fa-mobile-phone form-control-feedback left" aria-hidden="true"></span> <br><br><br>
        </div>
      </div>  
      <div class="row">
        <div class="col-md-2">
         <label class="float-right">* Objetivos:</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="objetivo" class="col-md-12 form-control" placeholder="Ingrese el objetivo" required autocomplete="off"> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label class="float-right">*Normativa Relacionada:</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="normativa" class="col-md-12 form-control" placeholder="Ingrese la normativa relacionada" required autocomplete="off"><br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label class="float-right">*Fecha de Inicio:</label>
        </div>
        <div class="col-md-3">
          <input type="date" name="fechaInicio" placeholder="Ingrese la fecha de inicio" class="col-md-12 form-control" required autocomplete="off">
        </div>
        <div class="col-md-3">
          <label class="float-right">*Fecha de Conclusión:</label>
        </div>
        <div class="col-md-3">
          <input type="date" name="fechaConclusion" class="col-md-12 form-control" placeholder="Ingrese la fecha de conclusión" required autocomplete="off"> <br><br><br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label class="float-right">*Grado de Priorización</label>
        </div>
        <div class="col-md-3">
          <select name="gradoPriorizacion" class="col-md-12 form-control" required autocomplete="off">
            <option value="">Seleccione el Grado de Priorización</option>
            <option value="Alta">Alta</option>
            <option value="Media">Media</option>
            <option value="Baja">Baja</option>
          </select> <br><br><br>
        </div>
      </div>
      <hr>
      <div class="row float-left">
      <button type="submit" class="btn btn-success"><i class="fa fa-database"></i>  Agregar Actividad</button>
      <?php 
      echo form_close();
      echo form_open_multipart('controller_actividades/index');
        ?>
        <button type="submit" class="btn btn-primary"><i class="fa fa-remove (alias)"></i>  Cancelar</button>
      <?php echo form_close();?>
      </div>
    </div>
    </div>
  </div>
</div>