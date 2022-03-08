<template>
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Post a New Job!</h3>
                <div class="text">Ready to jump back in?</div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Post Job</h4>
                                <div class="chosen-outer">
                                    <router-link to="/en/profile/jobs" class="btn btn-primary">
                                        Back To Jobs
                                        <i class="fa fa-angle-right"></i>
                                    </router-link>
                                </div>
                            </div>

                            <div class="widget-content">

                                <form class="default-form">
                                    <div class="row">
                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Job Title</label>
                                            <input type="text" v-model="job.title">
                                        </div>

                                        <!-- About Company -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Job Description</label>
                                            <textarea v-model="job.description"></textarea>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Job Category</label>
                                            <select class="chosen-select" v-model="job.category_id">
                                                <option v-for="category in categories" :value="category.id">
                                                    {{ category.name }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Job Type</label>
                                            <select class="chosen-select" v-model="job.type">
                                                <option value="Freelance">Freelance</option>
                                                <option value="Full Time">Full Time</option>
                                                <option value="Internship">Internship</option>
                                                <option value="Part Time">Part Time</option>
                                                <option value="Temporary">Temporary</option>
                                            </select>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Hours Per Day</label>
                                            <input type="number" v-model="job.hours">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Salary $ (optional)</label>
                                            <input type="text" v-model="job.salary">
                                        </div>


                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Skills</label>
                                            <v-select :options="skills"
                                                      v-model="job.skills"
                                                      multiple></v-select>
                                        </div>


                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Gender</label>
                                            <select class="chosen-select" v-model="job.gender">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="both">Both</option>
                                            </select>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12" v-if="job.type != 'Freelance'">
                                            <label>Country</label>
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
                                            <label>City</label>
                                            <select class="chosen-select" v-model="job.city_id">
                                                <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
                                            </select>
                                        </div>


                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <!-- Input -->
                                            <span class="title">Expire Date</span>
                                            <input type="date" v-model="job.expire_date">
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12 my-auto">
                                            <!-- Input -->
                                            <label class="switch">
                                                <input type="checkbox"
                                                       v-model="job.show_applicants_num">
                                                <span class="slider round mr-2"></span>
                                                <span class="title">Show Applicants Number</span>
                                            </label>
                                        </div>

                                        <!-- Input -->
                                        <div v-if="errors.empty" class="form-group col-lg-12 col-md-6 alert alert-danger">
                                            Please fill all required fields.
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12 text-right">
                                            <button class="btn btn-success"
                                                    type="button"
                                                    @click="addJob">
                                                Add
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
        document.title = "Dashboard - Add New Job"
        // Get User
        axios.get('/request/profile/get-add-job')
            .then((res) => {
                if(res.data == 0) {
                    window.location.href = "/en/dashboard"
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
                    title: 'Added successfully'
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
