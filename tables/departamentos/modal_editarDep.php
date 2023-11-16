<!----MODAL DE EDITAR NOMBRE DEPARTAMENTO------>
<div class="modal fade" id="basicModal<?php echo $departamento['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Editar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="?page=sql_dep" method="post">
                    <input type="hidden" name="editDep" value="<?php echo $departamento['id']; ?>" />
                    <div class="row">

                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label text-left">Nombre Departamento</label>
                            <input type="text" name="nombreDep" class="form-control" placeholder="Enter Name" value="<?php echo $departamento['departamento']; ?>" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary" name="editarNombreDep">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>