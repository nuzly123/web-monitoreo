<?php
require_once("includes/load.php");
$listaContrato = find_all('contratos');

?>
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Configuración /</span> Contratos</h4>

        <?php echo display_mssg($msg) ?>
        <!-- Striped Rows -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11">
                        <h5 class="card-header">Contratos</h5>
                    </div>
                    <div class="col-md-1 mr-5 mt-4" align="center">
                        <button type="submit" class="btn btn-sm btn-icon btn-info" name="addButton" data-bs-toggle="modal" data-bs-target="#newBasicModal">
                            <span class="tf-icons bx bx-list-plus"></span>
                        </button>
                    </div>
                    <?php include('modal_nuevoContrato.php'); ?>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Creado por</th>
                                <th>Modificado por</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php foreach ($listaContrato as $contrato) : ?>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $contrato['tipo']; ?></strong></td>
                                    <td><?php echo $contrato['creado']; ?></td>
                                    <td><?php echo isset($contrato['modificado']) ? $contrato['modificado'] : "N/D"; ?></td>
                                    <td><?php $usuarioc = find_by_id('usuarios', $contrato['usuarioc']);
                                        echo $usuarioc['usuario'] ?></td>
                                    <td><?php $usuariom = find_by_id('usuarios', $contrato['usuariom']);
                                        echo isset($usuariom['usuario']) ? $usuariom['usuario'] : "N/D"; ?></td>
                                    <td class="text-center">
                                        <form action="?page=sql_contratos" method="post">
                                            <input type="hidden" name="idContrato" value="<?php echo $contrato['id'] ?>" />
                                            <?php if ($contrato['estado'] == 1) { ?>
                                                <button type="submit" class="btn btn-sm btn-icon btn-success" name="desactivar" id="estadoContrato">
                                                    <span class="tf-icons bx bx-check"></span>
                                                </button>
                                            <?php } else { ?>
                                                <button type="submit" class="btn btn-sm btn-icon btn-danger" name="activar" id="estadoContrato">
                                                    <span class="tf-icons bx bx-x"></span>
                                                </button>
                                            <?php } ?>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" class="btn btn-sm btn-icon btn-warning" name="editarContrato" data-bs-toggle="modal" data-bs-target="#basicModal<?php echo $contrato['id']; ?>">
                                            <span class="tf-icons bx bxs-edit-alt"></span>
                                        </button>
                                        <!-- Modal -->
                                    </td>
                                    <?php include('modal_editarContrato.php'); ?>
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