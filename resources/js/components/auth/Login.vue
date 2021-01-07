<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form @submit.prevent="submitlogin">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" :class="db_errors && db_errors['email'] ? 'is-invalid' : ''" name="email" v-model="loginData.email" required autocomplete="email" autofocus>
                                    <span v-if="db_errors && db_errors['email']" class="invalid-feedback" role="alert">
                                        <strong>{{ db_errors['email'][0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" :class="db_errors && db_errors['password'] ? 'is-invalid' : ''" name="password" v-model="loginData.password" required autocomplete="current-password">
                                    <span v-if="db_errors && db_errors['password']" class="invalid-feedback" role="alert">
                                        <strong>{{ db_errors['password'][0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" v-model="loginData.remember_me">
                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    <a class="btn btn-link" :href="forgotPasswordRoute">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>

                            <template v-if="facebookAppId || googleAppId">
                            <p style="text-align: center">OR</p>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <a v-if="googleAppId" href="/oauth/google" class="btn btn-danger btn-block">Login with Google</a>
                                    <a v-if="facebookAppId" href="/oauth/facebook" class="btn btn-primary btn-block">Login with Facebook</a>
                                    <!-- <button type="button" @click="socialLogin('google')" class="btn btn-danger btn-block">Login with Google</button>
                                    <button type="button" @click="socialLogin('facebook')" class="btn btn-primary btn-block">Login with Facebook</button> -->
                                </div>
                            </div>
                            </template>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['loginRoute','forgotPasswordRoute','dashboardRoute','facebookAppId','googleAppId'],
    data(){
        return {
            loginData: {
                email: '',
                password: '',
                remember_me: false
            },
            db_errors: null
        }
    },
    methods: {
        submitlogin(){
            this.db_errors = null;
            axios.post(this.loginRoute, this.loginData)
            .then(response => {
                location.href = this.dashboardRoute;
            })
            .catch(error => {
                console.log(error);
                this.db_errors = error.data.errors;
            })
        },
        socialLogin(provider){
            axios.post("/oauth/"+provider)
            .then(response => {
                location.href = response.data.url;
            });
        }
    }
}
</script>