<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <!-- Register Form -->
                <div class="login-form default-form mt-5 px-2">
                    <div class="form-inner">
                        <h3>Registrieren</h3>
                        <!--Register Form-->
                        <form method="post" action="">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <div class="btn-box row user_type_options">
                                    <div class="col-lg-4 col-md-12">
                                        <a href="javascript:void(0)"
                                           class="theme-btn btn-style-four"
                                           :class="{active:user.type == 1}"
                                           @click="changeType(1)">
                                            <i class="la la-user"></i> Arbeitgeber
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <a href="javascript:void(0)"
                                           class="theme-btn btn-style-four"
                                           :class="{active:user.type == 2}"
                                           @click="changeType(2)">
                                            <i class="la la-briefcase"></i> Angestellter
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <a href="javascript:void(0)"
                                           class="theme-btn btn-style-four"
                                           :class="{active:user.type == 3}"
                                           @click="changeType(3)">
                                            <i class="la la-user-tie"></i> Geschäft
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Vollständiger Name</label>
                                <input type="text" v-model="user.name" placeholder="Vollständiger Name">
                            </div>

                            <div class="form-group">
                                <label>Benutzername</label>
                                <input type="text" v-model="user.username"
                                       @keyup="checkUsername"
                                       placeholder="Benutzername">
                                <small style="color: rgb(8, 117, 37);font-size: 14px;"
                                       v-if="user.username != '' && errors.usernameExists == false">
                                    <i class="fa fa-check"></i> {{ user.username }} Looks good
                                </small>
                                <small style="color: rgb(149, 37, 37);font-size: 14px;"
                                       v-if="user.username != '' && errors.usernameExists == true">
                                    <i class="fa fa-exclamation-triangle"></i> {{ user.username }} exists
                                </small>
                            </div>

                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="email" v-model="user.email" placeholder="E-Mail">
                            </div>

                            <div class="form-group">
                                <label>Passwort</label>
                                <input id="password-field" type="password" v-model="user.password" placeholder="Passwort">
                            </div>

                            <div class="form-group">
                                <label>Passwort bestätigen</label>
                                <input id="password-confirm" type="password" class="form-control" v-model="user.confirmPassword" placeholder="Passwort bestätigen">
                            </div>

                            <div class="form-group" v-if="errors.empty">
                                <div class="alert alert-danger">Bitte alle Felder ausfüllen und Kontotyp wählen.</div>
                            </div>

                            <div class="form-group" v-if="errors.passwordsDontMatch">
                                <div class="alert alert-danger">Password don't match.</div>
                            </div>

                            <div class="form-group" v-if="errors.usernameExists">
                                <div class="alert alert-danger">Username exists already.</div>
                            </div>

                            <div class="form-group" v-if="errors.emailExists">
                                <div class="alert alert-danger">Email exists already.</div>
                            </div>

                            <div class="form-group">
                                <button class="theme-btn btn-style-one"
                                        :class="{'bg-gray':btnLoading}"
                                        type="button"
                                        id="register-btn"
                                        @click="register">
                                    <span v-if="!btnLoading">
                                        Register
                                    </span>
                                    <span v-if="btnLoading">Please Wait...</span>
                                </button>
                            </div>

                        </form>

                        <div class="bottom-box">
                            <div class="text">Haben Sie ein Konto? <a href="/login">Anmelden</a></div>
                        </div>

                    </div>
                </div>
                <!--End Register Form -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        document.getElementsByClassName('dashboard')[0].classList.remove('dashboard')
        document.title = "Bahloul - Register"
    },
    data: function () {
        return {
            user: {
                email: "",
                password: "",
                confirmPassword: "",
                type: "",
                username: ""
            },
            errors: {
                empty: false,
                usernameExists: false,
                passwordsDontMatch: false,
                emailExists: false
            },
            btnLoading: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        changeType: function (v) {
            this.user.type = v
        },
        checkUsername: function () {
            if(this.user.username != '') {
                axios.get("/request/auth/check-username/" + this.user.username)
                    .then((res) => {
                        console.log(res.data)
                        if(res.data == 1)
                            this.errors.usernameExists = true
                        else
                            this.errors.usernameExists =false
                    })
            }
        },
        register: function () {
            let btn = document.getElementById('register-btn')
            btn.setAttribute('disabled','')
            this.btnLoading = true
            if(this.user.type == '' || this.user.email == '' ||
                this.user.password == '' || this.user.username == '' || this.user.name == '') {
                this.errors.empty = true
                this.btnLoading = false
                btn.removeAttribute('disabled')
                return
            } else
                this.errors.empty = false
            if(this.user.password != this.user.confirmPassword) {
                this.errors.passwordsDontMatch = true
                this.btnLoading = false
                btn.removeAttribute('disabled')
                return
            } else
                this.errors.passwordsDontMatch = false
            if(this.errors.usernameExists == true) {
                this.btnLoading = false
                btn.removeAttribute('disabled')
                return
            }
            axios.post("/request/auth/register", {
                data: this.user
            })
            .then((res) => {
                this.btnLoading = false
                btn.removeAttribute('disabled')
                if(res.data == 1) {
                    window.location.href = "/dashboard"
                } else if(res.data == 0) {
                    this.errors.emailExists = true
                }
            })
        }
    }
}
</script>

<style scoped>
a.active {
    position: relative;
    text-align: center;
    white-space: nowrap;
    color: #ffffff;
    background-color: #34A853;
    line-height: 20px;
    border-radius: 8px;
    font-weight: 400;
    padding: 15px 35px;
}
.bg-gray {
    background: gray;
}
</style>