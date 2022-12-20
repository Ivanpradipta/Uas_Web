<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">LIST TRANSAKSI</h1>
  </div>
  
  <!-- <div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col" v-for="(barang, id) in barangs" :key="id" >
      <div class="card" style="border-radius: 20px">
        <div class="card-body">
          <h5 class="card-title">{{ barang.nama_barang }}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{ barang.nama_kategori }}</h6>
          <div class="card-text">Harga: {{ barang.harga_barang }} <br></div>
        </div>
      </div>
    </div>
  </div> -->
  <br>

    <div class="card-body" v-for="(transaksi, id) in transaksis" :key="id">
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nama Penerima</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ transaksi.nama_penerima }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nomor Telepon</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ transaksi.nomor_telepon }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Kota, Kecamatan</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ transaksi.kota_kecamatan }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Alamat</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ transaksi.alamat }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Catatan</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ transaksi.catatan }}</p>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>
</template>
   
<script>
import axios from "axios";
import { onMounted, ref } from "vue";
export default {
  setup() {
    //reactive state
    // let barangs = ref([]);
    let transaksis = ref([]);
    const token = localStorage.getItem("token");
    //mounted
    onMounted(() => {
      //get API from Laravel Backend
      axios.defaults.headers.common.Authorization = `Bearer ${token}`
      axios
        .get("http://127.0.0.1:8000/api/transaksi")
        .then((response) => {
          //assign state posts with response data
          transaksis.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });

      
    });
    
     //return
    return {
      // barangs,
      transaksis,
    };
  },
};
</script>

<style>

</style>