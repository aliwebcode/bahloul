<template>
    <div>
        <!--Page Title-->
        <section class="page-title">
            <div class="auto-container">
                <div class="title-outer">
                    <h1>Find Jobs</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li>Jobs</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->

        <!-- Listing Section -->
        <section class="ls-section">
            <div class="auto-container">
                <div class="filters-backdrop"></div>
                <div class="row">
                    <!-- Filters Column -->
                    <div class="filters-column col-lg-4 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="filters-outer">
                                <button type="button" class="theme-btn close-filters">X</button>

                                <!-- Filter Block -->
                                <div class="filter-block">
                                    <h4>Search by Keywords</h4>
                                    <div class="form-group">
                                        <input type="text"
                                               v-model="settings.title"
                                               @keyup="searchTimeOut()"
                                               placeholder="Job title, keywords, or company">
                                        <span class="icon flaticon-search-3"></span>
                                    </div>
                                </div>

                                <!-- Filter Block -->
                                <div class="filter-block">
                                    <h4>Category</h4>
                                    <div class="form-group">
                                        <select class="chosen-select"
                                                v-model="settings.category_id"
                                                @change="filterData">
                                            <option value="" selected>All</option>
                                            <option v-for="category in categories" :value="category.id">
                                                {{ category.name }}
                                            </option>
                                        </select>
                                        <span class="icon flaticon-briefcase"></span>
                                    </div>
                                </div>

                                <!-- Filter Block -->
                                <div class="filter-block">
                                    <h4>Country</h4>
                                    <div class="form-group">
                                        <select class="chosen-select"
                                                v-model="settings.country_id"
                                                @change="getCities(),settings.city_id='',filterData()">
                                            <option value="" selected>All</option>
                                            <option v-for="country in countries" :value="country.id">
                                                {{ country.name }}
                                            </option>
                                        </select>
                                        <span class="icon flaticon-map-locator"></span>
                                    </div>
                                </div>

                                <!-- Filter Block -->
                                <div class="filter-block" v-if="settings.country_id">
                                    <h4>City</h4>
                                    <div class="form-group">
                                        <select class="chosen-select"
                                                v-model="settings.city_id"
                                                @change="filterData">
                                            <option value="" selected>All</option>
                                            <option v-for="city in cities" :value="city.id">
                                                {{ city.name }}
                                            </option>
                                        </select>
                                        <span class="icon flaticon-map-locator"></span>
                                    </div>
                                </div>

                                <!-- Switchbox Outer -->
                                <div class="switchbox-outer">
                                    <h4>Job type</h4>
                                    <ul class="switchbox">
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.type"
                                                       name="type"
                                                       value=""
                                                       checked
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">All</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.type"
                                                       name="type"
                                                       value="Freelance"
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">Freelance</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.type"
                                                       name="type"
                                                       value="Full Time"
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">Full Time</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.type"
                                                       name="type"
                                                       value="Internship"
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">Internship</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.type"
                                                       name="type"
                                                       value="Part Time"
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">Part Time</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.type"
                                                       name="type"
                                                       value="Temporary"
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">Temporary</span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Checkboxes Ouer -->
                                <div class="switchbox-outer">
                                    <h4>Date Posted</h4>
                                    <ul class="switchbox">
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.date"
                                                       name="date"
                                                       value=""
                                                       checked
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">All</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.date"
                                                       name="date"
                                                       value="1"
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">Last 24 Hours</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.date"
                                                       name="date"
                                                       value="7"
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">Last 7 Days</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.date"
                                                       name="date"
                                                       value="14"
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">Last 14 Days</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="switch">
                                                <input type="radio"
                                                       v-model="settings.date"
                                                       name="date"
                                                       value="30"
                                                       @change="filterData()">
                                                <span class="slider round"></span>
                                                <span class="title">Last 30 Days</span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Content Column -->
                    <div class="content-column col-lg-8 col-md-12 col-sm-12">
                        <div class="ls-outer">
                            <button type="button" class="theme-btn btn-style-two toggle-filters">Show Filters</button>
                            <!-- ls Switcher -->
                            <div class="ls-switcher">
                                <div class="showing-result">
                                    <div class="text" v-if="count > 0">
                                        <strong>{{ count }} Results</strong>
                                    </div>
                                </div>
                                <div class="sort-by">
                                    <select class="chosen-select"
                                            v-model="showingNumber"
                                            @change="filterData('num')">
                                        <option value="5">Show 5</option>
                                        <option value="10">Show 10</option>
                                        <option value="20">Show 20</option>
                                        <option value="30">Show 30</option>
                                        <option value="40">Show 40</option>
                                        <option value="50">Show 50</option>
                                        <option value="60">Show 60</option>
                                    </select>
                                </div>
                            </div>
                            <ul class="tags-style-one">
                                <li v-if="settings.title">
                                    <button type="button">
                                        Keyword: {{ settings.title }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.title = '',filterData()"></span>
                                    </button>
                                </li>
                                <li v-if="settings.location">
                                    <button type="button">
                                        Location: {{ settings.location }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.location = '',filterData()"></span>
                                    </button>
                                </li>
                                <li v-if="settings.category_id">
                                    <button type="button">
                                        Category: {{ getCategory(settings.category_id).name }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.category_id = '',filterData()"></span>
                                    </button>
                                </li>
                                <li v-if="settings.type">
                                    <button type="button">
                                        Job Type: {{ settings.type }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.type = '',filterData()"></span>
                                    </button>
                                </li>
                                <li v-if="settings.date">
                                    <button type="button">
                                        Date: {{ settings.date > 1 ? 'Last ' + settings.date + ' Days' : 'Last 24 Hours' }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.date = '',filterData()"></span>
                                    </button>
                                </li>
                            </ul>

                            <div class="jobs-loading" v-if="jobsLoading">
                                <i class="fas fa-spinner fa-pulse fa-lg"></i>
                            </div>

                            <div class="text-center" v-if="jobs.data.length == 0 && jobsLoading == false">
                                <p>No Results, Try to change search settings.</p>
                            </div>

                            <!-- Job Block -->
                            <div class="job-block" v-for="job in jobs.data" :key="job.id">
                                <div class="inner-box">
                                    <div class="content">
                                        <span class="company-logo">
                                            <img :src="'/images/users/' + job.user.image"
                                                 style="border-radius: 50%">
                                        </span>
                                        <h4>
                                            <a :href="'job/' + job.id">{{ job.title }}</a>
                                        </h4>
                                        <p style="margin-bottom: 15px;font-size: 14px;">{{ shortText(job.description) }}</p>
                                        <ul class="job-info">
                                            <li>
                                                <a :href="'u/' + job.user.username">
                                                    <span class="icon la la-user"></span>
                                                    {{ job.user.name }}
                                                </a>
                                            </li>
                                            <li>
                                                <span class="icon flaticon-briefcase"></span>
                                                {{ job.category.name }}
                                            </li>
                                            <li v-if="job.country">
                                                <span class="icon flaticon-map-locator"></span>
                                                {{ job.city.name }}, {{ job.country.name }}
                                            </li>
                                            <li v-else>
                                                <span class="icon flaticon-monitor"></span>
                                                Remotely
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
                                            <li class="privacy" v-if="job.show_applicants_num && job.applicants.length > 0">
                                                {{ job.applicants.length + ' Applicants' }}
                                            </li>
                                            <!--                                            <li class="required">Urgent</li>-->
                                        </ul>
                                        <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                                    </div>
                                </div>
                            </div>
                            <pagination align="center" :data="jobs"
                                        @pagination-change-page="list"></pagination>
                            <!-- Listing Show More -->
                            <div class="ls-show-more" v-if="jobs.length > 0">
                                <p>Showing {{ showingNumber }} of {{ jobs.length }} Jobs</p>
                                <div class="bar">
                                    <span class="bar-inner"
                                          :style="'width: ' + showingNumber/jobs.length * 100 + '%'"></span>
                                </div>
                                <button class="show-more"
                                        v-if="jobs.length > showingNumber"
                                        @click="showMore">
                                    Show More
                                </button>
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
        document.getElementsByClassName('dashboard')[0].classList.remove('dashboard')
        document.title = "Jobs"
        if (this.request) this.cancelRequest();
        const request = axios.CancelToken.source();
        this.request = { cancel: request.cancel, msg: "Loading..." };
        let t = this.$route.query
        let params = {
            title: "",
            type: "",
            category_id: "",
            country_id: "",
            city_id: "",
            date: "",
        };
        if(t.title) params.title = t.title;
        if(t.type) params.type = t.type;
        if(t.category_id) params.category_id = t.category_id;
        if(t.country_id) params.country_id = t.country_id;
        if(t.city_id) params.city_id = t.city_id;
        if(t.date) params.date = t.date;
        axios.get("/request/front/get-jobs/?title="+params.title+
            "&country_id="+params.country_id+"" +
            "&city_id="+params.city_id+
            "&category_id="+params.category_id+
            "&date="+params.date+
            "&type="+params.type+
            "&cancelToken="+request.token)
            .then(({data}) => {
                this.jobs = data.jobs
                this.jobsLoading = false
                this.count = data.count
                if(data.categories.length) this.categories = data.categories
                if(data.countries.length) this.countries = data.countries
            }).catch(({response}) => {
                console.error(response)
            })
    },
    data: function () {
        return {
            jobs: {
                data: ""
            },
            categories: [],
            countries: [],
            cities: [],
            settings: {
                type: "",
                category_id: "",
                location: "",
                country_id: "",
                city_id: "",
                title: "",
                date: ""
            },
            jobsLoading: true,
            showingNumber: 5,
            requests: [],
            request: null,
            count: null,
        }
    },
    methods: {
        filterData: function (v) {
            let num
            v == 'num' ? num = this.showingNumber : num = ""
            if (this.request) this.cancelRequest();
            const request = axios.CancelToken.source();
            this.request = { cancel: request.cancel, msg: "Loading..." };
            this.jobsLoading = true
            this.jobs = {}
            axios.get("/request/front/get-jobs?title="+this.settings.title+"&country_id="+this.settings.country_id+"" +
                "&city_id="+this.settings.city_id+
                "&category_id="+this.settings.category_id+
                "&date="+this.settings.date+
                "&type="+this.settings.type+
                "&per_page="+num+
                "&cancelToken="+request.token)
                .then((res) => {
                    // console.log(res.data)
                    // if(res.data.jobs.length > 5) {
                    //     this.showingNumber = 5
                    // } else {
                    //     this.showingNumber = res.data.jobs.length
                    // }
                    this.jobs = res.data.jobs
                    this.jobsLoading = false
                    this.count = res.data.count
                })
        },
        showMore: function () {
            let diff = this.jobs.length - this.showingNumber
            if(diff >= 5)
                this.showingNumber += 5
            else
                this.showingNumber = parseInt(this.showingNumber) +  diff
        },
        getCategory: function (i) {
            return this.categories.find(function (e) {
                if(e.id === i)
                    return e
            })
        },
        getCities: function () {
            axios.get("/request/get-city/" + this.settings.country_id)
            .then((res) => {
                console.log(res.data)
                if(res.data.length) {
                    this.cities = res.data
                    // this.settings.city_id = this.cities[0].id
                }
                else
                    this.settings.city_id = ""
            })
        },
        cancelRequest: function () {
            this.request.cancel();
            this.clearOldRequest("Cancelled");
        },
        clearOldRequest(msg) {
            this.request.msg = msg;
            this.requests.push(this.request);
            this.request = null;
        },
        searchTimeOut() {
            if (this.timer) {
                clearTimeout(this.timer);
                this.timer = null;
            }
            this.timer = setTimeout(() => {
                this.filterData()
            }, 800);
        },
        shortText(string) {
            if(string.length > 60)
                return string.substring(0, 60) + "...";
            else return string
        },
        async list(page = 1) {
            let num
            this.showingNumber > 5 ? num = this.showingNumber : num = ""
            if (this.request) this.cancelRequest();
            const request = axios.CancelToken.source();
            this.request = { cancel: request.cancel, msg: "Loading..." };
            this.jobsLoading = true
            this.jobs = {}
            await axios.get("/request/front/get-jobs/?page="+page+
                "&title="+this.settings.title+
                "&country_id="+this.settings.country_id+"" +
                "&city_id="+this.settings.city_id+
                "&category_id="+this.settings.category_id+
                "&date="+this.settings.date+
                "&type="+this.settings.type+
                "&per_page="+num+
                "&cancelToken="+request.token)
                .then(({data}) => {
                    this.jobs = data.jobs
                    this.jobsLoading = false
                    this.count = data.count
                    if(data.categories.length) this.categories = data.categories
                    console.log(data)
                }).catch(({response}) => {
                    console.error(response)
                })
        }
    },
    computed: {
        showingJobs: function () {
            return this.jobs.slice(0, this.showingNumber)
        }
    }
}
</script>

<style scoped>
.jobs-loading {
    text-align: center;
    font-size: 22px;
}
.sort-by select {
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
    margin: 0 5px;
}
.tags-style-one li button {
    position: relative;
    border-radius: 4px;
    font-size: 14px;
    line-height: 20px;
    padding: 5px 20px;
    background: rgba(25,103,210,.15);
    color: #1967D2;
}
.tags-style-one li button span.icon {
    font-size: 10px;
}
</style>
