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
                        <form @submit.prevent="sendResetLink">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" :class="db_errors && db_errors['email'] ? 'is-invalid' : ''" name="email" v-model="email" required autocomplete="email" autofocus>
                                    <span v-if="db_errors && db_errors['email']" class="invalid-feedback" role="alert">
                                        <strong>{{ db_errors['email'][0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Send Password Reset Link
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
    props: ['sendResetLinkRoute'],
    data(){
        return {
            email: "",
            db_errors: null,
            message: "",
        }
    },
    methods: {
        sendResetLink(){
            this.db_errors = null;
            axios.post(this.sendResetLinkRoute, {email: this.email})
            .then(response => {
                if(response.data.message){
                    this.message = response.data.message;
                }
                this.email = "";
            })
            .catch(error => {
                this.db_errors = error.data.errors;
            })
        }
    }
}
</script>