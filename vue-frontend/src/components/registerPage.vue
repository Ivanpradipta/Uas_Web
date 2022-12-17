<template>
  <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Register</h3>

            <form @submit.prevent="register">
                <div class="form-group mb-4">
                    <input type="text" v-model="user.name" class="form-control form-control-lg" />
                    <label class="form-label">Name</label>
                </div>
                <div v-if="validation.name" class="mt-2 alert alert-danger">
                    {{ validation.name[0] }}
                    </div>

                <div class="form-group mb-4">
                    <input type="email" v-model="user.email" class="form-control form-control-lg" />
                    <label class="form-label">Email</label>
                </div>
                <div v-if="validation.email" class="mt-2 alert alert-danger">
                    {{ validation.email[0] }}
                    </div>

                <div class="form-group mb-4">
                    <input type="password" v-model="user.password" class="form-control form-control-lg" />
                    <label class="form-label">Password</label>
                </div>
                <div v-if="validation.password" class="mt-2 alert alert-danger">
                    {{ validation.password[0] }}
                    </div>

                <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
            </form>
            <hr class="my-4">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</template>
<script>
    import { reactive, ref } from 'vue'
    import { useRouter } from 'vue-router'
    import axios from 'axios'

    export default {


        setup() {

            //inisialisasi vue router on Composition API
            const router = useRouter()

            //state user
            const user = reactive({
                name: '',
                email: '',
                password: ''
            })

            //state validation
            const validation = ref([])

            //method register
            function register() {

                //define variable 
                let name = user.name
                let email = user.email
                let password = user.password

                //send server with axios
                axios.post('http://127.0.0.1:8000/api/register', {
                        name,
                        email,
                        password,
                })
                .then(() => {

                    //redirect ke halaman login
                    return router.push({
                        name: 'login'
                    })

                }).catch(error => {
                    //set validation dari error response
                    validation.value = error.response.data
                })

            }

            return {
                user, // <-- state user
                validation, // <-- state validation 
                register // <-- method register
            }

        }

    }
</script>