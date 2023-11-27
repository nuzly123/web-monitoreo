<?php
require_once("includes/load.php");
$listacargos = find_all('cargos');
?>
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Configuración /</span> Contratos</h4>

    <?php echo display_mssg($msg) ?>
    <!-- Striped Rows -->
    <div class="card">
    <div class="card-hearder">
      <div class="row">
        <div class="col-md-11">
          <h5 class="card-header">Cargos</h5>
        </div>
        <div class="col-md-1 mr-5 mt-4" align="center">
          <button type="submit" class="btn btn-sm btn-icon btn-info" name="addButton" data-bs-toggle="modal" data-bs-target="#newBasicModal">
            <span class="tf-icons bx bx-list-plus"></span>
          </button>
          
        </div>
        <?php include('modal_nuevoCargo.php'); ?>
      </div>
      </div>
      <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Cargo</th>
              <th>Creado</th>
              <th>Modificado</th>
              <th>Creado por</th>
              <th>Modificado por</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php foreach ($listacargos as $cargo) : ?>
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $cargo['cargo']; ?></strong></td>
                <td><?php echo $cargo['creado']; ?></td>
                <td><?php echo isset($cargo['modificado'])?$cargo['modificado']:"N/D";?></td>
                <td><?php $usuarioc = find_by_id('usuarios', $cargo['usuarioc']);
                    echo $usuarioc['usuario'] ?></td>
                <td><?php $usuariom = find_by_id('usuarios', $cargo['usuariom']);
                    echo isset($usuariom['usuario'])?$usuariom['usuario']:"N/D";?></td>
                <td class="text-center">
                  <form action="?page=sql_cargos" method="post">
                    <input type="hidden" name="idCargo" value="<?php echo $cargo['id'] ?>" />
                    <?php if ($cargo['estado'] == 1) { ?>
                      <button type="submit" class="btn btn-sm btn-icon btn-success" name="desactivar" id="estadoCargo">
                        <span class="tf-icons bx bx-check"></span>
                      </button>
                    <?php } else { ?>
                      <button type="submit" class="btn btn-sm btn-icon btn-danger" name="activar" id="estadoCargo">
                        <span class="tf-icons bx bx-x"></span>
                      </button>
                    <?php } ?>
                  </form>
                </td>
                <td class="text-center">
                  <button type="submit" class="btn btn-sm btn-icon btn-warning" name="activar" data-bs-toggle="modal" data-bs-target="#basicModal<?php echo $cargo['id']; ?>">
                    <span class="tf-icons bx bxs-edit-alt"></span>
                  </button>
                  <!-- Modal -->
                  
                </td>
                <?php include('modal_editarCargo.php') ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      </div>
    </div>
    <!--/ Striped Rows -->
    </div>
</div>