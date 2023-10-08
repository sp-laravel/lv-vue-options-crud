<div id="editProductModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Producto</h5>
      </div>

      <div class="modal-body">
        <form @submit.prevent="updateProduct">
          <div class="form-group">
            <label for="edit-name">Nombre</label>
            <input type="text" class="form-control" id="edit-name" name="name" v-model="selectedProduct.name"
              required>
            <span v-if="errors.name" class="text-danger">@{{ errors.name[0] }}</span>
          </div>
          <div class="form-group">
            <label for="edit-description">Descripción</label>
            <input type="text" class="form-control" id="edit-description" name="description"
              v-model="selectedProduct.description">
            <span v-if="errors.description" class="text-danger">@{{ errors.description[0] }}</span>
          </div>
          <div class="form-group">
            <label for="edit-price">Precio</label>
            <input type="number" class="form-control" id="edit-price" name="price" v-model="selectedProduct.price"
              required>
            <span v-if="errors.price" class="text-danger">@{{ errors.price[0] }}</span>
          </div>
          <div class="form-group">
            <label for="edit-stock">Stock</label>
            <input type="number" class="form-control" id="edit-stock" name="stock" v-model="selectedProduct.stock"
              required>
            <span v-if="errors.stock" class="text-danger">@{{ errors.stock[0] }}</span>
          </div>
          {{-- <div class="form-group">
            <input type="file" class="form-control-file" id="edit-image" name="image" @change="handleImageUpload">
            <span v-if="errors.image" class="text-danger">@{{ errors.image[0] }}</span>
          </div> --}}
        </form>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" @click="updateProduct">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
