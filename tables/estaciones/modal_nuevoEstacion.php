<!----MODAL DE EDITAR NOMBRE CIUDAD------>
<div class="modal fade" id="newBasicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Nuevo </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="?page=sql_estaciones" method="post">
                    <input type="hidden" name="newEstacion"/>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label text-left">Nombre Estacion</label>
                            <input type="text" name="nombreEstacion" class="form-control" placeholder="Enter Name"/>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary" name="nuevaEstacion">Añadir</button>
                </form>
            </div>
        </div>
    </div>
</div>