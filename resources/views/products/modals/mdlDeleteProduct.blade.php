<div id="deleteProductModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar Eliminación</h5>
      </div>

      <div class="modal-body">
        <p>¿Estás seguro de que deseas eliminar este producto?</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" @click="confirmDeleteProduct">Eliminar</button>
      </div>
    </div>
  </div>
</div>
