<?php
require_once("includes/load.php");
?>
<script src="assets/js/pages-account-settings-account.js"></script>

<!-- Basic -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Empleados /</span> Nuevo</h4>

    <div class="col-md-10">

      <div class="card mb-4">
        <h5 class="card-header">Nuevo Empleado</h5>
        <div class="card-body demo-vertical-spacing demo-only-element">
          <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
              <div class="card-body">
                <div class="gap-4 mb-2" align="center">
                  <img src="assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="200" width="200" id="uploadedAvatar" />
                </div>
                <div class="button-wrapper row" align="center">

                  <div class="col-sm-12 col-md-6">
                    <label for="upload" class="btn btn-primary " tabindex="0">
                      <span class="d-none d-sm-block">Subir</span>
                      <i class="bx bx-upload d-block d-sm-none"></i>
                      <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                    </label>
                  </div>
                  <div class="col-md-6 text-left">
                    <button type="button" class="btn btn-outline-secondary account-image-reset ">
                      <i class="bx bx-reset d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Reset</span>
                    </button>
                  </div>
                  <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon11">ID</span>
                <input type="text" class="form-control" placeholder="Identidad" aria-label="Username" aria-describedby="basic-addon11" />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">Nombre y Apellido</span>
                <input type="text" aria-label="First name" class="form-control" />
                <input type="text" aria-label="Last name" class="form-control" />
              </div>
              <div class="mb-3 row">
                <label class="form-label">Fecha de Nacimiento</label>
                <div class="col-md-3 mb-3">
                  <input class="form-control" type="date" value="" id="html5-date-input" />
                </div>
                <div class="col-md-9">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon11">Correo</span>
                    <input type="text" class="form-control" placeholder="Correo" aria-label="Username" aria-describedby="basic-addon11" />
                  </div>
                </div>
              </div>
              <div>
                <label for="exampleFormControlTextarea1" class="form-label">Dirección</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>