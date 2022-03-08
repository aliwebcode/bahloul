<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <!-- Login Form -->
                <div class="login-form default-form mt-5 px-2">
                    <div class="form-inner">
                        <h3>Login to Bahloul</h3>

                        <!--Login Form-->
                        <form method="post" action="">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" v-model="email" placeholder="Email" required>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input id="password-field" type="password" v-model="password"  placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <div class="field-outer">
                                    <a href="#" class="pwd">Forgot password?</a>
                                </div>
                            </div>

                            <div class="form-group" v-if="errors.empty">
                                <div class="alert alert-danger">Please fill all fields.</div>
                            </div>

                            <div class="form-group" v-if="errors.wrongData">
                                <div class="alert alert-danger">Wrong Email or Password.</div>
                            </div>

                            <div class="form-group">
                                <button class="theme-btn btn-style-one"
                                        :class="{'bg-gray':btnLoading}"
                                        type="button"
                                        id="login-btn"
                                        @click="login">
                                    <span v-if="!btnLoading">Log In</span>
                                    <span v-if="btnLoading">Please Wait...</span>
                                </button>
                            </div>
                        </form>

                        <div class="bottom-box">
                            <div class="text">Don't have an account? <a href="/en/register">Signup</a></div>
                        </div>
                    </div>
                </div>
                <!--End Login Form -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        document.getElementsByClassName('dashboard')[0].classList.remove('dashboard')
        document.title = "Bahloul - Login"
    },
    data: function () {
        return {
            email: "",
            password: "",
            errors: {
                empty: false,
                wrongData: false,
            },
            btnLoading: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        login: function () {
            let btn = document.getElementById('login-btn')
            btn.setAttribute('disabled','')
            this.btnLoading = true
            if(this.email == '' || this.password == '') {
                this.btnLoading = false
                btn.removeAttribute('disabled')
                this.errors.empty = true
                return
            } else
                this.errors.empty = false
            axios.post("/request/auth/login", {
                email: this.email,
                password: this.password,
                _token: this.csrf
            })
            .then((res) => {
                this.btnLoading = false
                btn.removeAttribute('disabled')
                if(res.data == 1) {
                    window.location.href = "/en/dashboard"
                } else if (res.data == 0) {
                    this.errors.wrongData = true
                }
            })
            .catch((err) => {
                console.log(err)
            })
        }
    }
}
</script>

<style scoped>
.bg-gray {
    background: gray;
}
</style>