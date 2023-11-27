<?php
require_once("includes/load.php");
?>
<script src="assets/js/pages-account-settings-account.js"></script>

<!-- Basic -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Nuevo</h5>
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Nuevo Empleado</h5>
        <form action="?page=sql_empleados" method="post">
          <div class="card-body demo-vertical-spacing demo-only-element">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon11">ID</span>
                      <input type="text" class="form-control" name="txtID" placeholder="Identidad" required aria-label="Username" aria-describedby="basic-addon11" />
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="input-group mb-3">
                      <span class="input-group-text">Nombre y Apellido</span>
                      <input type="text" name="txtNombre" placeholder="Nombre" required aria-label="First name" class="form-control" />
                      <input type="text" name="txtApellido" placeholder="Apellido" required aria-label="Last name" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="form-label">Fecha de Nacimiento</label>
                  <div class="col-md-4 mb-3">
                    <input class="form-control" type="date" id="html5-date-input" name="birthDate" required/>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon11">Teléfono</span>
                      <input type="text" class="form-control" name="txtTelefono" required placeholder="Teléfono" aria-describedby="basic-addon11" />
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon11">Correo</span>
                      <input type="text" class="form-control" name="txtCorreo" required placeholder="Correo" aria-describedby="basic-addon11" />
                    </div>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-md-12 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Dirección</label>
                    <textarea class="form-control" name="txtDireccion" id="txtDireccion" required rows="3"></textarea>
                  </div>
                </div>
                <div class="mb-3 row">
                  <div class="col-md-3">
                    <label for="selectContrato" class="form-label">Tipo Contrato</label>
                    <?php
                    echo llena_select("contratos", "selectContrato", "tipo", 0, "id", "true", "true");
                    ?>
                  </div>
                  <div class="col-md-3">
                    <div class="mb-3">
                      <label for="txtCargo" class="form-label">Cargo</label>
                      <input type="text" class="form-control" required name="txtCargo" placeholder="Cargo" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="selectDep" class="form-label">Departamento</label>
                    <?php
                    echo llena_select("departamentos", "selectDep", "departamento", 0, "id", "true", "true");
                    ?>
                  </div>
                  <div class="col-md-3">
                    <label for="selectEstacion" class="form-label">Estación</label>
                    <?php
                    echo llena_select("estaciones", "selectEstacion", "estacion", 0, "id", "true", "true");
                    ?>
                  </div>
                </div>
                <label class="form-label">Fecha Ingreso</label>
                <div class="col-md-4 mb-3">
                  <input class="form-control" type="date" required id="html5-date-input" name="fechaIngreso" />
                </div>
                <div class="col-md-12" align="right">
                  <button type="submit" class="btn btn-success" name="nuevoEmpleado">Guardar</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>