<template>
    <div>
        <section class="user-dashboard" v-if="user.type == 1">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>Willkommen, {{ user.name }}</h3>
                </div>


                <div class="ls-widget"
                     v-if="user.complete.profile > 5 || user.complete.portfolio ||
                     user.complete.edu || user.complete.exp || user.complete.cv">
                    <div class="tabs-box">
                        <div class="widget-content py-5">
                            <div class="row text-center">
                                <div class="col-12 col-lg-6">
                                    <div>
                                        <img src="/assets/images/profile.svg" style="width: 450px;">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center mt-4">
                                    <div class="upper-title-box">
                                        <h3 class="text-left">Erhöhen Sie Ihre Chancen um:</h3>
                                        <ul class="complete-profile-list">
                                            <li v-if="user.complete.profile > 5">
                                                <a href="/profile">Vervollständigen Sie Ihre Angaben</a>
                                            </li>
                                            <li v-if="user.complete.portfolio">
                                                <a href="/profile/portfolio">Attraktive Galerie erstellen</a>
                                            </li>
                                            <li v-if="user.complete.edu">
                                                <a href="/profile/resume">Bildungsstufen hinzufügen</a>
                                            </li>
                                            <li v-if="user.complete.exp">
                                                <a href="/profile/resume">Berufserfahrung hinzufügen</a>
                                            </li>
                                            <li v-if="user.complete.cv">
                                                <a href="/profile/resume">Laden Sie Ihren Lebenslauf hoch</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item">
                            <div class="component-loading" v-if="loading.staticComponents">
                                <i class="fa fa-spin fa-spinner"></i>
                            </div>
                            <div class="left">
                                <i class="icon flaticon-briefcase"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.applicants.length }}</h4>
                                <p>Beworbene Jobs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
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
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-green">
                            <div class="component-loading" v-if="loading.staticComponents">
                                <i class="fa fa-spin fa-spinner"></i>
                            </div>
                            <div class="left">
                                <i class="icon la la-bookmark-o"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.shortlists.length }}</h4>
                                <p>Auswahlliste</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <!-- Graph widget -->
                        <div class="graph-widget ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Vorgeschlagene Jobs</h4>
                                    <div class="chosen-outer">
                                        <a href="/jobs" v-if="suggestedJobs.length > 0">Alle anzeigen</a>
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
                                                <a href="/profile">Vervollständigen Sie Ihre Angaben</a>.
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
                                                            Aus der Ferne
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


                    <div class="col-lg-12">
                        <!-- applicants Widget -->
                        <div class="applicants-widget ls-widget">
                            <div class="widget-title">
                                <h4>Kürzlich beworbene Stellen</h4>
                                <div class="chosen-outer">
                                    <a href="/profile/applied-jobs">Alle anzeigen</a>
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
                                                    <a :href="'/job/'+ applicant.job.id">{{ applicant.job.title }}</a>
                                                </h4>
                                                <ul class="job-info">
                                                    <li>
                                                        <a :href="'/u/' + applicant.job.user.username">
                                                            <span class="icon la la-user-tie"></span>
                                                            {{ applicant.job.user.name }}
                                                        </a>
                                                    </li>
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
                                                        Aus der Ferne
                                                    </li>
                                                    <li>
                                                        <span class="icon flaticon-clock-3"></span>
                                                        {{ applicant.job.time }}
                                                    </li>
                                                </ul>
                                                <ul class="job-other-info">
                                                    <li class="time">{{ applicant.job.type }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-md-12 text-center">
                                        <p>Keine Bewerber.</p>
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
                    <h3>Willkommen, {{ user.name }}</h3>
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
                                        <h3 class="text-left">Erhöhen Sie Ihre Chancen um:</h3>
                                        <ul class="complete-profile-list">
                                            <li v-if="user.complete > 5">
                                                <a href="/profile">Vervollständigen Sie Ihre Angaben</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item">
                            <div class="left">
                                <i class="icon flaticon-briefcase"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.jobs.length }}</h4>
                                <p>Stellenanzeigen</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-yellow">
                            <div class="left">
                                <i class="icon la la-comment-o"></i>
                            </div>
                            <div class="right">
                                <h4>{{ unreadNotifications }}</h4>
                                <p>Benachrichtigungen</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-green">
                            <div class="left">
                                <i class="icon la la-bookmark-o"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.shortlists.length }}</h4>
                                <p>Auswahllisten</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <!-- Notification Widget -->
                        <div class="notification-widget ls-widget">
                            <div class="widget-title"><h4>Benachrichtigungen</h4></div>
                            <div class="widget-content">
                                <ul class="notification-list" v-if="notifications.length">
                                    <li v-for="(notification, index) in notifications" :key="index">
                                        <span class="icon flaticon-briefcase"></span>
                                        <a :href="'/u/'+notification.data.candidate.username"><strong>{{
                                                notification.data.candidate.name
                                            }}</strong></a>
                                        applied for a job
                                        <a :href="'/job/'+notification.data.job.id">
                                            <span class="colored">{{ notification.data.job.title }}</span>
                                        </a>
                                        <span v-if="notification.read_at == null" class="unread">
                                            <i class="fa fa-circle"></i>
                                        </span>
                                    </li>
                                </ul>
                                <p v-else class="text-center">Keine Benachrichtigungen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="user-dashboard" v-if="user.type == 3">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>Willkommen, {{ user.name }}</h3>
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
                                        <h3 class="text-left">Erhöhen Sie Ihre Chancen um:</h3>
                                        <ul class="complete-profile-list">
                                            <li v-if="user.complete.profile > 5">
                                                <a href="/profile">Vervollständigen Sie Ihre Angaben</a>
                                            </li>
                                            <li v-if="user.complete.portfolio">
                                                <a href="/profile/portfolio">Attraktive Galerie erstellen</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
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
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item ui-green">
                            <div class="left">
                                <i class="icon la la-bookmark-o"></i>
                            </div>
                            <div class="right">
                                <h4>{{ user.shortlists.length }}</h4>
                                <p>Auswahllisten</p>
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
                if (res.data == 0) {
                    window.location.href = "/login"
                }
                console.log(res.data)
                this.user = res.data.user
                this.suggestedJobs = res.data.suggestedJobs
                this.notifications = res.data.notifications
                this.unreadNotifications = res.data.unread
                this.loading.staticComponents = false
            })
            .then(() => {
                if (this.user.type == 2) {
                    axios.get("/request/profile/mark-notifications-as-read")
                        .then((res) => {
                            console.log(res.data)
                        })
                }
            })

        if (localStorage.getItem('locale')) {
            this.$lang.setLocale(localStorage.getItem('locale'));
        } else {
            this.$lang.setLocale('en');
        }
    },
    data: function () {
        return {
            user: "",
            suggestedJobs: [],
            notifications: [],
            unreadNotifications: null,
            loading: {
                staticComponents: true
            }
        }
    },
    methods: {
        setLang(l) {
            if (l == 'ar')
                document.getElementsByTagName('body')[0].classList.add('rtl')
            else
                document.getElementsByTagName('body')[0].classList.remove('rtl')
            localStorage.setItem('locale', l)
            this.$lang.setLocale(l)
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
.unread {
    margin: 0 5px;
    color: #d50e0e;
}
</style>
