<template>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">ADMIN</h1>
  </div>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <!-- <router-link :to="{ name: 'barang.create' }" class="btn btn-md btn-success">TAMBAH BARANG</router-link> -->
            <table class="table table-striped table-bordered mt-4">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">NAMA</th>
                  <th scope="col">EMAIL</th>
                  <th scope="col">KRITIK</th>
                  <th scope="col">SARAN</th>
                  <th scope="col">AKSI</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(kritik, id) in kritiks" :key="id">
                  <td>{{ kritik.nama }}</td>
                  <td>{{ kritik.email }}</td>
                  <td>{{ kritik.critic }}</td>
                  <td>{{ kritik.saran }}</td>
                  <td class="text-center">
                    <!-- <router-link :to="{ name: 'barang.edit', params: { id: barang.id } }" class="btn btn-sm btn-primary mr-1"> EDIT</router-link> -->
                    <!-- &nbsp;
                    <button class="btn btn-info">BELI</button> -->
                    &nbsp;
                    <button @click="hapus(kritik.id)" class="btn btn-sm btn-danger ml1">DELETE</button>
                  </td>
                </tr>
              </tbody>
            </table>
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
    let kritiks = ref([]);

    //mounted
    onMounted(() => {
      //get API from Laravel Backend
      
      axios
        .get("http://websiteecommerce.site/api/kritik")
        .then((response) => {
          //assign state posts with response data
          kritiks.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

      function hapus(id){
        axios
        .delete(`http://websiteecommerce.site/api/kritik/${id}`)
        .then((response) => {
          //assign state posts with response data
          kritiks.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
      }

    //return
    return {
      kritiks,
      hapus
    };
  },
};
</script>
<style></style>