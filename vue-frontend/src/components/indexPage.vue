<template>
  <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>

            <form @submit.prevent="login">
                <div class="form-group mb-4">
                    <input type="email" v-model="user.email" class="form-control form-control-lg">
                    <label class="form-label">Email</label>
                </div>
                <div v-if="validation.email" class="mt-2 alert alert-danger">
                        {{ validation.email[0] }}
                    </div>

                <div class="form-group mb-4">
                    <input type="password" v-model="user.password" class="form-control form-control-lg">
                    <label class="form-label">Password</label>
                </div>
                <div v-if="validation.password" class="mt-2 alert alert-danger">
                        {{ validation.password[0] }}
                    </div>
                <!-- <div class="alert alert-success" role="alert">
                Berhasil Login
                </div> -->
                <button class="btn btn-primary btn-lg btn-block" id="liveToastBtn" type="submit">Login</button>
            </form>
            <!-- <p><a href="/beranda">test</a></p> -->
            <br>
            <div class="text-center">
              <p>Belum Memiliki Akun? <a href="/register">Register</a></p>
            </div>
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
            const router = useRouter();

            //state user
            const user = reactive({
                email: '',
                password: '',
            });

            //state validation
            const validation = ref([]);

            //state loginFailed
            const loginFailed = ref(null);

            //method login
            function login() {

                //define variable 
                let email = user.email
                let password = user.password

                //send server with axios
                axios.post('http://127.0.0.1:8000/api/login', {
                        email,
                        password,
                })
                .then(response => {

                    if(response.data.success) {

                        //set token
                        localStorage.setItem('token', response.data.access_token);
                        localStorage.setItem('email', response.data.user.email);
                        localStorage.setItem('id', response.data.user.id);


                        //redirect ke halaman dashboard

                        if(response.data.user.id == 1){
                            router.push({
                                name: "admin",
                            });
                        }else if(response.data.user.id != 1){
                            router.push({
                                name: "beranda"
                            });
                        }

                        // this.$toast.success(
                        //     "Berhasil Login",
                        //     {
                        //     position:
                        //     "top-right"
                        //     })

                    }
                    //set state loggedIn to true
                    loginFailed.value = true


                }).catch(error => {
                    //set validation dari error response
                    validation.value = error.response.data
                })

            }

            return {
                user,           // <-- state user
                validation,     // <-- state validation 
                loginFailed,    // <-- state loggedIn
                login           // <-- method login
            };

        }

    }
</script>