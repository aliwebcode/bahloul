<template>
    <div>
        <!--Page Title-->
        <section class="page-title">
            <div class="auto-container">
                <div class="title-outer">
                    <h1>Find Local Businesses</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li>Local Businesses</li>
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
                        <form action="">
                            <div class="inner-column">
                                <div class="filters-outer">
                                    <button type="button" class="theme-btn close-filters">X</button>

                                    <!-- Filter Block -->
                                    <div class="filter-block">
                                        <h4>Search by Keywords</h4>
                                        <div class="form-group">
                                            <input type="text"
                                                   v-model="settings.title"
                                                   @keyup="filterData"
                                                   placeholder="Business, keywords, or company">
                                            <span class="icon flaticon-search-3"></span>
                                        </div>
                                    </div>

                                    <!-- Filter Block -->
                                    <div class="filter-block">
                                        <h4>Location</h4>
                                        <div class="form-group">
                                            <input type="text"
                                                   placeholder="Country, City or postcode"
                                                   v-model="settings.location"
                                                   @keyup="filterData">
                                            <span class="icon flaticon-map-locator"></span>
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
                        </form>
                    </div>

                    <!-- Content Column -->
                    <div class="content-column col-lg-8 col-md-12 col-sm-12">
                        <div class="ls-outer">
                            <button type="button" class="theme-btn btn-style-two toggle-filters">Show Filters</button>
                            <!-- ls Switcher -->
                            <div class="ls-switcher">
                                <div class="showing-result">
                                    <div class="text" v-if="businesses.length > 0">
                                        Showing {{ showingNumber }} of {{ businesses.length }} Businesses
                                    </div>
                                </div>
                                <div class="sort-by">
                                    <select class="chosen-select"
                                            v-model="showingNumber"
                                            @change="showingNumber > businesses.length ? showingNumber = businesses.length : ''">
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
                                <li v-if="settings.date">
                                    <button type="button">
                                        Date: {{ settings.date > 1 ? 'Last ' + settings.date + ' Days' : 'Last 24 Hours' }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.date = '',filterData()"></span>
                                    </button>
                                </li>
                            </ul>

                            <div class="jobs-loading" v-if="resultsLoading">
                                <i class="fas fa-spinner fa-pulse fa-lg"></i>
                            </div>

                            <div class="text-center" v-if="businesses.length == 0 && !resultsLoading">
                                <p>No Results, Try to change search settings.</p>
                            </div>

                            <!-- Job Block -->
                            <div class="job-block" v-for="bus in showingData" :key="bus.id">
                                <div class="inner-box">
                                    <div class="content">
                                        <span class="company-logo">
                                            <img :src="'/images/users/' + bus.image"
                                                 style="border-radius: 50%">
                                        </span>
                                        <h4>
                                            <a :href="'/u/' + bus.username">
                                                {{ bus.name }}<span v-if="bus.b_name">, {{ bus.b_name }}</span>
                                            </a>
                                        </h4>
                                        <ul class="job-info">
                                            <li v-if="bus.category">
                                                <span class="icon flaticon-briefcase"></span>
                                                {{ bus.category.name }}
                                            </li>
                                            <li v-if="bus.country">
                                                <span class="icon flaticon-map-locator"></span>
                                                {{ bus.city.name }}, {{ bus.country.name }}
                                            </li>
                                            <li>
                                                <span class="icon flaticon-clock-3"></span>
                                                {{ bus.time }}
                                            </li>
                                        </ul>
                                        <button class="bookmark-btn">
                                            <span class="flaticon-bookmark"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Listing Show More -->
                            <div class="ls-show-more" v-if="businesses.length > 0">
                                <p>Showing {{ showingNumber }} of {{ businesses.length }} Businesses</p>
                                <div class="bar">
                                    <span class="bar-inner"
                                          :style="'width: ' + showingNumber/businesses.length * 100 + '%'"></span>
                                </div>
                                <button class="show-more"
                                        v-if="businesses.length > showingNumber"
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
        axios.get("/request/front/get-businesses")
            .then((res) => {
                if(res.data.businesses.length < 5)
                    this.showingNumber = res.data.businesses.length
                this.businesses = res.data.businesses
                this.showingJobs = this.businesses.slice(0, this.showingNumber)
                this.categories = res.data.categories
                this.resultsLoading = false
            })
    },
    data: function () {
        return {
            businesses: [],
            categories: [],
            settings: {
                category_id: "",
                location: "",
                title: "",
                date: ""
            },
            resultsLoading: true,
            showingNumber: 5
        }
    },
    methods: {
        filterData: function () {
            this.resultsLoading = true
            this.businesses = []
            axios.post("/request/front/business-filter", {
                data: this.settings
            })
                .then((res) => {
                    console.log(res.data)
                    if(res.data.length > 5) {
                        this.showingNumber = 5
                    } else {
                        this.showingNumber = res.data.length
                    }
                    this.businesses = res.data
                    this.resultsLoading = false
                })
        },
        showMore: function () {
            let diff = this.businesses.length - this.showingNumber
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
        }
    },
    computed: {
        showingData: function () {
            return this.businesses.slice(0, this.showingNumber)
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