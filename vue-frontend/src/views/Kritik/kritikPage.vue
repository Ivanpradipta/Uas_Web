<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <h4>KRITIK & SARAN</h4>
            <hr>
            <form @submit.prevent="store">
              <!-- <div class="form-group mb-3"> -->
                <!-- <label class="form-label">Gambar Barang</label> -->
                <!-- <input type="file" class="form-control" placeholder="Masukkan gambar barang" /> -->
                <!-- validation -->
                <!-- <div v-if="validation.gambar" class="mt-2 alert alert-danger"> -->
                  <!-- {{ validation.gambar[0] }} -->
                <!-- </div> -->
              <!-- </div> -->
              <div class="form-group mb-3">
                <label class="form-label">Kritik</label>
                <input type="text" class="form-control" v-model="kritik.kritik" placeholder="Masukkan Kritikan Anda" />
                <!-- validation -->
                <div v-if="validation.kritik" class="mt-2 alert alert-danger">
                  {{ validation.kritik[0] }}
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="content" class="form-label">Saran</label>
                <input type="text" class="form-control" v-model="kritik.saran" placeholder="Masukkan Saran Anda" />
                <!-- validation -->
                <div v-if="validation.saran" class="mt-2 alert alert-danger">
                  {{ validation.saran[0] }}
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="content" class="form-label">Nama</label>
                <input class="form-control" type="text" v-model="kritik.nama" placeholder="Masukkan Nama Anda" />
                <!-- validation -->
                <div v-if="validation.nama" class="mt-2 alert alert-danger">
                  {{ validation.nama[0] }}
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="content" class="form-label">Harga</label>
                <input class="form-control" type="text" v-model="kritik.email" placeholder="Masukkan Email Anda" />
                <!-- validation -->
                <div v-if="validation.email" class="mt-2 alert alert-danger">
                  {{ validation.email[0] }}
                </div>
              </div>
              <button type="submit" class="btn btn-primary">SIMPAN</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
export default {
  setup() {
    //state departemen
    const kritik = reactive({
      //gambar:"",
      kritik: "",
      saran: "",
      nama: "",
      email: "",
    });
    //state validation
    const validation = ref([]);
    //vue router
    const router = useRouter();
    //method store
    function store() {
      //let gambar = barang.gambar;
      let kritik = kritik.kritik;
      let saran = kritik.saran;
      let nama = kritik.nama;
      let email = kritik.email;
      axios
        .post("http://localhost:8000/api/barang", {
          //gambar: gambar,
          kritik: kritik,
          saran: saran,
          nama: nama,
          email: email
        })
        .then(() => {
          //redirect ke post index
          router.push({
            name: "barang.index",
          });
        })
        .catch((error) => {
          //assign state validation with error
          validation.value = error.response.data;
        });
    }
    //return
    return {
      kritik,
      validation,
      router,
      store,
    };
  },
};
</script>

<style>

</style>