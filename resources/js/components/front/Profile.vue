<template>
    <div>
        <div class="row my-5" v-if="notFound">
            <div class="col-12 text-center">
                <h5 class="mb-4">
                    Sorry, user not found
                </h5>
                <img src="/assets/images/user_not_found.svg" style="height: 300px">
            </div>
        </div>
        <section class="candidate-detail-section" v-else-if="user.type == 1">
            <!-- Upper Box -->
            <div class="upper-box">
                <div class="auto-container">
                    <!-- Candidate block Five -->
                    <div class="candidate-block-five">
                        <div class="inner-box">
                            <div class="content">
                                <figure class="image">
                                    <img :src="'/images/users/' + user.image" v-if="user.image">
                                    <img src="/assets/images/default_avatar.png" v-else>
                                </figure>
                                <h4 class="name">
                                    <a href="#">{{ user.name }}</a>
                                </h4>
                                <ul class="candidate-info">
                                    <li class="designation" v-if="user.job_title">
                                        {{ user.job_title }}
                                    </li>
                                    <li v-if="user.category">
                                        <span class="icon flaticon-briefcase"></span>
                                        {{ user.category.name }}
                                    </li>
                                    <li v-if="user.country">
                                        <span class="icon flaticon-map-locator"></span>
                                        {{ user.city.name }},{{ user.country.name }}
                                    </li>
                                    <li v-if="user.phone">
                                        <a :href="'tel:'+user.phone">
                                            <span class="icon flaticon-telephone-1"></span>
                                            {{ user.phone }}
                                        </a>
                                    </li>
                                    <li v-if="user.website">
                                        <a :href="user.website">
                                            <span class="icon flaticon-worldwide"></span>
                                            {{ user.website }}
                                        </a>
                                    </li>
<!--                                    <li><span class="icon flaticon-money"></span> $99 / hour</li>-->
                                    <li>
                                        <span class="icon flaticon-clock"></span>
                                        Member Since {{ user.time }}
                                    </li>
                                </ul>
                                <ul class="post-tags">
                                    <li><a href="#">App</a></li>
                                    <li><a href="#">Design</a></li>
                                    <li><a href="#">Digital</a></li>
                                </ul>
                            </div>

                            <div class="btn-box">
                                <a :href="'/cv/'+user.cv" class="theme-btn btn-style-one" v-if="user.cv">
                                    Download CV
                                </a>
                                <button class="bookmark-btn" @click="saveShortlist('resume')">
                                    <i class="flaticon-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="candidate-detail-outer">
                <div class="auto-container">
                    <div class="row">
                        <div class="content-column col-lg-8 col-md-12 col-sm-12">
                            <div class="job-detail" v-if="selectedPortfolio == null">
                                <h4>About {{ user.name }}</h4>
                                <p v-if="user.description">{{ user.description }}</p>
                                <p v-else>No Description added</p>
                                <!-- Resume / Education -->
                                <div class="resume-outer" v-if="user.user_education.length > 0">
                                    <div class="upper-title">
                                        <h4>Education</h4>
                                    </div>
                                    <!-- Resume BLock -->
                                    <div class="resume-block" v-for="(ed,index) in user.user_education" :key="ed.id">
                                        <div class="inner">
                                            <span class="name"></span>
                                            <div class="title-box">
                                                <div class="info-box">
                                                    <h3>{{ ed.certificate }} in {{ ed.field }}</h3>
                                                    <span>{{ ed.college }}</span>
                                                </div>
                                                <div class="edit-box">
                                                    <span class="year">
                                                        {{ ed.start_year }}
                                                        {{ ed.end_year ? '- ' + ed.end_year : '' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="text">
                                                {{ ed.description ? ed.description : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="resume-outer" v-else>
                                    <div class="upper-title">
                                        <h4>Education</h4>
                                    </div>
                                    <div class="text-center">
                                        <p>No Education added.</p>
                                    </div>
                                </div>

                                <!-- Resume / Work & Experience -->
                                <div class="resume-outer theme-blue" v-if="user.user_experience.length > 0">
                                    <div class="upper-title">
                                        <h4>Work & Experience</h4>
                                    </div>
                                    <!-- Resume BLock -->
                                    <div class="resume-block" v-for="(ex,index) in user.user_experience" :key="ex.id">
                                        <div class="inner">
                                            <span class="name"></span>
                                            <div class="title-box">
                                                <div class="info-box">
                                                    <h3>{{ ex.job_title }}</h3>
                                                    <span>{{ ex.company }}</span>
                                                </div>
                                                <div class="edit-box">
                                                    <span class="year">
                                                        {{ ex.start_year }}
                                                        {{ ex.end_year ? '- ' + ex.end_year : '' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="text">
                                                {{ ex.description ? ex.description : '' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="resume-outer theme-blue" v-else>
                                    <div class="upper-title">
                                        <h4>Work & Experience</h4>
                                    </div>
                                    <div class="text-center">
                                        <p>No Experience added.</p>
                                    </div>
                                </div>

                                <!-- Portfolio -->
                                <div class="portfolio-outer">
                                    <div class="row" v-if="user.user_portfolio.length > 0">
                                        <div class="col-12">
                                            <h4>Portfolio of  {{ user.name }}</h4>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6"
                                             v-for="port in user.user_portfolio"
                                             :key="port.id">
                                            <figure class="image">
                                                <button type="button"
                                                        class="lightbox-image"
                                                        @click="showPortfolio(port.id,$event)">
                                                    <img :src="'/images/portfolio/' + port.portfolio_images[0].image">
                                                </button>
                                                <span class="icon fa fa-eye"></span>
                                            </figure>
                                            <h6 class="my-3 mb-5 pl-2">
                                                <a :href="'/portfolio/'+port.id"
                                                   class="text-dark">
                                                    {{ stringCut(port.title) }}
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="show-portfolio" v-if="selectedPortfolio != null">
                                <h4 id="port_title">
                                    {{ selectedPortfolio.title }}
                                    <a v-if="selectedPortfolio.url"
                                       :href="selectedPortfolio.url"
                                       target="_blank"
                                       class="btn btn-primary btn-sm float-right">
                                        <i class="fa fa-external-link-alt fa-sm"></i>
                                        Visit
                                    </a>
                                </h4>
                                <p class="my-3">{{ selectedPortfolio.description }}</p>
                                <div class="row">
                                    <div class="col-12 col-md-6 mt-4"
                                         v-for="work in selectedPortfolio.portfolio_images"
                                         :key="work.id">
                                        <img :src="'/images/portfolio/' + work.image"
                                             class="w-100 h-100">
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <button type="button" class="btn btn-primary"
                                                @click="selectedPortfolio=null">
                                            Back
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                            <aside class="sidebar">
                                <div class="sidebar-widget">
                                    <div class="widget-content">
                                        <ul class="job-overview">
                                            <li v-if="user.experience">
                                                <i class="icon icon-calendar"></i>
                                                <h5>Experience:</h5>
                                                <span>{{ user.experience }} Years</span>
                                            </li>

<!--                                            <li>-->
<!--                                                <i class="icon icon-expiry"></i>-->
<!--                                                <h5>Age:</h5>-->
<!--                                                <span>28-33 Years</span>-->
<!--                                            </li>-->

<!--                                            <li>-->
<!--                                                <i class="icon icon-rate"></i>-->
<!--                                                <h5>Current Salary:</h5>-->
<!--                                                <span>11K - 15K</span>-->
<!--                                            </li>-->

<!--                                            <li>-->
<!--                                                <i class="icon icon-salary"></i>-->
<!--                                                <h5>Expected Salary:</h5>-->
<!--                                                <span>26K - 30K</span>-->
<!--                                            </li>-->

                                            <li v-if="user.gender">
                                                <i class="icon icon-user-2"></i>
                                                <h5>Gender:</h5>
                                                <span>{{ user.gender }}</span>
                                            </li>

                                            <li v-if="user.lang">
                                                <i class="icon icon-language"></i>
                                                <h5>Language:</h5>
                                                <span v-for="lan in user.lang" class="pt-2 mx-2 d-block">{{ lan }}</span>
                                            </li>

                                            <li v-if="user.education">
                                                <i class="icon icon-degree"></i>
                                                <h5>Education Level:</h5>
                                                <span>{{ user.education }}</span>
                                            </li>

                                        </ul>
                                    </div>

                                </div>

                                <div class="sidebar-widget social-media-widget"
                                     v-if="user.facebook || user.twitter || user.instagram || user.linkedin">
                                    <h4 class="widget-title">Social media</h4>
                                    <div class="widget-content">
                                        <div class="social-links">
                                            <a :href="user.facebook" v-if="user.facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a :href="user.twitter" v-if="user.twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a :href="user.linkedin" v-if="user.linkedin">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                <div class="sidebar-widget" v-if="user.skill">
                                    <!-- Job Skills -->
                                    <h4 class="widget-title">Professional Skills</h4>
                                    <div class="widget-content">
                                        <ul class="job-skills">
                                            <li v-for="skill in user.skill">
                                                <a href="#">{{ skill }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="job-detail-section" v-else-if="user.type == 2">
            <!-- Upper Box -->
            <div class="upper-box">
                <div class="auto-container">
                    <!-- Job Block -->
                    <div class="job-block-seven">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo">
                                    <img :src="'/images/users/' + user.image" v-if="user.image">
                                    <img src="/assets/images/default_avatar.png" v-else>
                                </span>
                                <h4><a href="#">{{ user.name }}</a></h4>
                                <ul class="job-info">
                                    <li v-if="user.country">
                                        <span class="icon flaticon-map-locator"></span>
                                        {{ user.city.name }}, {{ user.country.name }}
                                    </li>
<!--                                    <li><span class="icon flaticon-briefcase"></span> Accounting / Finance</li>-->
                                    <li v-if="user.phone">
                                        <span class="icon flaticon-telephone-1"></span>
                                        {{ user.phone }}
                                    </li>
                                    <li v-if="user.website">
                                        <span class="icon flaticon-mail"></span>
                                        {{ user.website }}
                                    </li>
                                </ul>
<!--                                <ul class="job-other-info">-->
<!--                                    <li class="time">3 Open Jobs</li>-->
<!--                                </ul>-->
                            </div>

                            <div class="btn-box">
                                <button class="bookmark-btn" @click="saveShortlist('company')">
                                    <i class="flaticon-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="job-detail-outer">
                <div class="auto-container">
                    <div class="row">
                        <div class="content-column col-lg-8 col-md-12 col-sm-12">
                            <div class="job-detail">
                                <h4>About Company</h4>
                                <p v-if="user.description">{{ user.description }}</p>
                            </div>

                            <!-- Related Jobs -->
                            <div class="related-jobs">
                                <div class="title-box">
                                    <h3>{{ user.jobs.length }} jobs at {{ user.name }}</h3>
                                </div>

                                <!-- Job Block -->
                                <div class="job-block"
                                     v-for="job in user.jobs"
                                     :key="job.id">
                                    <div class="inner-box">
                                        <div class="content">
                                            <span class="company-logo">
                                                <img :src="'/images/users/' + user.image" v-if="user.image">
                                                <img src="/assets/images/default_avatar.png" v-else>
                                            </span>
                                            <h4>
                                                <a :href="'/job/' + job.id">{{ job.title }}</a>
                                            </h4>
                                            <ul class="job-info">
                                                <li>
                                                    <span class="icon flaticon-briefcase"></span>
                                                    {{ job.category.name }}
                                                </li>
                                                <li v-if="job.country">
                                                    <span class="icon flaticon-map-locator"></span>
                                                    {{ job.city.name }}, {{ job.country.name }}
                                                </li>
                                                <li>
                                                    <span class="icon flaticon-clock-3"></span>
                                                    {{ job.time }}
                                                </li>
                                                <li v-if="job.salary">
                                                    <span class="icon flaticon-money"></span>
                                                    {{ job.salary }}$
                                                </li>
                                            </ul>
                                            <ul class="job-other-info">
                                                <li class="time">{{ job.type }}</li>
                                                <li class="time bg-danger text-white" v-if="job.expire == 0">Expired</li>
                                            </ul>
                                            <button class="bookmark-btn">
                                                <span class="flaticon-bookmark"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                            <aside class="sidebar">
                                <div class="sidebar-widget company-widget">
                                    <div class="widget-content">

                                        <ul class="company-info mt-0">
                                            <li v-if="user.company_size">Company size: <span>{{ user.company_size }}</span></li>
                                            <li v-if="user.founded_in">Founded in: <span>{{ user.founded_in }}</span></li>
                                            <li v-if="user.phone">Phone: <span>{{ user.phone }}</span></li>
                                            <li v-if="user.company_email">Email: <span>{{ user.company_email }}</span></li>
                                            <li v-if="user.country">Location: <span>{{ user.city.name }}, {{ user.country.name }}</span></li>
                                            <li v-if="user.facebook || user.twitter || user.linkedin">
                                                Social media:
                                                <div class="social-links">
                                                    <a :href="user.facebook">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                    <a :href="user.twitter">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                    <a :href="user.linkedin">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="btn-box"><a href="#" class="theme-btn btn-style-three">www.invisionapp.com</a>
                                        </div>
                                    </div>
                                </div>

<!--                                <div class="sidebar-widget">-->
<!--                                    &lt;!&ndash; Map Widget &ndash;&gt;-->
<!--                                    <h4 class="widget-title">Job Location</h4>-->
<!--                                    <div class="widget-content">-->
<!--                                        <div class="map-outer mb-0">-->
<!--                                            <div class="map-canvas"-->
<!--                                                 data-zoom="12"-->
<!--                                                 data-lat="-37.817085"-->
<!--                                                 data-lng="144.955631"-->
<!--                                                 data-type="roadmap"-->
<!--                                                 data-hue="#ffc400"-->
<!--                                                 data-title="Envato"-->
<!--                                                 data-icon-path="images/resource/map-marker.png"-->
<!--                                                 data-content="Melbourne VIC 3000, Australia<br><a href='mailto:info@youremail.com'>info@youremail.com</a>">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="candidate-detail-section" v-else-if="user.type == 3">
            <!-- Upper Box -->
            <div class="upper-box">
                <div class="auto-container">
                    <!-- Candidate block Five -->
                    <div class="candidate-block-five">
                        <div class="inner-box">
                            <div class="content">
                                <figure class="image">
                                    <img :src="'/images/users/' + user.image" v-if="user.image">
                                    <img src="/assets/images/default_avatar.png" v-else>
                                </figure>
                                <h4 class="name">
                                    <a href="#">{{ user.name }}, {{ user.b_name }}</a>
                                </h4>
                                <ul class="candidate-info">
                                    <li v-if="user.category">
                                        <span class="icon flaticon-briefcase"></span>
                                        {{ user.category.name }}
                                    </li>
                                    <li v-if="user.country">
                                        <span class="icon flaticon-map-locator"></span>
                                        {{ user.city.name }},{{ user.country.name }}
                                    </li>
                                    <li>
                                        <span class="icon flaticon-clock"></span>
                                        Member Since {{ user.time }}
                                    </li>
                                </ul>
                            </div>

                            <div class="btn-box">
                                <button class="bookmark-btn" @click="saveShortlist('business')">
                                    <i class="flaticon-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="candidate-detail-outer">
                <div class="auto-container">
                    <div class="row">
                        <div class="content-column col-lg-8 col-md-12 col-sm-12">
                            <div class="job-detail">
                                <h4>About {{ user.name }}</h4>
                                <p v-if="user.description">{{ user.description }}</p>
                                <p v-else>No Description added</p>
                                <!-- Portfolio -->
                                <div class="portfolio-outer">
                                    <div class="row" v-if="user.user_portfolio.length > 0">
                                        <div class="col-lg-3 col-md-3 col-sm-6" v-for="port in user.user_portfolio"
                                             :key="port.id">
                                            <figure class="image">
                                                <a :href="'/images/portfolio/' + port.image"
                                                   class="lightbox-image">
                                                    <img :src="'/images/portfolio/' + port.image" alt=""></a>
                                                <span class="icon flaticon-plus"></span>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                            <aside class="sidebar">
                                <div class="sidebar-widget">
                                    <div class="widget-content">
                                        <ul class="job-overview">
                                            <li v-if="user.experience">
                                                <i class="icon icon-calendar"></i>
                                                <h5>Experience:</h5>
                                                <span>{{ user.experience }} Years</span>
                                            </li>

                                            <li v-if="user.gender">
                                                <i class="icon icon-user-2"></i>
                                                <h5>Gender:</h5>
                                                <span>{{ user.gender }}</span>
                                            </li>

                                            <li v-if="user.lang">
                                                <i class="icon icon-language"></i>
                                                <h5>Language:</h5>
                                                <span v-for="lan in user.lang" class="pt-2 mx-2 d-block">{{ lan }}</span>
                                            </li>

                                            <li v-if="user.education">
                                                <i class="icon icon-degree"></i>
                                                <h5>Education Level:</h5>
                                                <span>{{ user.education }}</span>
                                            </li>

                                        </ul>
                                    </div>

                                </div>

                                <div class="sidebar-widget social-media-widget"
                                     v-if="user.facebook || user.twitter || user.instagram || user.linkedin">
                                    <h4 class="widget-title">Social media</h4>
                                    <div class="widget-content">
                                        <div class="social-links">
                                            <a :href="user.facebook" v-if="user.facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a :href="user.twitter" v-if="user.twitter">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                            <a :href="user.linkedin" v-if="user.linkedin">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                <div class="sidebar-widget" v-if="user.skill">
                                    <!-- Job Skills -->
                                    <h4 class="widget-title">Professional Skills</h4>
                                    <div class="widget-content">
                                        <ul class="job-skills">
                                            <li v-for="skill in user.skill">
                                                <a href="#">{{ skill }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!--        <div class="loading-profile" v-if="loading">-->
<!--            <i class="fas fa-spinner fa-pulse fa-lg"></i>-->
<!--        </div>-->
    </div>
</template>

<script>
export default {
    mounted() {
        document.getElementsByClassName('dashboard')[0].classList.remove('dashboard')
        document.getElementsByClassName('main-header')[0].classList.remove('header-shaddow')
        let username = this.$route.params.username
        document.title = "Profile - " + username
        axios.get("/request/front/get-user-profile/" + username)
            .then((res) => {
                if(res.data == 0) {
                    this.notFound = true
                    document.title = "Profile - Not Found"
                } else {
                    this.user = res.data
                    document.title = "Profile - " + this.user.name
                }
                // console.log(res.data)
                // this.loading = false
            })
            .catch((err) => {
                console.log(err)
            })
    },
    data: function () {
        return {
            user: "",
            notFound: false,
            loading: true,
            selectedPortfolio: null
        }
    },
    methods: {
        saveShortlist: function (t) {
            axios.post("/request/profile/save-shortlist", {
                target_id: this.user.id,
                type: t
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
                    }
                })
        },
        stringCut(s) {
            return s.length > 20 ? s.substr(0, 20) + "..." : s;
        },
        showPortfolio(i,e) {
            // location.href = "#"
            // location.href = "#port_title"
            return this.selectedPortfolio =  this.user.user_portfolio.find(function (e) {
                if(e.id == i)
                    return e
            })
        }
    }
}
</script>

<style scoped>
.loading-profile {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}
.loading-profile i {
    color: white;
    font-size: 32px;
}
.company-logo img {
    border-radius: 50%;
}
</style>
