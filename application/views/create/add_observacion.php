<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>INGRESE LAS OBSERVACIONES</h1> <hr>
      <?php 
      echo form_open_multipart('observacion/agregarbdd');
      ?>
      <div class="row">
        <div class="col-md-3">
          <label>Título:</label>
        </div>
        <div class="col-md-6">
          <input type="text" name="titulo" placeholder="Ingrese el título de la observación" class="form-control w-100" required>
          </div>
          <div class="col-md-3">
           <select name="priorizacion" class="form-control w-100" required>
            <option value="">Seleccione el Grado de Priorización</option>
            <option value="Alta">Alta</option>
            <option value="Media">Media</option>
            <option value="Baja">Baja</option>
          </select> <br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
         <label>Condición:</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="condicion" placeholder="Ingrese la Condición" class="form-control w-100" required> <br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label>Criterio:</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="criterio" placeholder="Ingrese el Criterio" class="form-control w-100" required > <br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label>Causa:</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="causa" placeholder="Ingrese la causa" class="form-control w-100" required> <br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label>Efecto</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="efecto" placeholder="Ingrese el efecto" class="form-control w-100" required> <br>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <label>Recomendación</label>
        </div>
        <div class="col-md-9">
          <input type="text" name="recomendacion" placeholder="Ingrese la recomendacion" class="form-control w-100" required> <br>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" >Agregar Actividad</button>
      <?php 
      echo form_close();
      ?>
      
    </div>
  </div>
</div>