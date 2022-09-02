<template>
    <div>
        <!-- Banner Section-->
        <section class="banner-section-nine" style="background-image: url(assets/images/hero.png);">
            <div class="over"></div>
            <div class="auto-container">
                <div class="cotnent-box">

                    <!-- Job Search Form -->
                    <div class="job-search-form wow fadeInUp" data-wow-delay='600ms'>
                        <form method="post" action="/">
                            <div class="row">
                                <!-- Form Group -->
                                <div class="form-group col-lg-3 col-md-12 col-sm-12">
                                    <label>What job are you looking for?</label>
                                    <span class="icon flaticon-search-1"></span>
                                    <input type="text"
                                           v-model="search.title"
                                           placeholder="Search Word...">
                                </div>

                                <!-- Form Group -->
                                <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
                                    <label>Where?</label>
                                    <span class="icon flaticon-map-locator"></span>
                                    <input type="text"
                                           @keydown.space.prevent
                                           @keyup="getCities()"
                                           v-model="city"
                                           placeholder="City or postcode">
                                    <ul class="suggestions" v-if="suggestions.cities.length">
                                        <li v-for="city in suggestions.cities" :key="city.id">
                                            <button type="button"
                                                    @click="selectCity(city)">
                                                {{ city.name }} {{ city.zip ? '(' + city.zip + ')' : '' }}
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Form Group -->
                                <div class="form-group col-lg-3 col-md-12 col-sm-12 category">
                                    <label>Categories</label>
                                    <span class="icon flaticon-briefcase"></span>
                                    <select class="chosen-select" v-model="search.category_id">
                                        <option value="">All Categories</option>
                                        <option v-for="category in categories"
                                                :key="category.id"
                                                :value="category.id">{{ category.name }}
                                        </option>
                                    </select>
                                </div>

                                <!-- Form Group -->
                                <div class="form-group col-lg-3 col-md-12 col-sm-12 category">
                                    <label>Type</label>
                                    <span class="icon flaticon-briefcase"></span>
                                    <select class="chosen-select" v-model="search.type">
                                        <option value="">Search Type</option>
                                        <option value="job">Job</option>
                                        <option value="candidate">Candidate</option>
                                        <option value="business">Local Business</option>
                                    </select>
                                </div>

                                <!-- Form Group -->
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 mt-4"
                                     style="text-align: center !important;">
                                    <button type="button" @click="explore()" class="theme-btn btn-style-two p-2">
                                        Explore
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Job Search Form -->

                    <!-- Fun Fact Section -->
                    <!--                    <div class="fun-fact-section">-->
                    <!--                        <div class="row">-->
                    <!--                            &lt;!&ndash;Column&ndash;&gt;-->
                    <!--                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp">-->
                    <!--                                <div class="count-box">-->
                    <!--                                    <span class="count-text" data-speed="3000" data-stop="97216">0</span>-->
                    <!--                                </div>-->
                    <!--                                <h4 class="counter-title">Jobs</h4>-->
                    <!--                            </div>-->

                    <!--                            &lt;!&ndash;Column&ndash;&gt;-->
                    <!--                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">-->
                    <!--                                <div class="count-box">-->
                    <!--                                    <span class="count-text" data-speed="3000" data-stop="4782">0</span>-->
                    <!--                                </div>-->
                    <!--                                <h4 class="counter-title">Members</h4>-->
                    <!--                            </div>-->

                    <!--                            &lt;!&ndash;Column&ndash;&gt;-->
                    <!--                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">-->
                    <!--                                <div class="count-box">-->
                    <!--                                    <span class="count-text" data-speed="3000" data-stop="5322">0</span>-->
                    <!--                                </div>-->
                    <!--                                <h4 class="counter-title">Business</h4>-->
                    <!--                            </div>-->

                    <!--                            &lt;!&ndash;Column&ndash;&gt;-->
                    <!--                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="1200ms">-->
                    <!--                                <div class="count-box">-->
                    <!--                                    <span class="count-text" data-speed="3000" data-stop="6329">0</span>-->
                    <!--                                </div>-->
                    <!--                                <h4 class="counter-title">Company</h4>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!-- Fun Fact Section -->
                </div>
            </div>
        </section>
        <!-- End Banner Section-->

        <!-- Services -->
        <section class="process-section pt-0" style="margin-top: 60px;">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <h2>Our Services</h2>
                    <div class="text">Discover our creative services</div>
                </div>

                <div class="row wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                    <!-- Process Block -->
                    <div class="process-block col-lg-4 col-md-6 col-sm-12">
                        <div class="icon-box"><img src="assets/images/process-1.png" alt=""></div>
                        <h4>Register an account <br>to start</h4>
                    </div>

                    <!-- Process Block -->
                    <div class="process-block col-lg-4 col-md-6 col-sm-12">
                        <div class="icon-box"><img src="assets/images/process-2.png" alt=""></div>
                        <h4>Explore over thousands <br>of resumes</h4>
                    </div>

                    <!-- Process Block -->
                    <div class="process-block col-lg-4 col-md-6 col-sm-12">
                        <div class="icon-box"><img src="assets/images/process-3.png" alt=""></div>
                        <h4>Find the most suitable <br>candidate</h4>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Services -->

        <!-- About Section -->
        <section class="about-section-two style-two">
            <div class="auto-container">
                <div class="row ">
                    <!-- Content Column -->
                    <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                        <div class="inner-column wow fadeInLeft animated"
                             style="visibility: visible; animation-name: fadeInLeft;">
                            <div class="sec-title">
                                <h2>Get applications from the <br>world best talents.</h2>
                                <div class="text">Search all the open positions on the web. Get your own personalized
                                    salary estimate. Read reviews on over 600,000 companies worldwide.
                                </div>
                            </div>
                            <ul class="list-style-one">
                                <li>Bring to the table win-win survival</li>
                                <li>Capitalize on low hanging fruit to identify</li>
                                <li>But I must explain to you how all this</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="image-column col-lg-6 col-md-12 col-sm-12 wow fadeInRight animated"
                         style="visibility: visible; animation-name: fadeInRight;">
                        <figure class="image-box"><img src="/assets/images/about.jpg" alt=""></figure>

                        <!-- Count Employers -->

                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section -->

        <!-- News Section -->
        <section class="news-section">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <h2>Latest Posts</h2>
                </div>

                <div class="row wow fadeInUp">

                    <!-- News Block -->
                    <div class="news-block col-lg-4 col-md-6 col-sm-12" v-for="(post, index) in posts" :key="index">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <img :src="post._embedded['wp:featuredmedia']['0'].source_url" />
                                </figure>
                            </div>
                            <div class="lower-content">
                                <ul class="post-meta">
                                    <li>{{ post.date }}</li>
                                </ul>
                                <h3><a :href="post.link">{{ post.title.rendered }}</a></h3>
                                <p class="text" v-html="post.excerpt.rendered"></p>
                                <a :href="post.link" class="read-more">Read More</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End News Section -->

        <!-- FAQ Section -->
        <section class="about-section-two style-two">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <h2>FAQ</h2>
                </div>
                <div class="row ">
                    <!-- Content Column -->
                    <div class="content-column col-12">
                        <ul class="accordion-box">
                            <!--Block-->
                            <li class="accordion block"
                                @click="faqTrigger($event)"
                                v-for="(fq, index) in faq"
                                :key="index"
                            >
                                <div class="acc-btn">
                                    {{ fq.question }}
<!--                                    <span class="icon flaticon-add"></span>-->
                                </div>
                                <div class="acc-content">
                                    <div class="content">
                                        <p>{{ fq.answer }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- End FAQ Section -->

        <!-- Call To Action Three -->
        <section class="call-to-action-three style-two">
            <div class="auto-container wow fadeInUp">
                <div class="outer-box">
                    <div class="sec-title light">
                        <h2>Gat a question?</h2>
                        <div class="text">We're here to help. Check out our FAQs, send us an email or call us at 1
                            <br><a href="#">(900) 777-7777.</a></div>
                    </div>

                    <div class="btn-box">
                        <a href="#" class="theme-btn btn-style-three">Get Started</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Call To Action -->

    </div>
</template>

<script>
export default {
    mounted() {
        document.getElementsByClassName('dashboard')[0].classList.remove('dashboard')
        document.getElementsByClassName('main-header')[0].classList.remove('header-shaddow')
        document.title = "Bahloul - Home"
        axios.get("/request/get-all-categories")
            .then((res) => {
                this.categories = res.data
            })
        axios.get("/request/front/home/get-faq")
        .then((response) => {
            this.faq = response.data
        })
        // axios.get("/blog/wp-json/wp/v2/posts?_embed&per_page=3&order=desc")
        //     .then((res) => {
        //         this.posts = res.data
        //     })
    },
    data: function () {
        return {
            categories: [],
            suggestions: {
                cities: []
            },
            city: "",
            search: {
                title: "",
                city_id: "",
                category_id: "",
                type: "",
            },
            posts: [],
            faq: {}
        }
    },
    methods: {
        getCities() {
            this.search.city_id = ""
            if (this.city == '')
                this.suggestions.cities = []
            if (this.city != null && this.city != '') {
                axios.get("/request/front/home/get-cities/" + this.city)
                    .then((res) => {
                        // console.log(res.data)
                        if (res.data.length > 0)
                            this.suggestions.cities = res.data
                        else {
                            this.suggestions.cities = []
                            this.suggestions.cities.push({name: "No Data Found."})
                            console.log(this.suggestions.cities)
                        }
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            }
        },
        selectCity(city) {
            this.search.city_id = city.id
            this.city = city.name
            this.suggestions.cities = []
        },
        explore() {
            let type = this.search.type,
                title = this.search.title,
                category_id = this.search.category_id,
                city_id = this.search.city_id

            if (type == "") {
                return
            }
            if (type == "job")
                window.location.href = "/jobs?title=" + title + "&category_id=" + category_id + "&city_id=" + city_id
            else if (type == "candidate")
                window.location.href = "/resumes?name=" + title + "&category_id=" + category_id + "&city_id=" + city_id
            else if (type == "business")
                window.location.href = "/local-businesses?title=" + title + "&category_id=" + category_id + "&city_id=" + city_id
        },
        faqTrigger(e) {
            // console.log(e)
            // console.log(e.target.nextElementSibling)
            let btns = document.getElementsByClassName('acc-btn')
            let cont = document.getElementsByClassName('acc-content')
            let acc = document.getElementsByClassName('accordion')
            let i = 0, j = 0, k = 0
            for (i; i < btns.length; i++) {
                btns[i].classList.remove('active')
            }
            for (j; j < cont.length; j++) {
                cont[j].classList.remove('current')
            }
            for (k; k < cont.length; k++) {
                acc[k].classList.remove('active-block')
            }
            e.target.nextElementSibling.classList.add('current')
            e.target.classList.add('active')
        }
    }
}
</script>

<style scoped>
.bg-gray {
    background: gray;
}

ul.suggestions {
    position: absolute;
    background: #fff;
    width: 100%;
    border: 1px solid #ccc;
    margin-left: -15px;
    margin-top: 10px;
    padding: 10px;
    z-index: 999999;
    border-radius: 5px;
    font-size: 14px;
}

ul.suggestions li {
    margin: 5px 0;
}
</style>
