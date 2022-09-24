<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title text-center">
      <h5 style="font-weight: bold; color: #000000;" >AGREGAR PROCESOS</h5>              
      <?php
      echo form_open_multipart('controller_procesos/agregarbdd');
      ?>

    </div>

        <div class="row">
        <div class="col-md-2">
          <label class="float-right">* Actividad:</label>
        </div>
        <div class="col-md-5">
          <select name="idPlan" class="col-md-12 form-control" required autocomplete="off">
            <option>Selecione</option>
                <?php
                $indice=1;
                 foreach ($actividad->result() as  $row)
              {?> <option value="<?php echo $row->idPlanAnualTrabajo;?>"><?php echo $indice.'  '.$row->informe;?>
                </option><?php
                $indice++;
                }?>
          </select>
        </div>
        <div class="col-md-2">
          <label class="float-right">* Unidad de Negocio:</label>
        </div>
        <div class="col-md-3">
          <select name="idUnidadNegocio" class="col-md-12 form-control" required autocomplete="off">
            <option>Selecione</option>
                <?php
                $indice=1;
                 foreach ($unidadnegocio->result() as  $urow)
              {?> <option value="<?php echo $urow->idUnidadNegocio;?>">
                <?php echo $indice.'  '. $urow->lineaNegocio;?>
                </option><?php
                $indice++;
                }?>
          </select>
        </div>  <br> <br><br>
        </div>
        <div class="row">
        <div class="col-md-2">
          <label class="float-right">* Descripción del proceso:</label>
        </div>
        <div class="col-md-10">
          <input type="text" name="proceso" class="col-md-12 form-control" placeholder="Describa el proceso" autocomplete="off" >
        </div>
        </div>
        <hr>

         <button type="submit" class="btn btn-warning"><i class="fa fa-database"></i>  Agregar</button>

      <?php 
      echo form_close();
      ?>
    </div>
    </div>
  </div>
</div>