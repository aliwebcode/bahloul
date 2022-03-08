<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <!-- Login Form -->
                <div class="login-form default-form mt-5 px-2">
                    <div class="form-inner">
                        <h3>تسجيل الدخول إلى بهلول</h3>

                        <!--Login Form-->
                        <form method="post" action="">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <label>البريد الإلكتروني</label>
                                <input type="email" v-model="email" placeholder="بريدك الإلكتروني" required>
                            </div>

                            <div class="form-group">
                                <label>كلمة المرور</label>
                                <input id="password-field" type="password" v-model="password" placeholder="كلمة المرور" required>
                            </div>

                            <div class="form-group">
                                <div class="field-outer">
                                    <a href="#" class="pwd">نسيت كلمة المرور؟</a>
                                </div>
                            </div>

                            <div class="form-group" v-if="errors.empty">
                                <div class="alert alert-danger">الرجاء تعبئة كل الحقول</div>
                            </div>

                            <div class="form-group" v-if="errors.wrongData">
                                <div class="alert alert-danger">البريد الإلكتروني أو كلمة المرور غير صحيحة.</div>
                            </div>

                            <div class="form-group">
                                <button class="theme-btn btn-style-one"
                                        :class="{'bg-gray':btnLoading}"
                                        type="button"
                                        id="login-btn"
                                        @click="login">
                                    <span v-if="!btnLoading">دخول</span>
                                    <span v-if="btnLoading">الرجاء الانتظار...</span>
                                </button>
                            </div>
                        </form>

                        <div class="bottom-box">
                            <div class="text">ليس لديك حساب؟ <a href="/ar/register">تسجيل</a></div>
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
        document.title = "بهلول - تسجيل الدخول"
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
                    window.location.href = "/ar/dashboard"
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