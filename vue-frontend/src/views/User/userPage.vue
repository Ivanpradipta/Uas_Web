<template>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">PROFILE</h1>
    </div>


        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-12 col-xl-4">

                <div class="card" style="border-radius: 15px;">
                <div class="card-body text-center">
                    <div class="mt-3 mb-4">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                        class="rounded-circle img-fluid" style="width: 100px;" />
                    </div>
                    <h4 class="mb-2">{{ users.name }}</h4>
                    <p class="text-muted mb-4">{{ users.email }}</p>
                    <router-link :to="{ name: 'user.edit' }" class="btn btn-primary btn-rounded btn-lg">Update Profile</router-link>
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
    let users = ref([]);
    const token = localStorage.getItem("token");
    //mounted
    onMounted(() => {
      //get API from Laravel Backend
      axios.defaults.headers.common.Authorization = `Bearer ${token}`
      axios
        .get("http://127.0.0.1:8000/api/user")
        .then((response) => {
          //assign state posts with response data
          users.value = response.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    //return
    return {
      users,
    };
  },
};
</script>

<style>
</style>