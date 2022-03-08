<template>
    <div>
        <!--Page Title-->
        <section class="page-title">
            <div class="auto-container">
                <div class="title-outer">
                    <h1>إيجاد أعمال محلية</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="/ar">الرئيسية</a></li>
                        <li>أعمال محلية</li>
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
                                        <h4>كلمة البحث</h4>
                                        <div class="form-group">
                                            <input type="text"
                                                   v-model="settings.title"
                                                   @keyup="filterData"
                                                   placeholder="اسم العمل / النشاط التجاري">
                                            <span class="icon flaticon-search-3"></span>
                                        </div>
                                    </div>

                                    <!-- Filter Block -->
                                    <div class="filter-block">
                                        <h4>البلد</h4>
                                        <div class="form-group">
                                            <select class="chosen-select"
                                                    v-model="settings.country_id"
                                                    @change="getCities(),settings.city_id='',filterData()">
                                                <option value="" selected>الكل</option>
                                                <option v-for="country in countries" :value="country.id">
                                                    {{ country.name }}
                                                </option>
                                            </select>
                                            <span class="icon flaticon-map-locator"></span>
                                        </div>
                                    </div>

                                    <!-- Filter Block -->
                                    <div class="filter-block" v-if="settings.country_id">
                                        <h4>المدينة</h4>
                                        <div class="form-group">
                                            <select class="chosen-select"
                                                    v-model="settings.city_id"
                                                    @change="filterData">
                                                <option value="" selected>الكل</option>
                                                <option v-for="city in cities" :value="city.id">
                                                    {{ city.name }}
                                                </option>
                                            </select>
                                            <span class="icon flaticon-map-locator"></span>
                                        </div>
                                    </div>

                                    <!-- Filter Block -->
                                    <div class="filter-block">
                                        <h4>التصنيف</h4>
                                        <div class="form-group">
                                            <select class="chosen-select"
                                                    v-model="settings.category_id"
                                                    @change="filterData">
                                                <option value="" selected>الكل</option>
                                                <option v-for="category in categories" :value="category.id">
                                                    {{ category.name_ar }}
                                                </option>
                                            </select>
                                            <span class="icon flaticon-briefcase"></span>
                                        </div>
                                    </div>

                                    <!-- Checkboxes Ouer -->
                                    <div class="switchbox-outer">
                                        <h4>تاريخ النشر</h4>
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
                                                    <span class="title">الكل</span>
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
                                                    <span class="title">آخر 24 ساعة</span>
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
                                                    <span class="title">آخر 7 أيام</span>
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
                                                    <span class="title">آخر 14 يوم</span>
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
                                                    <span class="title">آخر 30 يوم</span>
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
                            <button type="button" class="theme-btn btn-style-two toggle-filters">عرض التصفية</button>
                            <!-- ls Switcher -->
                            <div class="ls-switcher">
                                <div class="showing-result">
                                    <div class="text" v-if="count > 0">
                                        <strong>{{ count }} نتيجة</strong>
                                    </div>
                                </div>
                                <div class="sort-by">
                                    <select class="chosen-select"
                                            v-model="showingNumber"
                                            @change="filterData('num')">
                                        <option value="5">عرض 5</option>
                                        <option value="10">عرض 10</option>
                                        <option value="20">عرض 20</option>
                                        <option value="30">عرض 30</option>
                                        <option value="40">عرض 40</option>
                                        <option value="50">عرض 50</option>
                                        <option value="60">عرض 60</option>
                                    </select>
                                </div>
                            </div>
                            <ul class="tags-style-one">
                                <li v-if="settings.title">
                                    <button type="button">
                                        كلمة البحث: {{ settings.title }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.title = '',filterData()"></span>
                                    </button>
                                </li>
                                <li v-if="settings.country_id">
                                    <button type="button">
                                        البلد: {{ settings.country_id }}
                                        <span class="icon flaticon-close-1 ml-2"
                                              @click="settings.country_id = '',filterData()"></span>
                                    </button>
                                </li>
                                <li v-if="settings.category_id">
                                    <button type="button">
                                        التصنيف: {{ getCategory(settings.category_id).name }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.category_id = '',filterData()"></span>
                                    </button>
                                </li>
                                <li v-if="settings.date">
                                    <button type="button">
                                        التاريخ: {{ settings.date > 1 ? 'آخر ' + settings.date + ' يوم' : 'آخر 24 ساعة' }}
                                        <span class="icon flaticon-close-1 ml-2" @click="settings.date = '',filterData()"></span>
                                    </button>
                                </li>
                            </ul>

                            <div class="jobs-loading" v-if="loading">
                                <img src="/assets/images/loading.gif">
                            </div>

                            <div class="text-center" v-if="businesses.data.length == 0 && !loading">
                                <p>لايوجد نتائج, حاول تغيير خيارات البحث.</p>
                            </div>

                            <!-- Job Block -->
                            <div class="job-block" v-for="bus in businesses.data" :key="bus.id">
                                <div class="inner-box">
                                    <div class="content">
                                        <span class="company-logo">
                                            <img v-if="bus.image" :src="'/images/users/' + bus.image"
                                                 style="border-radius: 50%">
                                            <img src="/assets/images/default_avatar.png" v-else>
                                        </span>
                                        <h4>
                                            <a :href="'/ar/u/' + bus.username">
                                                {{ bus.name }}<span v-if="bus.b_name">, {{ bus.b_name }}</span>
                                            </a>
                                        </h4>
                                        <ul class="job-info">
                                            <li v-if="bus.category">
                                                <span class="icon flaticon-briefcase"></span>
                                                {{ bus.category.name_ar }}
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
                                        <button class="bookmark-btn" @click="saveShortlist(bus.id)">
                                            <span class="flaticon-bookmark"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <pagination align="center" :data="businesses"
                                        @pagination-change-page="list"></pagination>

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
        document.title = "بهلول - الأعمال المحلية"
        // axios.get("/request/front/get-businesses")
        //     .then((res) => {
        //         if(res.data.businesses.length < 5)
        //             this.showingNumber = res.data.businesses.length
        //         this.businesses = res.data.businesses
        //         this.showingJobs = this.businesses.slice(0, this.showingNumber)
        //         this.categories = res.data.categories
        //         this.resultsLoading = false
        //     })
        if (this.request) this.cancelRequest();
        const request = axios.CancelToken.source();
        this.request = {cancel: request.cancel, msg: "Loading..."};
        let t = this.$route.query
        let params = {
            title: "",
            category_id: "",
            country_id: "",
            city_id: "",
            date: "",
        };
        if (t.title) params.title = t.title;
        if (t.category_id) params.category_id = t.category_id;
        if (t.country_id) params.country_id = t.country_id;
        if (t.city_id) params.city_id = t.city_id;
        if (t.date) params.date = t.date;
        axios.get("/request/front/get-businesses/?title=" + params.title +
            "&country_id=" + params.country_id + "" +
            "&city_id=" + params.city_id +
            "&category_id=" + params.category_id +
            "&date=" + params.date +
            "&cancelToken=" + request.token)
            .then(({data}) => {
                this.businesses = data.businesses
                this.count = data.count
                this.loading = false
                if (data.categories.length) this.categories = data.categories
                if (data.countries.length) this.countries = data.countries
            }).catch(({response}) => {
            console.error(response)
        })
    },
    data: function () {
        return {
            businesses: [],
            categories: [],
            settings: {
                category_id: "",
                country_id: "",
                city_id: "",
                title: "",
                date: ""
            },
            resultsLoading: true,
            showingNumber: 5,
            requests: [],
            request: null,
            count: null,
            loading: true
        }
    },
    methods: {
        filterData: function (v) {
            this.loading = true
            let num
            v == 'num' ? num = this.showingNumber : num = ""
            if (this.request) this.cancelRequest();
            const request = axios.CancelToken.source();
            this.request = {cancel: request.cancel, msg: "Loading..."};
            this.businesses = {}
            axios.get("/request/front/get-businesses/?title=" + this.settings.title +
                "&country_id=" + this.settings.country_id + "" +
                "&city_id=" + this.settings.city_id +
                "&category_id=" + this.settings.category_id +
                "&date=" + this.settings.date +
                "&per_page="+num+
                "&cancelToken=" + request.token)
                .then(({data}) => {
                    this.businesses = data.businesses
                    this.count = data.count
                    this.loading = false
                }).catch(({response}) => {
                console.error(response)
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
        },
        getCities: function () {
            axios.get("/request/get-city/" + this.settings.country_id)
                .then((res) => {
                    console.log(res.data)
                    if(res.data.length) {
                        this.cities = res.data
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
        async list(page = 1) {
            this.loading = true
            let num
            this.showingNumber > 5 ? num = this.showingNumber : num = ""
            if (this.request) this.cancelRequest();
            const request = axios.CancelToken.source();
            this.request = { cancel: request.cancel, msg: "Loading..." };
            this.resumes = {}
            await axios.get("/request/front/get-businesses/?page="+page+
                "&title="+this.settings.title+
                "&country_id="+this.settings.country_id+"" +
                "&city_id="+this.settings.city_id+
                "&category_id="+this.settings.category_id+
                "&date="+this.settings.date+
                "&per_page="+num+
                "&cancelToken="+request.token)
                .then(({data}) => {
                    this.businesses = data.businesses
                    this.count = data.count
                    if(data.categories.length) this.categories = data.categories
                    this.loading = false
                }).catch(({response}) => {
                    console.error(response)
                })
        },
        saveShortlist: function (id) {
            axios.post("/request/profile/save-shortlist", {
                target_id: id,
                type: "business"
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
                            title: 'تمت الإضافة بنجاح'
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
                            title: 'يرجى تسجيل الدخول'
                        })
                    }
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