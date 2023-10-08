<div id="addProductModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Nueva Sección</h5>
      </div>

      <div class="modal-body">
        <form @submit.prevent="addProduct">
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" v-model="product.name" required>
            <span v-if="errors.name" class="text-danger">@{{ errors.name[0] }}</span>
          </div>
          <div class="form-group">
            <label for="description">Descripción</label>
            <input type="text" class="form-control" id="description" v-model="product.description">
            <span v-if="errors.description" class="text-danger">@{{ errors.description[0] }}</span>
          </div>
          <div class="form-group">
            <label for="price">Precio</label>
            <input type="number" class="form-control" id="price" v-model="product.price" required>
            <span v-if="errors.price" class="text-danger">@{{ errors.price[0] }}</span>
          </div>
          <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" id="stock" v-model="product.stock" required>
            <span v-if="errors.stock" class="text-danger">@{{ errors.stock[0] }}</span>
          </div>
          {{-- <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" class="form-control" id="image" @change="handleImageUpload">
            <span v-if="errors.image" class="text-danger">@{{ errors.image[0] }}</span>
          </div> --}}
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" @click="addProduct">Agregar</button>
      </div>
    </div>
  </div>
</div>
