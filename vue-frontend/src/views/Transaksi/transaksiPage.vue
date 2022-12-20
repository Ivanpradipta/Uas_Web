<template>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-12">
          <div class="card border-0 rounded shadow">
            <div class="card-body">
              <h4>TRANSAKSI</h4>
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
                  <label class="form-label">Nama Penerima</label>
                  <input type="text" class="form-control" v-model="transaksi.nama_penerima" placeholder="Masukkan Nama Penerima" />
                  <!-- validation -->
                  <div v-if="validation.nama_penerima" class="mt-2 alert alert-danger">
                    {{ validation.nama_penerima[0] }}
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label for="content" class="form-label">Nomor Telepon</label>
                  <input type="text" class="form-control" v-model="transaksi.nomor_telepon" placeholder="Masukkan Nomor Telepon Anda" />
                  <!-- validation -->
                  <div v-if="validation.nomor_telepon" class="mt-2 alert alert-danger">
                    {{ validation.nomor_telepon[0] }}
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label for="content" class="form-label">Kota, Kecamatan</label>
                  <input class="form-control" type="text" v-model="transaksi.kota_kecamatan" placeholder="Masukkan Kota & Kecamatan Anda" />
                  <!-- validation -->
                  <div v-if="validation.kota_kecamatan" class="mt-2 alert alert-danger">
                    {{ validation.kota_kecamatan[0] }}
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label for="content" class="form-label">Alamat</label>
                  <input class="form-control" type="text" v-model="transaksi.alamat" placeholder="Masukkan Alamat Anda" />
                  <!-- validation -->
                  <div v-if="validation.alamat" class="mt-2 alert alert-danger">
                    {{ validation.alamat[0] }}
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label for="content" class="form-label">Catatan</label>
                  <input class="form-control" type="text" v-model="transaksi.catatan" placeholder="Masukkan Catatan Anda" />
                  <!-- validation -->
                  <div v-if="validation.catatan" class="mt-2 alert alert-danger">
                    {{ validation.catatan[0] }}
                  </div>
                </div>

                <router-link :to="{ name: 'list.index', params: { id: transaksi.id } }" class="btn btn-sm btn-primary mr-1">
                    SIMPAN
                </router-link>
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
      const transaksi = reactive({
        //gambar:"",
        nama_penerima: "",
        nomor_telepon: "",
        kota_kecamatan: "",
        alamat: "",
        catatan: "",
      });
      //state validation
      const validation = ref([]);
      //vue router
      const router = useRouter();
      const token = localStorage.getItem("token");
      axios.defaults.headers.common.Authorization = `Bearer ${token}`
      //method store
      function store() {
        //let gambar = barang.gambar;
        let nama_penerima = transaksi.nama_penerima;
        let nomor_telepon = transaksi.nomor_telepon;
        let kota_kecamatan = transaksi.kota_kecamatan;
        let alamat = transaksi.alamat;
        let catatan = transaksi.catatan;
        axios
          .post("http://websiteecommerce.site/api/transaksi", {
            //gambar: gambar,
            nama_penerima: nama_penerima,
            nomor_telepon: nomor_telepon,
            kota_kecamatan: kota_kecamatan,
            alamat: alamat,
            catatan: catatan
          })
          .then(() => {
            
            //redirect ke post index
            router.push({
              name: "transaksi.index",
            });
          })
          .catch((error) => {
            //assign state validation with error
            validation.value = error.response.data;
          });
      }
      //return
      return {
        validation,
        router,
        transaksi,
        store,
      };
    },
  };
  </script>
  
  <style>
  
  </style>