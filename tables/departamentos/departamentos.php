<?php
require_once("includes/load.php");
$listadep = find_all('departamentos');

?>
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Configuración /</span> Departamentos</h4>

        <?php echo display_mssg($msg) ?>
        <!-- Striped Rows -->
        <div class="card">
            <div class="row">
                <div class="col-md-11">
                    <h5 class="card-header">Departamentos</h5>
                </div>
                <div class="col-md-1 mr-5 mt-4" align="center">
                    <button type="submit" class="btn btn-sm btn-icon btn-info" name="addButton" data-bs-toggle="modal" data-bs-target="#newBasicModal">
                        <span class="tf-icons bx bx-list-plus"></span>
                    </button>

                </div>
                <?php include('modal_nuevoDep.php'); ?>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Departamentos</th>
                            <th>Creado</th>
                            <th>Modificado</th>
                            <th>Creado por</th>
                            <th>Modificado por</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php foreach ($listadep as $departamento) : ?>
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $departamento['departamento']; ?></strong></td>
                                <td><?php echo $departamento['creado']; ?></td>
                                <td><?php echo isset($departamento['modificado']) ? $departamento['modificado'] : "N/D"; ?></td>
                                <td><?php $usuarioc = find_by_id('usuarios', $departamento['usuarioc']);
                                    echo $usuarioc['usuario'] ?></td>
                                <td><?php $usuariom = find_by_id('usuarios', $departamento['usuariom']);
                                    echo isset($usuariom['usuario']) ? $usuariom['usuario'] : "N/D"; ?></td>
                                <td class="text-center">
                                    <form action="?page=sql_dep" method="post">
                                        <input type="hidden" name="idDep" value="<?php echo $departamento['id'] ?>" />
                                        <?php if ($departamento['estado'] == 1) { ?>
                                            <button type="submit" class="btn btn-sm btn-icon btn-success" name="desactivar" id="estadoDep">
                                                <span class="tf-icons bx bx-check"></span>
                                            </button>
                                        <?php } else { ?>
                                            <button type="submit" class="btn btn-sm btn-icon btn-danger" name="activar" id="estadoDep">
                                                <span class="tf-icons bx bx-x"></span>
                                            </button>
                                        <?php } ?>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <button type="submit" class="btn btn-sm btn-icon btn-warning" name="editarNombreDep" data-bs-toggle="modal" data-bs-target="#basicModal<?php echo $departamento['id']; ?>">
                                        <span class="tf-icons bx bxs-edit-alt"></span>
                                    </button>
                                    <!-- Modal -->
                                </td>
                                <?php include('modal_editarDep.php'); ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Striped Rows -->