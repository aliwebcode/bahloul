<template>
    <div>
        <!-- Banner Section-->
        <section class="banner-section-nine" style="background-image: url(assets/images/hero.jpg);">
            <div class="over"></div>
            <div class="auto-container">
                <div class="cotnent-box">
                    <div class="title-box wow fadeInUp" data-wow-delay='300ms'>
                        <h3>15,000+ Browse Jobs</h3>
                        <div class="text">Find Jobs, Employment & Career Opportunities</div>
                    </div>

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
                                                {{ city.name }}
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
                                                :value="category.id">{{ category.name }}</option>
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
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 mt-4" style="text-align: center !important;">
                                    <button type="button" @click="explore()" class="theme-btn btn-style-two p-2">Explore</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Job Search Form -->

                    <!-- Fun Fact Section -->
                    <div class="fun-fact-section">
                        <div class="row">
                            <!--Column-->
                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                                <div class="count-box"><span class="count-text" data-speed="3000" data-stop="97216">0</span></div>
                                <h4 class="counter-title">Jobs</h4>
                            </div>

                            <!--Column-->
                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                                <div class="count-box"><span class="count-text" data-speed="3000" data-stop="4782">0</span></div>
                                <h4 class="counter-title">Members</h4>
                            </div>

                            <!--Column-->
                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                                <div class="count-box"><span class="count-text" data-speed="3000" data-stop="5322">0</span></div>
                                <h4 class="counter-title">Resume</h4>
                            </div>

                            <!--Column-->
                            <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="1200ms">
                                <div class="count-box"><span class="count-text" data-speed="3000" data-stop="6329">0</span></div>
                                <h4 class="counter-title">Company</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Fun Fact Section -->
                </div>
            </div>
        </section>
        <!-- End Banner Section-->

        <!-- Job Section -->
        <section class="job-section">
            <div class="auto-container wow fadeInUp">
                <div class="sec-title text-center">
                    <h2>Featured Jobs</h2>
                    <div class="text">Know your worth and find the job that qualify your life</div>
                </div>

                <div class="job-carousel owl-carousel owl-theme default-dots">
                    <!-- Job Block -->
                    <div class="job-block-three">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/2-1.png" alt=""></span>
                                <h4><a href="#">Software Engineer</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="required">Urgent</li>
                            </ul>
                            <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-three">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/2-2.png" alt=""></span>
                                <h4><a href="#">Recruiting Coordinator</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="required">Urgent</li>
                            </ul>
                            <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-three">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/2-3.png" alt=""></span>
                                <h4><a href="#">Product Manager, Studio</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="required">Urgent</li>
                            </ul>
                            <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-three">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/2-4.png" alt=""></span>
                                <h4><a href="#">Senior Product Designer</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="required">Urgent</li>
                            </ul>
                            <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-three">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/2-5.png" alt=""></span>
                                <h4><a href="#">Product Manager, Risk</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="privacy">Private</li>
                            </ul>
                            <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-three">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/2-6.png" alt=""></span>
                                <h4><a href="#">Technical Architect</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="privacy">Private</li>
                            </ul>
                            <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        </div>
                    </div>


                    <!-- Job Block -->
                    <div class="job-block-three">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/2-7.png" alt=""></span>
                                <h4><a href="#">Web Developer</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="required">Urgent</li>
                            </ul>
                            <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-three">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/2-8.png" alt=""></span>
                                <h4><a href="#">Senior Product Designer</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="privacy">Private</li>
                            </ul>
                            <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        </div>
                    </div>

                    <!-- Job Block -->
                    <div class="job-block-three">
                        <div class="inner-box">
                            <div class="content">
                                <span class="company-logo"><img src="images/resource/company-logo/2-9.png" alt=""></span>
                                <h4><a href="#">Senior BI Analyst</a></h4>
                                <ul class="job-info">
                                    <li><span class="icon flaticon-briefcase"></span> Segment</li>
                                    <li><span class="icon flaticon-map-locator"></span> London, UK</li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                <li class="time">Full Time</li>
                                <li class="privacy">Private</li>
                            </ul>
                            <button class="bookmark-btn"><span class="flaticon-bookmark"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Job Section -->

        <!-- steps Section -->
        <section class="steps-section pt-0">
            <div class="auto-container">
                <div class="row">
                    <div class="image-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <figure class="image"><img src="images/resource/steps-img.png" alt=""></figure>
                            <!-- Count Employers -->
                            <div class="count-employers wow fadeInUp">
                                <span class="title">300k+ Employers</span>
                                <figure class="image"><img src="images/resource/multi-peoples.png" alt=""></figure>
                            </div>
                        </div>
                    </div>

                    <div class="content-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column wow fadeInUp">
                            <div class="sec-title">
                                <h2>Find Jobs with 3 easy steps</h2>
                                <div class="text">Sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. Labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</div>
                                <ul class="steps-list">
                                    <li><span class="count">1</span> Register an account to start</li>
                                    <li><span class="count">2</span> Explore over thousands  of resumes</li>
                                    <li><span class="count">3</span> Find the most suitable candidate</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Steps Section -->

        <!-- Call To Action Two -->
        <section class="call-to-action-two" style="background-image: url(images/background/8.png);">
            <div class="auto-container wow fadeInUp">
                <div class="sec-title light text-center">
                    <h2>Make a Difference with Your Online Resume!</h2>
                    <div class="text">Your resume in minutes with JobHunt resume assistant is ready!</div>
                </div>

                <div class="btn-box">
                    <a href="#" class="theme-btn btn-style-three">Create an Account</a>
                </div>
            </div>
        </section>
        <!-- End Call To Action -->

        <!-- Job Categories -->
        <section class="job-categories">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <h2>Popular Job Categories</h2>
                    <div class="text">2020 jobs live - 293 added today.</div>
                </div>

                <div class="row wow fadeInUp">
                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="icon flaticon-money-1"></span>
                                <h4><a href="#">Accounting / Finance</a></h4>
                                <p>(2 open positions)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="icon flaticon-promotion"></span>
                                <h4><a href="#">Marketing</a></h4>
                                <p>86 open positions)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="icon flaticon-vector"></span>
                                <h4><a href="#">Design</a></h4>
                                <p>43 open positions)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="icon flaticon-web-programming"></span>
                                <h4><a href="#">Development</a></h4>
                                <p>(12 open positions)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="icon flaticon-headhunting"></span>
                                <h4><a href="#">Human Resource</a></h4>
                                <p>55 open positions)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="icon flaticon-rocket-ship"></span>
                                <h4><a href="#">Project Management</a></h4>
                                <p>(2 open positions)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="icon flaticon-support-1"></span>
                                <h4><a href="#">Customer Service</a></h4>
                                <p>(2 open positions)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="icon flaticon-first-aid-kit-1"></span>
                                <h4><a href="#">Health and Care</a></h4>
                                <p>(25 open positions)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Category Block -->
                    <div class="category-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="content">
                                <span class="icon flaticon-car"></span>
                                <h4><a href="#">Automotive Jobs</a></h4>
                                <p>92 open positions</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Job Categories -->

        <!-- Candidates Section -->
        <section class="candidates-section pt-0">
            <div class="auto-container">
                <div class="sec-title-outer">
                    <div class="sec-title">
                        <h2>Featured Candidates</h2>
                        <div class="text">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor</div>
                    </div>
                    <a href="#" class="link">Browse All <span class="fa fa-angle-right"></span></a>
                </div>

                <div class="carousel-outer wow fadeInUp">
                    <div class="candidates-carousel owl-carousel owl-theme default-dots">
                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-1.png" alt=""></figure>
                                <h4 class="name">Darlene Robertson</h4>
                                <span class="designation">UI Designer</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-2.png" alt=""></figure>
                                <h4 class="name">Wade Warren</h4>
                                <span class="designation">Developer</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-3.png" alt=""></figure>
                                <h4 class="name">Leslie Alexander</h4>
                                <span class="designation">Marketing Expert</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-4.png" alt=""></figure>
                                <h4 class="name">Floyd Miles</h4>
                                <span class="designation">Charted Accountant</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-1.png" alt=""></figure>
                                <h4 class="name">Darlene Robertson</h4>
                                <span class="designation">UI Designer</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-2.png" alt=""></figure>
                                <h4 class="name">Wade Warren</h4>
                                <span class="designation">Developer</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-3.png" alt=""></figure>
                                <h4 class="name">Leslie Alexander</h4>
                                <span class="designation">Marketing Expert</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-4.png" alt=""></figure>
                                <h4 class="name">Floyd Miles</h4>
                                <span class="designation">Charted Accountant</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-1.png" alt=""></figure>
                                <h4 class="name">Darlene Robertson</h4>
                                <span class="designation">UI Designer</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-2.png" alt=""></figure>
                                <h4 class="name">Wade Warren</h4>
                                <span class="designation">Developer</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-3.png" alt=""></figure>
                                <h4 class="name">Leslie Alexander</h4>
                                <span class="designation">Marketing Expert</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>

                        <!-- Candidate Block -->
                        <div class="candidate-block">
                            <div class="inner-box">
                                <figure class="image"><img src="images/resource/candidate-4.png" alt=""></figure>
                                <h4 class="name">Floyd Miles</h4>
                                <span class="designation">Charted Accountant</span>
                                <div class="location"><i class="flaticon-map-locator"></i> London, UK</div>
                                <a href="#" class="theme-btn btn-style-one"><span class="btn-title">View Profile</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Candidates Section -->

        <!-- Testimonial Section -->
        <section class="testimonial-section style-two alternate" style="background-image: url(images/background/9.png);">
            <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title text-center light">
                    <h2>Testimonials From Our Customers</h2>
                    <div class="text">Lorem ipsum dolor sit amet elit, sed do eiusmod tempor</div>
                </div>

                <div class="carousel-outer wow fadeInUp">

                    <!-- Testimonial Carousel -->
                    <div class="testimonial-carousel-three owl-carousel owl-theme default-dots light">

                        <!--Testimonial Block -->
                        <div class="testimonial-block">
                            <div class="inner-box">
                                <h4 class="title">Good theme</h4>
                                <div class="text">Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite… The Mitech team works really hard to ensure high level of quality</div>
                                <div class="info-box">
                                    <div class="thumb"><img src="images/resource/testi-thumb-1.png" alt=""></div>
                                    <h4 class="name">Nicole Wells</h4>
                                    <span class="designation">Web Developer</span>
                                </div>
                            </div>
                        </div>

                        <!--Testimonial Block -->
                        <div class="testimonial-block">
                            <div class="inner-box">
                                <h4 class="title">Great quality!</h4>
                                <div class="text">Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite… The Mitech team works really hard to ensure high level of quality</div>
                                <div class="info-box">
                                    <div class="thumb"><img src="images/resource/testi-thumb-2.png" alt=""></div>
                                    <h4 class="name">Gabriel Nolan</h4>
                                    <span class="designation">Consultant</span>
                                </div>
                            </div>
                        </div>

                        <!--Testimonial Block -->
                        <div class="testimonial-block">
                            <div class="inner-box">
                                <h4 class="title">Good theme</h4>
                                <div class="text">Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite… The Mitech team works really hard to ensure high level of quality</div>
                                <div class="info-box">
                                    <div class="thumb"><img src="images/resource/testi-thumb-1.png" alt=""></div>
                                    <h4 class="name">Nicole Wells</h4>
                                    <span class="designation">Web Developer</span>
                                </div>
                            </div>
                        </div>

                        <!--Testimonial Block -->
                        <div class="testimonial-block">
                            <div class="inner-box">
                                <h4 class="title">Great quality!</h4>
                                <div class="text">Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite… The Mitech team works really hard to ensure high level of quality</div>
                                <div class="info-box">
                                    <div class="thumb"><img src="images/resource/testi-thumb-2.png" alt=""></div>
                                    <h4 class="name">Gabriel Nolan</h4>
                                    <span class="designation">Consultant</span>
                                </div>
                            </div>
                        </div>

                        <!--Testimonial Block -->
                        <div class="testimonial-block">
                            <div class="inner-box">
                                <h4 class="title">Good theme</h4>
                                <div class="text">Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite… The Mitech team works really hard to ensure high level of quality</div>
                                <div class="info-box">
                                    <div class="thumb"><img src="images/resource/testi-thumb-1.png" alt=""></div>
                                    <h4 class="name">Nicole Wells</h4>
                                    <span class="designation">Web Developer</span>
                                </div>
                            </div>
                        </div>

                        <!--Testimonial Block -->
                        <div class="testimonial-block">
                            <div class="inner-box">
                                <h4 class="title">Great quality!</h4>
                                <div class="text">Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything! Can’t quite… The Mitech team works really hard to ensure high level of quality</div>
                                <div class="info-box">
                                    <div class="thumb"><img src="images/resource/testi-thumb-2.png" alt=""></div>
                                    <h4 class="name">Gabriel Nolan</h4>
                                    <span class="designation">Consultant</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Testimonial Section -->

        <!-- Fun Fact Section -->
        <div class="fun-fact-section style-two">
            <div class="auto-container">
                <div class="row wow fadeInUp">
                    <!--Column-->
                    <div class="counter-column col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="count-box"><span class="count-text" data-speed="3000" data-stop="4">0</span>M</div>
                        <h4 class="counter-title">4 million daily active users</h4>
                    </div>

                    <!--Column-->
                    <div class="counter-column col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                        <div class="count-box"><span class="count-text" data-speed="3000" data-stop="12">0</span>k</div>
                        <h4 class="counter-title">Over 12k open job positions</h4>
                    </div>

                    <!--Column-->
                    <div class="counter-column col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                        <div class="count-box"><span class="count-text" data-speed="3000" data-stop="20">0</span>M</div>
                        <h4 class="counter-title">Over 20 million stories shared</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fun Fact Section -->

        <!-- News Section -->
        <section class="news-section">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <h2>Recent News Articles</h2>
                    <div class="text">Fresh job related news content posted each day.</div>
                </div>

                <div class="row wow fadeInUp">
                    <!-- News Block -->
                    <div class="news-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="images/resource/news-1.jpg" alt="" /></figure>
                            </div>
                            <div class="lower-content">
                                <ul class="post-meta">
                                    <li><a href="#">August 31, 2021</a></li>
                                    <li><a href="#">12 Comment</a></li>
                                </ul>
                                <h3><a href="blog-single.html">Attract Sales And Profits</a></h3>
                                <p class="text">A job ravenously while Far much that one rank beheld after outside....</p>
                                <a href="#" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- News Block -->
                    <div class="news-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="images/resource/news-2.jpg" alt="" /></figure>
                            </div>
                            <div class="lower-content">
                                <ul class="post-meta">
                                    <li><a href="#">August 31, 2021</a></li>
                                    <li><a href="#">12 Comment</a></li>
                                </ul>
                                <h3><a href="blog-single.html">5 Tips For Your Job Interviews</a></h3>
                                <p class="text">A job ravenously while Far much that one rank beheld after outside....</p>
                                <a href="#" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- News Block -->
                    <div class="news-block col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="images/resource/news-3.jpg" alt="" /></figure>
                            </div>
                            <div class="lower-content">
                                <ul class="post-meta">
                                    <li><a href="#">August 31, 2021</a></li>
                                    <li><a href="#">12 Comment</a></li>
                                </ul>
                                <h3><a href="blog-single.html">An Overworked Newspaper Editor</a></h3>
                                <p class="text">A job ravenously while Far much that one rank beheld after outside....</p>
                                <a href="#" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End News Section -->

        <!-- Call To Action Three -->
        <section class="call-to-action-three style-two">
            <div class="auto-container wow fadeInUp">
                <div class="outer-box">
                    <div class="sec-title light">
                        <h2>Gat a question?</h2>
                        <div class="text">We're here to help. Check out our FAQs, send us an email or call us at 1 <br><a href="#">(900) 777-7777.</a></div>
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
        document.title = "Home"
        axios.get("/request/get-all-categories")
        .then((res) => {
            this.categories = res.data
        })
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
            }
        }
    },
    methods: {
        getCities() {
            this.search.city_id = ""
            if(this.city == '')
                this.suggestions.cities = []
            if(this.city != null && this.city != '') {
                axios.get("/request/front/home/get-cities/" + this.city)
                    .then((res) => {
                        // console.log(res.data)
                        if(res.data.length > 0)
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

            if(type == "") {
                return
            }
            if(type == "job")
                window.location.href = "/jobs?title="+title+"&category_id="+category_id+"&city_id="+city_id
            else if(type == "candidate")
                window.location.href = "/resumes?title="+title+"&category_id="+category_id+"&city_id="+city_id
            else if(type == "business")
                window.location.href = "/local-businesses?title="+title+"&category_id="+category_id+"&city_id="+city_id
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
