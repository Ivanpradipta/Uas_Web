<template>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">EDIT PROFILE</h1>
    </div>
    <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <form @submit.prevent="update">
              <div class="form-group mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" v-model="user.name" placeholder="Masukkan Nama Anda" />
                <!-- validation -->
                <div v-if="validation.name" class="mt-2 alert alert-danger">
                  {{ validation.name[0] }}
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="content" class="form-label">Email</label>
                <input class="form-control" type="text" v-model="user.email" placeholder="Masukkan Email Anda" />
                <!-- validation -->
                <div v-if="validation.email" class="mt-2 alert alert-danger">
                  {{ validation.email[0] }}
                </div>
              </div>
              <div class="form-group mb-3">
                <label for="content" class="form-label">Password</label>
                <input class="form-control" type="password" v-model="user.password" placeholder="Masukkan Passwordd Anda" />
                <!-- validation -->
                <div v-if="validation.password" class="mt-2 alert alert-danger">
                  {{ validation.password[0] }}
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
import { onMounted, reactive, ref } from "vue";
import { useRouter} from 'vue-router';
import axios from "axios";
export default {
  setup() {
    //state departemen
    const user = reactive({
      //gambar:"",
      name: "",
      email: "",
      password: "",
    });
    //state validation
    const validation = ref([]);
    //vue router
    const router = useRouter();

    const token = localStorage.getItem("token");
    const id = localStorage.getItem("id");
    
    onMounted(() => {
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
      axios.get("http://127.0.0.1:8000/api/user/"+ id)
        .then(response => {
          user.name = response.data.data.name
          user.email = response.data.data.email
          user.password = response.data.data.password
        }).catch(error => {
            console.log(error.response.data)
        })
    })

    function update(){
      let name = user.name
      let email = user.email
      let password = user.password

      axios.put("http://127.0.0.1:8000/api/user/"+ id, {
        name: name,
        email: email,
        password: password
      }).then(() => {
        router.push({
          name: 'user'
        })
      }).catch(error => {
        validation.value = error.response.data
      })
    }

    //return
    return {
      user,
      validation,
      router,
      update,
    };
  },
};
</script>

<style>

</style>