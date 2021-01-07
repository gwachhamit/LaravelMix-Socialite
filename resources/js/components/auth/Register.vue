<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form @submit.prevent="registerUser">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" :class="db_errors && db_errors['name'] ? 'is-invalid' : ''" name="name" v-model="registerData.name" required autocomplete="name" autofocus>
                                    <span v-if="db_errors && db_errors['name']" class="invalid-feedback" role="alert">
                                        <strong>{{ db_errors['name'][0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" :class="db_errors && db_errors['email'] ? 'is-invalid' : ''" name="email" v-model="registerData.email" required autocomplete="email">
                                    <span v-if="db_errors && db_errors['email']" class="invalid-feedback" role="alert">
                                        <strong>{{ db_errors['email'][0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" :class="db_errors && db_errors['password'] ? 'is-invalid' : ''" name="password" v-model="registerData.password" required autocomplete="new-password">
                                    <span v-if="db_errors && db_errors['password']" class="invalid-feedback" role="alert">
                                        <strong>{{ db_errors['password'][0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="registerData.password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
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
    props: ['registerRoute','dashboardRoute'],
    data(){
        return {
            registerData: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            db_errors: null
        }
    },
    methods: {
        registerUser(){
            this.db_errors = null;
            axios.post(this.registerRoute, this.registerData)
            .then(response => {
                location.href = this.dashboardRoute;
            })
            .catch(error => {
                this.db_errors = error.data.errors;
            })
        }
    }
}
</script>