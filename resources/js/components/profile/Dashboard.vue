<template>
    <div>
        <section class="user-dashboard" v-if="user.type == 1">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>Welcome, {{ user.name }}</h3>
                </div>


                <div class="ls-widget"
                     v-if="user.complete.profile > 5 || user.complete.portfolio ||
                     user.complete.edu || user.complete.exp || user.complete.cv">
                    <div class="tabs-box">
                        <div class="widget-content py-5">
                            <div class="row text-center">
                                <div class="col-12 col-lg-6">
                                    <div>
                                        <a href="/profile">
                                            <img src="/assets/images/profile.svg" style="width: 450px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center mt-4">
                                    <div class="upper-title-box">
                                        <h3 class="text-left">Increase your chances by:</h3>
                                        <ul class="complete-profile-list">
                                            <li v-if="user.complete.profile > 5">
                                                <a href="/profile">Complete your information</a>
                                            </li>
                                            <li v-if="user.complete.portfolio">
                                                <a href="/profile/portfolio">Create Attractive Gallery</a>
                                            </li>
                                            <li v-if="user.complete.edu">
                                                <a href="/profile/resume">Add Education Levels</a>
                                            </li>
                                            <li v-if="user.complete.exp">
                                                <a href="/profile/resume">Add Experience Careers</a>
                                            </li>
                                            <li v-if="user.complete.cv">
                                                <a href="/profile/resume">Upload your CV</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item">
                            <div class="component-loading" v-if="loading.staticComponents">
                                <i class="fa fa-spin fa-spinner"></i>
                            </div>
                            <div class="left">
                                <i class="icon flaticon-briefcase"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.applicants.length }}</h4>
                                <p>Applied Jobs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-red">
                            <div class="component-loading" v-if="loading.staticComponents">
                                <i class="fa fa-spin fa-spinner"></i>
                            </div>
                            <div class="left">
                                <i class="icon la la-image"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.user_portfolio.length }}</h4>
                                <p>Portfolio</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-yellow">
                            <div class="component-loading" v-if="loading.staticComponents">
                                <i class="fa fa-spin fa-spinner"></i>
                            </div>
                            <div class="left">
                                <i class="icon la la-bell"></i>
                            </div>
                            <div class="right">
                                <h4>7</h4>
                                <p>Notifications</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-green">
                            <div class="component-loading" v-if="loading.staticComponents">
                                <i class="fa fa-spin fa-spinner"></i>
                            </div>
                            <div class="left">
                                <i class="icon la la-bookmark-o"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.shortlists.length }}</h4>
                                <p>Shortlist</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-7">
                        <!-- Graph widget -->
                        <div class="graph-widget ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Suggested Jobs</h4>
                                    <div class="chosen-outer">
                                        <a href="/jobs" v-if="suggestedJobs.length > 0">Show All</a>
                                    </div>
                                </div>

                                <div class="widget-content" v-if="suggestedJobs.length == 0">
                                    <div class="row">
                                        <div class="col-12" v-if="user.category_id">
                                            <p class="text-center">No Related Job.</p>
                                        </div>
                                        <div class="col-12 text-center py-3" v-else>
                                            <h6 class="mb-4">
                                                No Category added yet,
                                                <a href="/profile">Complete your profile</a>.
                                            </h6>
                                            <a href="/profile">
                                                <img src="/assets/images/add_category.svg" style="width: 300px;">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="widget-content" v-if="suggestedJobs.length > 0">
                                    <div class="row">
                                        <div class="candidate-block-three col-md-12"
                                             style="margin-bottom: 10px;"
                                             v-for="job in suggestedJobs"
                                             :key="job.id">
                                            <div class="inner-box" style="padding: 15px">
                                                <div class="content">
                                                    <figure class="image">
                                                        <img :src="'/images/users/' + job.user.image">
                                                    </figure>
                                                    <h4 class="name">
                                                        <a :href="'/job/' + job.id">{{ job.title }}</a>
                                                    </h4>
                                                    <ul class="candidate-info">
                                                        <li>
                                                            <a :href="'/u/' + job.user.username">
                                                                <span class="icon la la-user-tie"></span>
                                                                {{ job.user.name }}
                                                            </a>
                                                        </li>
                                                        <li v-if="job.country">
                                                            <span class="icon flaticon-map-locator"></span>
                                                            {{ job.city.name }}, {{ job.country.name }}
                                                        </li>
                                                        <li v-if="job.type === 'Freelance'">
                                                            <span class="icon flaticon-monitor"></span>
                                                            Remotely
                                                        </li>
                                                        <li>
                                                            <span class="icon flaticon-clock-3"></span>
                                                            {{ job.time }}
                                                        </li>
                                                    </ul>
                                                    <ul class="post-tags">
                                                        <li class="time">{{ job.type }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <!-- Notification Widget -->
                        <div class="notification-widget ls-widget">
                            <div class="widget-title">
                                <h4>Notifications</h4>
                                <div class="chosen-outer">
                                    <a href="/">Show All</a>
                                </div>
                            </div>
                            <div class="widget-content">
                                <ul class="notification-list">
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Wade Warren</strong> applied for a job <span class="colored">Web Developer</span></li>
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Henry Wilson</strong> applied for a job <span class="colored">Senior Product Designer</span></li>
                                    <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Raul Costa</strong> applied for a job <span class="colored">Product Manager, Risk</span></li>
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Jack Milk</strong> applied for a job <span class="colored">Technical Architect</span></li>
                                    <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Michel Arian</strong> applied for a job <span class="colored">Software Engineer</span></li>
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Ali Tufan</strong> applied for a job <span class="colored">UI Designer</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <!-- applicants Widget -->
                        <div class="applicants-widget ls-widget">
                            <div class="widget-title">
                                <h4>Jobs Applied Recently</h4>
                                <div class="chosen-outer">
                                    <a href="/applied-jobs">Show All</a>
                                </div>
                            </div>
                            <div class="widget-content">
                                <div class="row" v-if="user.applicants.length > 0">
                                    <!-- Job Block -->
                                    <div class="job-block col-lg-6 col-md-12 col-sm-12"
                                         v-for="applicant in user.applicants"
                                         :key="applicant.id">
                                        <div class="inner-box">
                                            <div class="content">
                                                <span class="company-logo">
                                                    <img :src="'/images/users/' + applicant.job.user.image">
                                                </span>
                                                <h4>
                                                    <a href="#">{{ applicant.job.title }}, {{ applicant.job.user.name }}</a>
                                                </h4>
                                                <ul class="job-info">
                                                    <li>
                                                        <span class="icon flaticon-briefcase"></span>
                                                        {{ applicant.job.category.name }}
                                                    </li>
                                                    <li v-if="applicant.job.country">
                                                        <span class="icon flaticon-map-locator"></span>
                                                        {{ applicant.job.city.name }}, {{ applicant.job.country.name }}
                                                    </li>
                                                    <li v-if="applicant.job.type === 'Freelance'">
                                                        <span class="icon flaticon-monitor"></span>
                                                        Remotely
                                                    </li>
                                                    <li>
                                                        <span class="icon flaticon-clock-3"></span>
                                                        {{ applicant.job.time }}
                                                    </li>
<!--                                                    <li><span class="icon flaticon-money"></span> $35k - $45k</li>-->
                                                </ul>
                                                <ul class="job-other-info">
                                                    <li class="time">{{ applicant.job.type }}</li>
<!--                                                    <li class="privacy">Private</li>-->
<!--                                                    <li class="required">Urgent</li>-->
                                                </ul>
                                                <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-md-12 text-center">
                                        <p>No Applicants yet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="user-dashboard" v-if="user.type == 2">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>Welcome, {{ user.name }}</h3>
                </div>

                <div class="ls-widget"
                     v-if="user.complete > 5">
                    <div class="tabs-box">
                        <div class="widget-content py-5">
                            <div class="row text-center">
                                <div class="col-12 col-lg-6">
                                    <div>
                                        <a href="/profile">
                                            <img src="/assets/images/profile.svg" style="width: 450px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center mt-4">
                                    <div class="upper-title-box">
                                        <h3 class="text-left">Increase your chances by:</h3>
                                        <ul class="complete-profile-list">
                                            <li v-if="user.complete > 5">
                                                <a href="/profile">Complete your information</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item">
                            <div class="left">
                                <i class="icon flaticon-briefcase"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.jobs.length }}</h4>
                                <p>Posted Jobs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-red">
                            <div class="left">
                                <i class="icon la la-file-invoice"></i>
                            </div>
                            <div class="right">
                                <h4>9382</h4>
                                <p>Job Alerts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-yellow">
                            <div class="left">
                                <i class="icon la la-comment-o"></i>
                            </div>
                            <div class="right">
                                <h4>74</h4>
                                <p>Notifications</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-green">
                            <div class="left">
                                <i class="icon la la-bookmark-o"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.shortlists.length }}</h4>
                                <p>Shortlist</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-7">
                        <!-- Graph widget -->
                        <div class="graph-widget ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Your Profile Views</h4>
                                    <div class="chosen-outer">
                                        <!--Tabs Box-->
                                        <select class="chosen-select">
                                            <option>Last 6 Months</option>
                                            <option>Last 12 Months</option>
                                            <option>Last 16 Months</option>
                                            <option>Last 24 Months</option>
                                            <option>Last 5 year</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="widget-content">
                                    <div class="row">
                                        <div class="candidate-block-three col-md-12"
                                             v-for="job in suggestedJobs"
                                             :key="job.id">
                                            <div class="inner-box">
                                                <div class="content">
                                                    <figure class="image">
                                                        <img :src="'/images/users/' + job.applicant.user.image">
                                                    </figure>
                                                    <h4 class="name"><a href="#">Darlene Robertson</a></h4>
                                                    <ul class="candidate-info">
                                                        <li class="designation">UI Designer</li>
                                                        <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                                        <li><span class="icon flaticon-money"></span> $99 / hour</li>
                                                    </ul>
                                                    <ul class="post-tags">
                                                        <li><a href="#">App</a></li>
                                                        <li><a href="#">Design</a></li>
                                                        <li><a href="#">Digital</a></li>
                                                    </ul>
                                                </div>
                                                <div class="option-box">
                                                    <ul class="option-list">
                                                        <li><button data-text="View Aplication"><span class="la la-eye"></span></button></li>
                                                        <li><button data-text="Approve Aplication"><span class="la la-check"></span></button></li>
                                                        <li><button data-text="Reject Aplication"><span class="la la-times-circle"></span></button></li>
                                                        <li><button data-text="Delete Aplication"><span class="la la-trash"></span></button></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <!-- Notification Widget -->
                        <div class="notification-widget ls-widget">
                            <div class="widget-title"><h4>Notifications</h4></div>
                            <div class="widget-content">
                                <ul class="notification-list">
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Wade Warren</strong> applied for a job <span class="colored">Web Developer</span></li>
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Henry Wilson</strong> applied for a job <span class="colored">Senior Product Designer</span></li>
                                    <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Raul Costa</strong> applied for a job <span class="colored">Product Manager, Risk</span></li>
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Jack Milk</strong> applied for a job <span class="colored">Technical Architect</span></li>
                                    <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Michel Arian</strong> applied for a job <span class="colored">Software Engineer</span></li>
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Ali Tufan</strong> applied for a job <span class="colored">UI Designer</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="user-dashboard" v-if="user.type == 3">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3 >Welcome, {{ user.name }}</h3>
                </div>

                <div class="ls-widget"
                     v-if="user.complete.profile > 5 || user.complete.portfolio">
                    <div class="tabs-box">
                        <div class="widget-content py-5">
                            <div class="row text-center">
                                <div class="col-12 col-lg-6">
                                    <div>
                                        <a href="/profile">
                                            <img src="/assets/images/profile.svg" style="width: 450px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center mt-4">
                                    <div class="upper-title-box">
                                        <h3 class="text-left">Increase your chances by:</h3>
                                        <ul class="complete-profile-list">
                                            <li v-if="user.complete.profile > 5">
                                                <a href="/profile">Complete your information</a>
                                            </li>
                                            <li v-if="user.complete.portfolio">
                                                <a href="/profile/portfolio">Create Attractive Gallery</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item">
                            <div class="left">
                                <i class="icon flaticon-briefcase"></i>
                            </div>
                            <div class="right">
                                <h4>5</h4>
                                <p>Posted Jobs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-red">
                            <div class="left">
                                <i class="icon la la-image"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.user_portfolio.length }}</h4>
                                <p>Portfolio</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-yellow">
                            <div class="left">
                                <i class="icon la la-comment-o"></i>
                            </div>
                            <div class="right">
                                <h4>74</h4>
                                <p>Messages</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-green">
                            <div class="left">
                                <i class="icon la la-bookmark-o"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.shortlists.length }}</h4>
                                <p>Shortlist</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7">
                        <!-- Graph widget -->
                        <div class="graph-widget ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Your Profile Views</h4>
                                    <div class="chosen-outer">
                                        <!--Tabs Box-->
                                        <select class="chosen-select">
                                            <option>Last 6 Months</option>
                                            <option>Last 12 Months</option>
                                            <option>Last 16 Months</option>
                                            <option>Last 24 Months</option>
                                            <option>Last 5 year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <!-- Notification Widget -->
                        <div class="notification-widget ls-widget">
                            <div class="widget-title"><h4>Notifications</h4></div>
                            <div class="widget-content">
                                <ul class="notification-list">
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Wade Warren</strong> applied for a job <span class="colored">Web Developer</span></li>
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Henry Wilson</strong> applied for a job <span class="colored">Senior Product Designer</span></li>
                                    <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Raul Costa</strong> applied for a job <span class="colored">Product Manager, Risk</span></li>
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Jack Milk</strong> applied for a job <span class="colored">Technical Architect</span></li>
                                    <li class="success"><span class="icon flaticon-briefcase"></span> <strong>Michel Arian</strong> applied for a job <span class="colored">Software Engineer</span></li>
                                    <li><span class="icon flaticon-briefcase"></span> <strong>Ali Tufan</strong> applied for a job <span class="colored">UI Designer</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    mounted() {
        document.title = "Dashboard"
        axios.get("/request/profile/get-user-dashboard")
        .then((res) => {
            if(res.data == 0) {
                window.location.href = "/login"
            }
            console.log(res.data)
            this.user = res.data.user
            this.suggestedJobs = res.data.suggestedJobs
            this.loading.staticComponents = false
        })
    },
    data: function () {
        return {
            user: "",
            suggestedJobs: [],
            loading: {
                staticComponents: true
            }
        }
    }
}
</script>

<style scoped>
.company-logo img {
    border-radius: 50%;
}
.complete-profile-list {
    text-align: left;
    margin-left: 25px;
}
.complete-profile-list,
.complete-profile-list li {
    list-style: disclosure-closed;
}
.complete-profile-list li {
    margin: 10px 0;
}
.ui-item {
    overflow: hidden;
}
.component-loading {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: #fff;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
}
</style>
