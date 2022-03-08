<template>
    <div>
        <div class="row my-5" v-if="notFound">
            <div class="col-12 text-center">
                <h5 class="mb-4">
                    Sorry, job not found
                </h5>
                <img src="/assets/images/user_not_found.svg" style="height: 300px">
            </div>
        </div>
        <section class="job-detail-section" v-else>
            <div class="job-detail-outer">
                <div class="auto-container">
                    <div class="row">
                        <div class="content-column col-lg-8 col-md-12 col-sm-12">
                            <div class="job-block-outer">
                                <!-- Job Block -->
                                <div class="job-block-seven style-two">
                                    <div class="inner-box">
                                        <div class="content">
                                            <h4>{{ job.title }}</h4>
                                            <ul class="job-info">
                                                <li v-if="job.category_id">
                                                    <span class="icon flaticon-briefcase"></span>
                                                    {{ job.category.name }}
                                                </li>
                                                <li v-if="job.country">
                                                    <span class="icon flaticon-map-locator"></span>
                                                    {{ job.city.name }}, {{ job.country.name }}
                                                </li>
                                                <li><span class="icon flaticon-clock-3"></span> {{ job.time }}</li>
                                                <li v-if="job.salary">
                                                    <span class="icon flaticon-money"></span>
                                                    {{ job.salary }}$
                                                </li>
                                            </ul>

                                            <ul class="job-other-info">
                                                <li class="time">{{ job.type }}</li>
                                                <li class="privacy" v-if="job.show_applicants_num">
                                                    {{ job.applicants.length }} Applicant
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="job-overview-two">
                                <h4>Job Description</h4>
                                <ul>
                                    <li>
                                        <i class="icon icon-calendar"></i>
                                        <h5>Date Posted:</h5>
                                        <span>{{ job.time }}</span>
                                    </li>
                                    <li v-if="job.expire_date">
                                        <i class="icon icon-expiry"></i>
                                        <h5>Expiration date:</h5>
                                        <span>
                                        {{ job.expire_date }}
                                        <span v-if="job.expire == 0" class="text-danger">(Expired)</span>
                                    </span>
                                    </li>
                                    <li v-else>
                                        <i class="icon icon-expiry"></i>
                                        <h5>Expiration date:</h5>
                                        <span>Open</span>
                                    </li>
                                    <li v-if="job.country">
                                        <i class="icon icon-location"></i>
                                        <h5>Location:</h5>
                                        <span>{{ job.city.name }}, {{ job.country.name }}</span>
                                    </li>
                                    <li>
                                        <i class="icon icon-user-2"></i>
                                        <h5>Job Title:</h5>
                                        <span>{{ job.title }}</span>
                                    </li>
                                    <li v-if="job.hours">
                                        <i class="icon icon-clock"></i>
                                        <h5>Hours:</h5>
                                        <span>{{ job.hours }} hours / day</span>
                                    </li>
                                    <li v-if="job.salary">
                                        <i class="icon icon-salary"></i>
                                        <h5>Salary:</h5>
                                        <span>{{ job.salary }}$</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="job-detail">
                                <h4>Job Description</h4>
                                <p>{{ job.description }}</p>
                            </div>

                            <!-- Other Options -->
                            <div class="other-options">
                                <div class="social-share">
                                    <h5>Share this job</h5>
                                    <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                                    <a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                            <aside class="sidebar">
                                <div class="btn-box"
                                     :class="{'flex-lg-row-reverse':user.type!=1 || job.expire == 0}">
                                    <button type="button"
                                            v-if="user && user.type == 1 && job.expire != 0"
                                            id="apply-btn"
                                            class="theme-btn btn-style-one"
                                            :class="{'bg-gray':applyBtnLoading}"
                                            @click="showModal = true">
                                        <span v-if="!applyBtnLoading">Apply For Job</span>
                                        <i class="fas fa-spinner fa-pulse fa-lg" v-if="applyBtnLoading"></i>
                                    </button>
                                    <button class="bookmark-btn" @click="saveShortlist">
                                        <i class="flaticon-bookmark"></i>
                                    </button>
                                </div>
                                <div class="sidebar-widget company-widget">
                                    <div class="widget-content">
                                        <div class="company-title">
                                            <div class="company-logo">
                                                <img :src="'/images/users/' + job.user.image" v-if="job.user.image">
                                                <img src="/assets/images/default_avatar.png" v-else>
                                            </div>
                                            <h5 class="company-name">{{ job.user.name }}</h5>
                                            <a :href="'/u/' + job.user.username" class="profile-link">View company profile</a>
                                        </div>

                                        <ul class="company-info">
                                            <li>Primary industry: <span>Software</span></li>
                                            <li v-if="job.user.company_size">Company size: <span>{{ job.user.company_size }}</span></li>
                                            <li v-if="job.user.founded_in">Founded in: <span>{{ job.user.founded_in }}</span></li>
                                            <li v-if="job.user.phone">Phone: <span>{{ job.user.phone ? job.user.phone : '' }}</span></li>
                                            <li v-if="job.user.company_email">Email: <span>{{ job.user.company_email }}</span></li>
                                            <li v-if="job.user.country">Location:
                                                <span>{{ job.user.city.name ? job.user.city.name : '' }}, {{ job.user.country.name }}</span>
                                            </li>
                                            <li v-if="job.user.facebook || job.user.twitter || job.user.linkedin">
                                                Social media:
                                                <div class="social-links">
                                                    <a :href="job.user.facebook">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                    <a :href="job.user.twitter">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                    <a :href="job.user.linkedin">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="btn-box" v-if="job.user.website">
                                            <a :href="job.user.website" target="_blank" class="theme-btn btn-style-three">
                                                {{ job.user.name }} Website
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>

                    <!-- Related Jobs -->
                    <div class="related-jobs">
                        <div class="title-box">
                            <h3>Related Jobs</h3>
                        </div>
                        <div class="row">
                            <!-- Job Block -->
                            <div class="job-block-four col-xl-3 col-lg-4 col-md-6 col-sm-12"
                                 v-for="(rel,index) in related" :key="index">
                                <div class="inner-box">
                                    <ul class="job-other-info">
                                        <li class="time">{{ rel.type }}</li>
                                    </ul>
                                    <span class="company-logo">
                                    <img :src="'/images/users/' + rel.user.image" v-if="rel.user.image">
                                            <img src="/assets/images/default_avatar.png" v-else>
                                </span>
                                    <span class="company-name">{{ rel.user.name }}</span>
                                    <h4><a :href="'/job/'+rel.id">{{ rel.title }}</a></h4>
                                    <div class="location" v-if="rel.city">
                                        <span class="icon flaticon-map-locator"></span>
                                        {{ rel.city.name }},
                                        {{ rel.country.name }}
                                    </div>
                                    <div class="location" v-else>
                                        <span class="icon flaticon-monitor"></span>
                                        Freelance
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Apply Modal -->
            <Modal v-model="showModal" :title="'Apply for ' + job.title" v-if="user">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <p>Your Applicant for {{ job.title }} in {{ job.user.name }}</p>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            Name: {{ user.name }}
                        </div>
                        <div class="col-12 col-md-6 mt-3" v-if="user.job_title">
                            Job Title: {{ user.job_title }}
                        </div>
                        <div class="col-12 col-md-6 mt-3" v-if="user.country_id">
                            Country: {{ user.country.name }}
                        </div>
                        <div class="col-12 col-md-6 mt-3" v-if="user.city_id">
                            City: {{ user.city.name }}
                        </div>
                        <div class="col-12 col-md-6 mt-3" v-if="user.education">
                            Education Level: {{ user.education }}
                        </div>
                        <div class="col-12 col-md-6 mt-3" v-if="user.experience">
                            Experience: {{ user.experience }} years
                        </div>
                        <div class="col-12 mt-4">
                            <p>Notes:</p>
                            <textarea class="form-control" cols="30" rows="10" v-model="notes"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" @click="applyForJob">Apply</button>
                    <button class="btn btn-secondary" @click="showModal=false">Cancel</button>
                </div>
            </Modal>
        </section>
    </div>
</template>

<script>
export default {
    mounted() {
        document.getElementsByClassName('dashboard')[0].classList.remove('dashboard')
        document.getElementsByClassName('main-header')[0].classList.remove('header-shaddow')
        let job_id = this.$route.params.id
        document.title = "Job - "
        axios.get("/request/front/get-job/" + job_id)
        .then((res) => {
            if(res.data == 0) {
                this.notFound = true
                document.title = "Job - Not Found"
            }
            console.log(res.data)
            this.job = res.data.job
            this.user = res.data.user
            this.related = res.data.related
            document.title = "Job - " + this.job.title
        })
        .catch((err) => {
            console.log(err)
        })

    },
    data: function () {
        return {
            job: "",
            user: "",
            applyBtnLoading: false,
            showModal: false,
            related: {},
            notFound: false,
            notes: ""
        }
    },
    methods: {
        applyForJob: function () {
            let btn = document.getElementById('apply-btn')
            btn.setAttribute('disabled','')
            this.applyBtnLoading = true
            axios.post("/request/front/apply-for-job", {
                job_id: this.job.id,
                notes: this.notes
            })
            .then((res) => {
                // console.log(res.data)
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
                    title: 'Applied successfully'
                })
                btn.removeAttribute('disabled')
                this.applyBtnLoading = false
                this.showModal = false
            })
        },
        saveShortlist: function () {
            axios.post("/request/profile/save-shortlist", {
                target_id: this.job.id,
                type: "job"
            })
            .then((res) => {
                if(res.data == 1) {
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
                } else if(res.data == 0) {
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
                        icon: 'info',
                        title: 'Please Login First'
                    })
                }
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
