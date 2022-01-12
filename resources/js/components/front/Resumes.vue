<template>
    <div>
        <!--Page Title-->
        <section class="page-title">
            <div class="auto-container">
                <div class="title-outer">
                    <h1>Showing All Resumes</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li>Resumes</li>
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
                        <div class="inner-column pd-right">
                            <div class="filters-outer">
                                <button type="button" class="theme-btn close-filters">X</button>

                                <!-- Filter Block -->
                                <div class="filter-block">
                                    <h4>Search by Keywords</h4>
                                    <div class="form-group">
                                        <input type="text"
                                               v-model="settings.name"
                                               @keyup="filterData"
                                               placeholder="Candidate Name">
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

                                <!-- Filter Block -->
                                <div class="filter-block">
                                    <h4>Candidate Gender</h4>
                                    <div class="form-group">
                                        <select class="chosen-select"
                                                v-model="settings.gender"
                                                @change="filterData">
                                            <option value="">Both</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <span class="icon flaticon-man"></span>
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

<!--                                &lt;!&ndash; Checkboxes Ouer &ndash;&gt;-->
<!--                                <div class="checkbox-outer">-->
<!--                                    <h4>Experience</h4>-->
<!--                                    <ul class="checkboxes square">-->
<!--                                        <li>-->
<!--                                            <input id="check-l" type="checkbox" name="check">-->
<!--                                            <label for="check-l">0-2 Years</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <input id="check-m" type="checkbox" name="check">-->
<!--                                            <label for="check-m">10-12 Years</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <input id="check-n" type="checkbox" name="check">-->
<!--                                            <label for="check-n">12-16 Years</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <input id="check-o" type="checkbox" name="check">-->
<!--                                            <label for="check-o">16-20 Years</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <input id="check-p" type="checkbox" name="check">-->
<!--                                            <label for="check-p">20-25 Years</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <button class="view-more"><span class="icon flaticon-plus"></span> View More</button>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </div>-->

<!--                                &lt;!&ndash; Checkboxes Ouer &ndash;&gt;-->
<!--                                <div class="checkbox-outer">-->
<!--                                    <h4>Education Levels</h4>-->
<!--                                    <ul class="checkboxes square">-->
<!--                                        <li>-->
<!--                                            <input id="check-a" type="checkbox" name="check">-->
<!--                                            <label for="check-a">Certificate</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <input id="check-b" type="checkbox" name="check">-->
<!--                                            <label for="check-b">Diploma</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <input id="check-c" type="checkbox" name="check">-->
<!--                                            <label for="check-c">Associate Degree</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <input id="check-d" type="checkbox" name="check">-->
<!--                                            <label for="check-d">Bachelor Degree</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <input id="check-e" type="checkbox" name="check">-->
<!--                                            <label for="check-e">Master’s Degree</label>-->
<!--                                        </li>-->
<!--                                        <li>-->
<!--                                            <button class="view-more"><span class="icon flaticon-plus"></span> View More</button>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </div>-->

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
                                    <div class="text" v-if="resumes.length > 0">
                                        Showing {{ showingNumber }} of {{ resumes.length }} Resumes
                                    </div>
                                </div>
                                <div class="sort-by">
                                    <select class="chosen-select"
                                            v-model="showingNumber"
                                            @change="showingNumber > resumes.length ? showingNumber = resumes.length : ''">
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
                                <li v-if="settings.name">
                                    <button type="button">
                                        Keyword: {{ settings.name }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.name = '',filterData()"></span>
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
                                <li v-if="settings.gender">
                                    <button type="button">
                                        Job Type: {{ settings.gender }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.gender = '',filterData()"></span>
                                    </button>
                                </li>
                                <li v-if="settings.date">
                                    <button type="button">
                                        Date: {{ settings.date > 1 ? 'Last ' + settings.date + ' Days' : 'Last 24 Hours' }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.date = '',filterData()"></span>
                                    </button>
                                </li>
                            </ul>

                            <div class="resumes-loading" v-if="resumesLoading">
                                <i class="fas fa-spinner fa-pulse fa-lg"></i>
                            </div>

                            <div class="text-center" v-if="resumes.length == 0 && !resumesLoading">
                                <p>No Results, Try to change search settings.</p>
                            </div>


                            <div class="row">

                                <!-- Candidate block Four -->
                                <div class="candidate-block-four col-lg-6 col-md-6 col-sm-12"
                                     v-for="resume in showingResumes"
                                     :key="resume.id">
                                    <div class="inner-box">
                                        <ul class="job-other-info">
                                            <li title="Completed profile" class="green" v-if="resume.complete.profile < 5 && !resume.complete.edu && !resume.complete.exp && !resume.complete.cv && !resume.complete.portfolio">
                                                Featured
                                            </li>
                                        </ul>
                                        <span class="thumb">
                                            <img :src="'/images/users/' + resume.image" v-if="resume.image">
                                            <img src="/assets/images/default_avatar.png" v-else>
                                        </span>
                                        <h3 class="name">
                                            <a :href="'/u/' + resume.username">{{ resume.name }}</a>
                                        </h3>
                                        <span class="cat" v-if="resume.job_title">{{ resume.job_title }}</span>
                                        <ul class="job-info">
                                            <li v-if="resume.country">
                                                <span class="icon flaticon-map-locator"></span>
                                                {{ resume.city.name }}, {{ resume.country.name }}
                                            </li>
                                            <li v-if="resume.category">
                                                <span class="icon flaticon-briefcase"></span>
                                                {{ resume.category.name }}
                                            </li>
                                        </ul>
                                        <ul class="post-tags" v-if="resume.skill.length">
                                            <li>{{ resume.skill[0] }}</li>
                                            <li>{{ resume.skill[1] }}</li>
                                            <li>{{ resume.skill[2] }}</li>
                                        </ul>
                                        <a :href="'/u/' + resume.username" class="theme-btn btn-style-three">View Profile</a>
                                    </div>
                                </div>

                            </div>

                            <!-- Listing Show More -->
                            <div class="ls-show-more" v-if="resumes.length > 0">
                                <p>Showing {{ showingNumber }} of {{ resumes.length }} Resumes</p>
                                <div class="bar">
                                    <span class="bar-inner"
                                          :style="'width: ' + showingNumber/resumes.length * 100 + '%'"></span>
                                </div>
                                <button class="show-more"
                                        v-if="resumes.length > showingNumber"
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
        document.title = "Resumes"
        axios.get("/request/front/get-resumes")
            .then((res) => {
                // console.log(res.data)
                if(res.data.resumes.length < 5)
                    this.showingNumber = res.data.resumes.length
                this.resumes = res.data.resumes
                this.showingResumes = this.resumes.slice(0, this.showingNumber)
                this.categories = res.data.categories
                this.resumesLoading = false
            })
    },
    data: function () {
        return {
            resumes: [],
            categories: [],
            resumesLoading: true,
            settings: {
                gender: "",
                category_id: "",
                location: "",
                name: "",
                date: ""
            },
            showingNumber: 5
        }
    },
    methods: {
        filterData: function () {
            this.resumesLoading = true
            this.resumes = []
            axios.post("/request/front/resume-filter", {
                data: this.settings
            })
                .then((res) => {
                    console.log(res.data)
                    if(res.data.length > 5) {
                        this.showingNumber = 5
                    } else {
                        this.showingNumber = res.data.length
                    }
                    this.resumes = res.data
                    this.resumesLoading = false
                })
        },
        showMore: function () {
            let diff = this.resumes.length - this.showingNumber
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
        showingResumes: function () {
            return this.resumes.slice(0, this.showingNumber)
        }
    }
}
</script>

<style scoped>
.resumes-loading {
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
