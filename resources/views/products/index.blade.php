@extends('layout.app')

@section('content')
  <div id="app">
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4">CRUD de Productos con Vue</h2>
        </div>
        <div class="col-md-6 text-end">
          <button class="btn btn-sm btn-primary" @click="addProductModal">
            <i class="fas fa-plus"></i> Agregar Producto
          </button>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-12">
          <h3>Lista de Productos</h3>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="product in products" :key="product.id">
                <td>@{{ product.name }}</td>
                <td>@{{ product.price }}</td>
                <td>
                  <button class="btn btn-success btn-sm me-2" @click="viewProductModal(product)">
                    <i class="fas fa-eye"></i> Ver
                  </button>
                  <button class="btn btn-primary btn-sm me-2" @click="editProductModal(product)">
                    <i class="fas fa-edit"></i> Editar
                  </button>
                  <button class="btn btn-danger btn-sm" @click="deleteProductModal(product)">
                    <i class="fas fa-trash"></i> Eliminar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    @include('products.modals.mdlAddProduct')
    @include('products.modals.mdlViewProduct')
    @include('products.modals.mdlDeleteProduct')
    @include('products.modals.mdlEditProduct')
  </div>
@endsection

@section('scripts')
  <script>
    const app = Vue.createApp({
      data() {
        return {
          products: [],
          product: {
            id: '',
            name: '',
            description: '',
            price: '',
            stock: '',
            image: null,
          },
          selectedProduct: {},
          viewingProduct: {},
          deletingProduct: {},
          errors: {},
        };
      },
      methods: {
        async fetchProducts() {
          try {
            const response = await axios.get('/products');
            this.products = response.data;
          } catch (error) {
            console.error(error);
          }
        },
        cleanProduct() {
          this.product = {
            name: '',
            description: '',
            price: '',
            stock: '',
            // image: null,
          };
          this.errors = {};
        },
        addProductModal() {
          this.cleanProduct();
          $('#addProductModal').modal('show');
        },
        handleImageUpload(event) {
          this.product.image = event.target.files[0];
        },
        async addProduct() {
          try {
            const response = await axios.post('/product', this.product, {
              params: {
                // param1: 'value1',
              }
            });
            const newProduct = response.data;
            this.products.push(newProduct);

            $('#addProductModal').modal('hide');
            Swal.fire('Éxito', '¡Producto agregado exitosamente!',
              'success');

            this.cleanProduct();
          } catch (error) {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.errors;
            } else {
              console.error(error);
            }
          }
        },
        async addProductImage() {
          try {
            const formData = new FormData();
            formData.append('name', this.product.name);
            formData.append('description', this.product.description);
            formData.append('price', this.product.price);
            formData.append('stock', this.product.stock);
            formData.append('image', this.product.image);

            const response = await axios.post('/product', formData, {
              headers: {
                'Content-Type': 'multipart/form-data',
              },
            });

            this.products.push(response.data);
            this.cleanProduct();

            $('#addProductModal').modal('hide');
            Swal.fire('Éxito', '¡Producto agregado exitosamente!', 'success');
          } catch (error) {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.errors;
            } else {
              console.error(error);
            }
          }
        },

        viewProductModal(product) {
          this.viewingProduct = product;
          $('#viewProductModal').modal('show');
        },
        getImageUrl(imageName) {
          return `/storage/app/${imageName}`;
        },

        editProductModal(product) {
          this.selectedProduct = {
            ...product
          };
          $('#editProductModal').modal('show');
        },
        async updateProduct() {
          try {
            const response = await axios.put(`/product/${this.selectedProduct.id}`, this.selectedProduct);
            const updatedProduct = response.data;
            const index = this.products.findIndex(p => p.id === updatedProduct.id);
            if (index !== -1) {
              this.products[index] = updatedProduct;
            }
            $('#editProductModal').modal('hide');
          } catch (error) {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.errors;
            } else {
              console.error(error);
            }
          }
        },
        async updateProductImage() {
          try {
            const formData = new FormData();
            formData.append('name', this.selectedProduct.name);
            formData.append('description', this.selectedProduct.description);
            formData.append('price', this.selectedProduct.price);
            formData.append('stock', this.selectedProduct.stock);
            formData.append('image', this.selectedProduct.image);

            const response = await axios.put(`/product/${this.selectedProduct.id}`, formData, {
              headers: {
                'Content-Type': 'multipart/form-data',
              },
            });

            const updatedProduct = response.data;
            const index = this.products.findIndex(p => p.id === updatedProduct.id);
            if (index !== -1) {
              this.products[index] = updatedProduct;
            }
            $('#editProductModal').modal('hide');
          } catch (error) {
            if (error.response && error.response.status === 422) {
              this.errors = error.response.data.errors;
            } else {
              console.error(error);
            }
          }
        },

        deleteProductModal(product) {
          this.deletingProduct = product;
          // $('#deleteProductModal').modal('show');
          Swal.fire({
            title: 'Esta seguro?',
            text: 'El producto sera eliminado permanentemente!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'No, Cancelar',
          }).then((result) => {
            if (result.isConfirmed) {
              this.confirmDeleteProduct();
            } else {
              this.deletingProduct = {};
            }
          });
        },
        async confirmDeleteProduct() {
          try {
            await axios.delete(`/product/${this.deletingProduct.id}`);
            this.products = this.products.filter(prod => prod !== this.deletingProduct);
            this.deletingProduct = null;
            // $('#deleteProductModal').modal('hide');
            Swal.fire('Eliminado!', 'El producto ha sido eliminado.', 'success');
          } catch (error) {
            console.error(error);
          }
        },
      },
      created() {
        this.fetchProducts();
      },
    });

    app.mount('#app');
  </script>
@endsection
