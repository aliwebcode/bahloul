<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>My Account</h3>
            </div>

            <!-- Ls widget -->
            <div class="ls-widget">
                <div class="widget-title">
                    <h4>Change Email</h4>
                </div>
                <div class="widget-content">
                    <form class="default-form">
                        <div class="row">
                            <!-- Input -->
                            <div class="form-group col-lg-7 col-md-12">
                                <label>New Email address</label>
                                <input type="email" v-model="data.email">
                            </div>

                            <!-- Messages -->
                            <div class="form-group col-12 col-md-6 alert alert-danger"
                                 v-if="errors.emptyEmail">
                                Please Type Email address
                            </div>

                            <!-- Input -->
                            <div class="form-group col-md-12">
                                <button class="theme-btn btn-style-one" :class="{'bg-gray':btnLoadingEmail}"
                                        @click="updateEmail" type="button" id="saveEmailBtn">
                                    <span v-if="!btnLoadingEmail">Update</span>
                                    <i class="fas fa-spinner fa-pulse fa-lg" v-if="btnLoadingEmail"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ls widget -->
            <div class="ls-widget">
                <div class="widget-title">
                    <h4>Change Password</h4>
                </div>
                <div class="widget-content">
                    <form class="default-form">
                        <div class="row">
                            <!-- Input -->
                            <div class="form-group col-lg-7 col-md-12">
                                <label>Old Password </label>
                                <input type="password" v-model="data.oldPassword">
                            </div>

                            <!-- Input -->
                            <div class="form-group col-lg-7 col-md-12">
                                <label>New Password</label>
                                <input type="password" v-model="data.newPassword">
                            </div>

                            <!-- Input -->
                            <div class="form-group col-lg-7 col-md-12">
                                <label>Confirm Password</label>
                                <input type="password" v-model="data.confirmPassword">
                            </div>

                            <!-- Messages -->
                            <div class="form-group col-12 col-md-6 alert alert-danger"
                                 v-if="errors.empty">
                                Please fill all fields.
                            </div>
                            <div class="form-group col-12 col-md-6 alert alert-danger"
                                 v-if="errors.dontMatch">
                                Passwords do not match
                            </div>
                            <div class="form-group col-12 col-md-6 alert alert-danger"
                                 v-if="errors.wrongPassword">
                                Old Password incorrect
                            </div>

                            <!-- Input -->
                            <div class="form-group col-md-12">
                                <button class="theme-btn btn-style-one" :class="{'bg-gray':btnLoading}"
                                        @click="updatePassword" type="button" id="saveBtn">
                                    <span v-if="!btnLoading">Update</span>
                                    <i class="fas fa-spinner fa-pulse fa-lg" v-if="btnLoading"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</template>

<script>
export default {
    data: function () {
        return {
            btnLoading: false,
            btnLoadingEmail: false,
            data: {
                oldPassword: "",
                newPassword: "",
                confirmPassword: "",
                email: "",
            },
            errors: {
                empty: false,
                dontMatch: false,
                wrongPassword: false,
                emptyEmail: false,
            }
        }
    },
    methods: {
        updateEmail: function () {
            this.errors.emptyEmail = false
            if(this.data.email == '') {
                this.errors.emptyEmail = true
                return
            }
            let btn = document.getElementById('saveEmailBtn')
            btn.setAttribute('disabled','')
            this.btnLoadingEmail = true
            // Send Request
            axios.post("/request/profile/change-email", {
                email: this.data.email
            })
                .then((res) => {
                    // console.log(res.data)
                    this.btnLoadingEmail = false
                    btn.removeAttribute('disabled')
                    if(res.data == 1) {
                        this.data.email = ""
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: 'Saved successfully'
                        })
                    }
                })
        },
        updatePassword: function () {
            this.errors.empty = false
            this.errors.dontMatch = false
            this.errors.wrongPassword = false
            if(this.data.oldPassword == '' || this.data.newPassword == '' || this.data.confirmPassword == '')
            {
                this.errors.empty = true
                return
            }
            else
            {
                this.errors.empty = false
            }
            if(this.data.newPassword != this.data.confirmPassword) {
                this.errors.dontMatch = true
                return
            }
            else
            {
                this.errors.dontMatch = false
            }
            let btn = document.getElementById('saveBtn')
            btn.setAttribute('disabled','')
            this.btnLoading = true
            // Send Request
            axios.post("/request/profile/change-password", {
                oldPassword: this.data.oldPassword,
                newPassword: this.data.newPassword
            })
            .then((res) => {
                // console.log(res.data)
                this.btnLoading = false
                btn.removeAttribute('disabled')
                if(res.data === 0) {
                    this.errors.wrongPassword = true
                } else {
                    this.errors.wrongPassword = false
                    this.data.oldPassword = ""
                    this.data.newPassword = ""
                    this.data.confirmPassword = ""
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Saved successfully'
                    })
                }
            })
        }
    }
}
</script>

<style scoped>
.bg-gray {
    background-color: gray;
}
</style>
