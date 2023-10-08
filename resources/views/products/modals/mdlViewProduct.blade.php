<div id="viewProductModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ver Producto</h5>
      </div>

      <div class="modal-body">
        <p><strong>Nombre:</strong> @{{ viewingProduct.name }}</p>
        <p><strong>Descripción:</strong> @{{ viewingProduct.description }}</p>
        <p><strong>Precio:</strong> @{{ viewingProduct.price }}</p>
        <p><strong>Stock:</strong> @{{ viewingProduct.stock }}</p>
        {{-- <img :src="getImageUrl(viewingProduct.image)" :alt="viewingProduct.name" class="img-fluid"> --}}
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
