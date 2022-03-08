<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>نشر وظيفة جديدة</h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>نشر وظيفة</h4>
                                <div class="chosen-outer">
                                    <router-link to="/ar/profile/jobs" class="btn btn-primary">
                                        عودة للوظائف
                                        <i class="fa fa-angle-left"></i>
                                    </router-link>
                                </div>
                            </div>

                            <div class="widget-content">

                                <form class="default-form">
                                    <div class="row">
                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>عنوان الوظيفة</label>
                                            <input type="text" v-model="job.title">
                                        </div>

                                        <!-- About Company -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>وصف الوظيفة</label>
                                            <textarea v-model="job.description"></textarea>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>تصنيف الوظيفة</label>
                                            <select class="chosen-select" v-model="job.category_id">
                                                <option v-for="category in categories" :value="category.id">
                                                    {{ category.name_ar }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>نوع الوظيفة</label>
                                            <select class="chosen-select" v-model="job.type">
                                                <option value="Freelance">عمل حر</option>
                                                <option value="Full Time">دوام كامل</option>
                                                <option value="Internship">تدريبي</option>
                                                <option value="Part Time">دوام جزئي</option>
                                                <option value="Temporary">مؤقتة</option>
                                            </select>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>عدد ساعات العمل باليوم</label>
                                            <input type="number" v-model="job.hours">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>الراتب بالدولار (اختياري)</label>
                                            <input type="text" v-model="job.salary">
                                        </div>


                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>المهارات المطلوبة</label>
                                            <v-select :options="skills"
                                                      v-model="job.skills"
                                                      multiple></v-select>
                                        </div>


                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>الجنس</label>
                                            <select class="chosen-select" v-model="job.gender">
                                                <option value="male">ذكر</option>
                                                <option value="female">أنثى</option>
                                                <option value="both">كلاهما</option>
                                            </select>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12" v-if="job.type != 'Freelance'">
                                            <label>البلد</label>
                                            <select class="chosen-select"
                                                    v-model="job.country_id"
                                                    @change="getCities">
                                                <option value="" selected></option>
                                                <option v-for="country in countries" :value="country.id">
                                                    {{ country.name }}
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12" v-if="job.country_id && job.type != 'Freelance'">
                                            <label>المدينة</label>
                                            <select class="chosen-select" v-model="job.city_id">
                                                <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
                                            </select>
                                        </div>


                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <!-- Input -->
                                            <span class="title">تاريخ انتهاء الصلاحية (اختياري)</span>
                                            <input type="date" v-model="job.expire_date">
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12 my-auto">
                                            <!-- Input -->
                                            <label class="switch">
                                                <input type="checkbox"
                                                       v-model="job.show_applicants_num">
                                                <span class="slider round mr-2"></span>
                                                <span class="title">عرض عدد المتقدمين للوظيفة</span>
                                            </label>
                                        </div>

                                        <!-- Input -->
                                        <div v-if="errors.empty" class="form-group col-lg-12 col-md-6 alert alert-danger">
                                            يرجى تعبئة كل الحقول.
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12 text-right mt-4">
                                            <button class="btn btn-success"
                                                    type="button"
                                                    @click="addJob">
                                                إضافة
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay" v-if="loading">
            <i class="fa fa-spin fa-spinner"></i>
        </div>
    </section>
</template>

<script>
export default {
    mounted() {
        document.title = "لوحة التحكم - إضافة وظيفة جديدة"
        // Get User
        axios.get('/request/profile/get-add-job')
            .then((res) => {
                if(res.data == 0) {
                    window.location.href = "/ar/dashboard"
                }
                this.user = res.data.user
                this.countries = res.data.countries
                this.cities = res.data.cities
                this.categories = res.data.categories
            })
            .catch((err) => {
                console.log(err)
            })
    },
    data: function () {
        return {
            user: "",
            countries: [],
            cities: [],
            categories: [],
            job: {
                title: "",
                description: "",
                country_id: "",
                city_id: "",
                category_id: "",
                type: "",
                hours: "",
                salary: "",
                skills: "",
                gender: "",
                expire_date: ""
            },
            skills: [
                'PHP',
                'Python',
                'CSS',
                'Java',
                'Algorithm',
                'Laravel',
                'React',
                'Vue',
                'Photoshop',
                'XD',
            ],
            loading: false,
            errors: {
                empty: false,
            }
        }
    },
    methods: {
        getCities: function () {
            axios.get("/request/profile/get-cities/" + this.job.country_id)
            .then((res) => {
                this.cities = res.data
            })
        },
        addJob: function () {
            this.loading = true
            if(this.job.title == '' || this.job.description == '' ||
                this.job.type == '' || this.job.category_id == '' || this.job.skills == '') {
                this.errors.empty = true
                this.loading = false
                return
            } else this.errors.empty = false

            if(this.job.skills) {
                this.job.skills = this.job.skills.join()
            }

            if(this.job.type == 'Freelance') {
                this.job.country_id = ""
                this.job.city_id = ""
            }
            axios.post("/request/profile/add-job", {
                job: this.job
            })
            .then((res) => {
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
                    title: 'تمت الإضافة بنجاح'
                })
                this.job.title = ""
                this.job.description = ""
                this.job.category_id = ""
                this.job.country_id = ""
                this.job.city_id = ""
                this.job.type = ""
                this.job.hours = ""
                this.job.salary = ""
                this.job.skills = ""
                this.job.gender = ""
                this.job.expire_date = ""
                this.loading = false
            })
            .catch((err) => {
                console.log(err)
            })
        }
    }
}
</script>

<style scoped>
input[type="date"] {
    position: relative;
    width: 100%;
    display: block;
    height: 60px;
    line-height: 30px;
    padding: 15px 20px;
    font-size: 15px;
    color: #696969;
    background: #F0F5F7;
    border: 1px solid #F0F5F7;
    box-sizing: border-box;
    border-radius: 8px;
    transition: all 300ms ease;
}
</style>
