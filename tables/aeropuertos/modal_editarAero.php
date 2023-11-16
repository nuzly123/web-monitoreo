<!----MODAL DE EDITAR NOMBRE AEROPUERTO------>
<div class="modal fade" id="basicModal<?php echo $aeropuerto['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Editar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="?page=sql_aeropuertos" method="post">
                    <input type="hidden" name="editAero" value="<?php echo $aeropuerto['id']; ?>" />
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="nameBasic" class="form-label text-left">Nombre Aeropuerto</label>
                            <input type="text" name="nombreAero" class="form-control" placeholder="Aeropuerto" value="<?php echo $aeropuerto['aeropuerto']; ?>" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nameBasic" class="form-label text-left">Código</label>
                            <input type="text" name="codigoAero" class="form-control" placeholder="Codigo" value="<?php echo $aeropuerto['codigo']; ?>" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label text-left">Latitud</label>
                            <input type="text" name="latitud" class="form-control" placeholder="Latitud" value="<?php echo $aeropuerto['latitud']; ?>" />
                        </div>
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label text-left">Longitud</label>
                            <input type="text" name="longitud" class="form-control" placeholder="Longitud" value="<?php echo $aeropuerto['longitud']; ?>" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary" name="editarNombreAero">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>