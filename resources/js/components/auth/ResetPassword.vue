<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Password</div>

                    <div class="card-body">
                        <div v-if="message" class="alert alert-success" role="alert">
                            {{ message }}
                        </div>
                        <form @submit.prevent="resetPassword">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" :class="db_errors && db_errors['email'] ? 'is-invalid' : ''" name="email" v-model="resetDetails.email" required autocomplete="email" autofocus>
                                    <span v-if="db_errors && db_errors['email']" class="invalid-feedback" role="alert">
                                        <strong>{{ db_errors['email'][0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" :class="db_errors && db_errors['password'] ? 'is-invalid' : ''" name="password" v-model="resetDetails.password" required autocomplete="new-password">
                                    <span v-if="db_errors && db_errors['password']" class="invalid-feedback" role="alert">
                                        <strong>{{ db_errors['password'][0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="resetDetails.password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["updatePasswordRoute","token","email","dashboardRoute"],
    data(){
        return {
            resetDetails: {
                token: this.token,
                email: this.email,
                password: '',
                password_confirmation: ''
            },
            db_errors: null,
            message: "",
        }
    },
    methods: {
        resetPassword(){
            this.db_errors = null;
            this.message = "";
            axios.post(this.updatePasswordRoute, this.resetDetails)
            .then(response => {
                if(response.data.message){
                    this.message = response.data.message;
                }
                this.resetDetails = {
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: ''
                }
                location.href = this.dashboardRoute;
            })
            .catch(error => {
                this.db_errors = error.data.errors;
            })
        }
    }
}
</script>