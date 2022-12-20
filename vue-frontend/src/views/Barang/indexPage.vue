<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">BARANG</h1>
  </div>
  <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <br>
  <!-- <div v-for="(barang, id) in barangs" :key="id">
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">{{ barang.nama_barang }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ barang.nama_kategori }}</h6>
        <div class="card-text">Harga: {{ barang.harga_barang }} <br>
          Stok Tersedia: {{ barang.jumlah_barang }} </div>
        <button class="btn btn-info">BELI</button>
      </div>
    </div>
      <br>
  </div> -->
  
<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col" v-for="(barang, id) in barangs" :key="id" >
    <div class="card" style="border-radius: 20px">
      <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPdpPNNOAg-xkbFLQjlleS9i2oS5m3sFvyjg&usqp=CAU" class="card-img-top" > -->
      <div class="card-body">
        <h5 class="card-title">{{ barang.nama_barang }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ barang.nama_kategori }}</h6>
        <div class="card-text">Harga: {{ barang.harga_barang }} <br>
          Stok Tersedia: {{ barang.jumlah_barang }} </div>
        <router-link :to="{ name: 'transaksi.index', params: { id: barang.id } }" class="btn btn-sm btn-primary mr-1">
            BELI
        </router-link>
        
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
    let barangs = ref([]);
    const token = localStorage.getItem("token");
    //mounted
    onMounted(() => {
      //get API from Laravel Backend
      axios.defaults.headers.common.Authorization = `Bearer ${token}`
      axios
        .get("http://127.0.0.1:8000/api/barang")
        .then((response) => {
          //assign state posts with response data
          barangs.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

      function hapus(id){
        axios
        .delete(`http://localhost:8000/api/barang/${id}`)
        .then((response) => {
          //assign state posts with response data
          barangs.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
      }

    //return
    return {
      barangs,
      hapus,
    };
  },
};
</script>

<style>
  
</style>