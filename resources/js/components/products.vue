<template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">جدول محصولات</h3>
            <div class="card-tools">
              <button class="btn btn-success" @click="newModal">
                افزودن
                <i class="fas fa-gift fa-fw"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>شناسه</th>
                  <th>نام</th>
                  <th>قیمت</th>
                  <th>موجودی</th>
                  <th>عکس</th>
                  <th>زمان ایجاد</th>
                  <th>ویرایش</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products.data" :key="product.id">
                  <td>{{product.id}}</td>
                  <td>{{product.name}}</td>
                  <td>{{product.price}}</td>
                  <td>{{product.quantity}}</td>
                  <td>
                    <img :src="'/images/'+product.photo" alt style="width:50px" />
                  </td>
                  <td>{{product.created_at | beautifyDate }}</td>
                  <td>
                    <a href="#" @click="editModal(product)">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    <a href="#" @click="deleteProduct(product.id)">
                      <i class="fa fa-trash-alt red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <pagination :data="products" @pagination-change-page="getResults"></pagination>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div v-if="!$gate.isAdminOrAuthor()">
      <not-found></not-found>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="editMode" id="addNewLabel">ویرایش</h5>
            <h5 class="modal-title" v-show="!editMode" id="addNewLabel">افزودن</h5>

            <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form
            @submit.prevent="editMode ? updateProduct() : createProduct()"
            enctype="multipart/form-data"
          >
            <div class="modal-body">
              <div class="form-group">
                <input
                  placeholder="نام محصول"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <input
                  placeholder="قیمت"
                  v-model="form.price"
                  type="text"
                  name="price"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('price') }"
                />
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="form-group">
                <input
                  placeholder="موجودی"
                  v-model="form.quantity"
                  type="text"
                  name="quantity"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('quantity') }"
                />
                <has-error :form="form" field="quantity"></has-error>
              </div>

              <div class="form-group productPhoto">
                <label for="photo">عکس محصول</label>
                <input
                  name="photo"
                  id="photo"
                  @change="addProductPhoto"
                  type="file"
                  placeholder="عکس محصول"
                />
                <has-error :form="form" field="photo"></has-error>
              </div>
              <!-- <div class="form-group">
                                <input
                                    placeholder="password"
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('password') }"
                                />
                                <has-error :form="form" field="password"></has-error>
              </div>-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
              <button type="submit" v-show="editMode" class="btn btn-success">ویرایش</button>
              <button type="submit" v-show="!editMode" class="btn btn-primary">افزودن</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editMode: false,
      products: {},
      form: new Form({
        id: "",
        name: "",
        price: "",
        quantity: "",
        photo: ""
      })
    };
  },
  methods: {
    addProductPhoto(e) {
      const file = e.target.files[0];
      if (file["size"] < 2111775) {
        let reader = new FileReader();
        reader.onloadend = file => {
          this.form.photo = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        this.form.photo = "";
        Swal.fire({
          type: "error",
          title: "oops...",
          text: "image size should be less than 2mb"
        });
      }
    },
    // Our method to GET results from a Laravel endpoint
    getResults(page = 1) {
      axios.get("api/products?page=" + page).then(response => {
        this.users = response.data;
      });
    },
    updateProduct() {
      this.$Progress.start();
      this.form
        .put(`api/products/${this.form.id}`)
        .then(() => {
          $("#addNew").modal("hide");
          Swal.fire("Updated!", "info has been updated.", "success");
          this.$Progress.finish();
          Fire.$emit("afterProductCreated");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editModal(product) {
      this.editMode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(product);
    },
    newModal() {
      this.editMode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    deleteProduct(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        // send request to the server
        if (result.value) {
          this.form
            .delete(`api/products/${id}`)
            .then(() => {
              Swal.fire("Deleted!", "the product has been deleted.", "success");
              Fire.$emit("afterProductCreated");
            })
            .catch(error => {
              Swal.fire("Failed!", "the user has not been deleted.", "warning");
            });
        }
      });
    },
    loadProducts() {
      if (this.$gate.isAdminOrAuthor()) {
        axios.get("api/products").then(response => {
          this.products = response;
          console.log(response);
        });
      }
    },
    createProduct() {
      this.$Progress.start();
      this.form
        .post("api/products")
        .then(response => {
          Fire.$emit("afterProductCreated");
          $("#addNew").modal("hide");
          toast.fire({
            type: "success",
            title: "محصول اضافه شد"
          });
          this.$Progress.finish();
        })
        .catch(error => console.log(error));
    }
  },
  created() {
    Fire.$on("searching", () => {
      let query = this.$parent.search;
      axios
        .get("api/findProduct?q=" + query)
        .then(data => {
          console.log(data);
          this.users = data.data;
        })
        .catch(() => {});
    });
    this.loadProducts();
    Fire.$on("afterProductCreated", () => this.loadProducts());
  }
};
</script>
