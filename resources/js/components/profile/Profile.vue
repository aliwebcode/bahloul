<template>
    <div>
        <section v-if="user.type == 1" class="user-dashboard">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>My Profile</h3>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>My Information</h4>
                                </div>

                                <div class="widget-content">

                                    <div class="uploading-outer">
                                        <div class="uploadButton">
                                            <form action="">
                                                <input
                                                    class="uploadButton-input"
                                                    type="file"
                                                    ref="file"
                                                    @change="uploadImage($event),showSaveBtn = true"
                                                    id="upload"/>
                                            </form>
                                            <label class="uploadButton-button ripple-effect" for="upload">
                                                Browse Image
                                            </label>
                                            <span class="uploadButton-file-name"></span>
                                        </div>
                                        <div class="text">Max file size is 1MB, Minimum dimension: 330x300 And Suitable
                                            files are .jpg & .png
                                        </div>
                                    </div>

                                    <div class="preview view-personal-image" v-if="previewImage || user.image">
                                        <img :src="previewImage" v-if="previewImage">
                                        <img :src="'/images/users/' + user.image" v-else>
                                    </div>

                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Full Name</label>
                                                <input type="text"
                                                       name="name"
                                                       v-model="user.name"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Job Title</label>
                                                <input type="text"
                                                       name="job_title"
                                                       v-model="user.job_title"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Phone</label>
                                                <input type="text"
                                                       name="phone"
                                                       v-model="user.phone"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Job Category</label>
                                                <select class="chosen-select"
                                                        v-model="user.category_id"
                                                        @change="showSaveBtn = true">
                                                    <option v-for="category in categories"
                                                            :value="category.id"
                                                            :selected="user.category_id === category.id">
                                                        {{ category.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Website</label>
                                                <input type="text"
                                                       name="website"
                                                       v-model="user.website"
                                                       @keydown="showSaveBtn = true">
                                            </div>


                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Birthday Date</label>
                                                <input type="date" v-model="user.birthday" @change="showSaveBtn = true">
                                            </div>


                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Languages</label>
                                                <v-select :options="languages"
                                                          v-model="user.lang"
                                                          @input="setLanguages"
                                                          multiple></v-select>
                                            </div>


                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Experience (years)</label>
                                                <select class="chosen-select"
                                                        v-model="user.experience"
                                                        @change="showSaveBtn = true">
                                                    <option value="0-2">0 to 2 (Years)</option>
                                                    <option value="3-5">3 to 5 (Years)</option>
                                                    <option value="6-8">6 to 8 (Years)</option>
                                                    <option value="+9">+9 (Years)</option>
                                                </select>
                                            </div>


                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Education Level</label>
                                                <select class="chosen-select"
                                                        v-model="user.education"
                                                        @change="showSaveBtn = true">
                                                    <option value="Primary">Primary</option>
                                                    <option value="Secondary">Secondary</option>
                                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                                    <option value="Diploma">Diploma</option>
                                                    <option value="Master's Degree">Master's Degree</option>
                                                    <option value="Phd Degree">Phd Degree</option>
                                                </select>

                                            </div>

                                            <!-- Search Select -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Skills</label>
                                                <v-select :options="skills"
                                                          v-model="user.skill"
                                                          @input="setSkills"
                                                          multiple></v-select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Allow In Search & Listing</label>
                                                <select class="chosen-select"
                                                        v-model="user.status"
                                                        @change="showSaveBtn = true">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <!-- About Company -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>About me</label>
                                                <textarea
                                                    name="description"
                                                    @keydown="showSaveBtn = true"
                                                    v-model="user.description"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="widget-loading" v-if="loading">
                                    <i class="fa fa-spin fa-spinner"></i>
                                </div>

                            </div>
                        </div>

                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Social Network</h4>
                                </div>

                                <div class="widget-content">
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Facebook</label>
                                                <input type="text"
                                                       name="facebook"
                                                       v-model="user.facebook"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Twitter</label>
                                                <input type="text"
                                                       name="twitter"
                                                       v-model="user.twitter"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Linkedin</label>
                                                <input type="text"
                                                       name="linkedin"
                                                       v-model="user.linkedin"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Instagram</label>
                                                <input type="text"
                                                       placeholder=""
                                                       v-model="user.instagram"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="widget-loading" v-if="loading">
                                    <i class="fa fa-spin fa-spinner"></i>
                                </div>

                            </div>
                        </div>

                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Contact Information</h4>
                                </div>

                                <div class="widget-content">
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Country</label>
                                                <select class="chosen-select"
                                                        v-model="user.country_id"
                                                        @change="selectCities('input'), showSaveBtn = true">
                                                    <option v-for="country in countries"
                                                            :selected="country.id === user.country_id"
                                                            :value="country.id">
                                                        {{ country.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>City</label>
                                                <select class="chosen-select"
                                                        v-model="user.city_id"
                                                        @change="showSaveBtn = true">
                                                    <option v-for="city in selectedCities"
                                                            :selected="city.id === user.city_id"
                                                            :value="city.id">
                                                        {{ city.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Complete Address</label>
                                                <input type="text"
                                                       v-model="user.address"
                                                       @keydown="showSaveBtn = true">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="widget-loading" v-if="loading">
                                    <i class="fa fa-spin fa-spinner"></i>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <section v-if="user.type == 2" class="user-dashboard">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>My Profile</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>My Information</h4>
                                </div>

                                <div class="widget-content">

                                    <div class="uploading-outer">
                                        <div class="uploadButton">
                                            <input
                                                class="uploadButton-input"
                                                type="file"
                                                id="upload"
                                                @change="uploadImage($event),showSaveBtn = true"/>
                                            <label class="uploadButton-button ripple-effect" for="upload">
                                                Browse Image
                                            </label>
                                            <span class="uploadButton-file-name"></span>
                                        </div>
                                        <div class="text">
                                            Max file size is 1MB, Minimum dimension: 330x300 And Suitable
                                            files are .jpg & .png
                                        </div>
                                    </div>
                                    <div class="preview view-personal-image" v-if="previewImage || user.image">
                                        <img :src="previewImage" v-if="previewImage">
                                        <img :src="'/images/users/' + user.image" v-else>
                                    </div>

                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Company name</label>
                                                <input type="text"
                                                       v-model="user.name"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Company email</label>
                                                <input type="email"
                                                       v-model="user.company_email"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Phone</label>
                                                <input type="text"
                                                       v-model="user.phone"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Website</label>
                                                <input type="text"
                                                       v-model="user.website"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Founded In (year)</label>
                                                <input type="number"
                                                       v-model="user.founded_in"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Team Size</label>
                                                <select class="chosen-select"
                                                        v-model="user.company_size"
                                                        @change="showSaveBtn = true">
                                                    <option>50 - 100</option>
                                                    <option>100 - 150</option>
                                                    <option>200 - 250</option>
                                                    <option>300 - 350</option>
                                                    <option>500 - 1000</option>
                                                </select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Allow In Search & Listing</label>
                                                <select class="chosen-select"
                                                        v-model="user.status"
                                                        @change="showSaveBtn = true">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <!-- About Company -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>About Company</label>
                                                <textarea
                                                    v-model="user.description"
                                                    @keydown="showSaveBtn = true"></textarea>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="widget-loading" v-if="loading">
                                    <i class="fa fa-spin fa-spinner"></i>
                                </div>

                            </div>
                        </div>

                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Social Network</h4>
                                </div>

                                <div class="widget-content">
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Facebook</label>
                                                <input type="text"
                                                       placeholder=""
                                                       v-model="user.facebook"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Twitter</label>
                                                <input type="text"
                                                       placeholder=""
                                                       v-model="user.twitter"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Linkedin</label>
                                                <input type="text"
                                                       placeholder=""
                                                       v-model="user.linkedin"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Instagram</label>
                                                <input type="text"
                                                       placeholder=""
                                                       v-model="user.instagram"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="widget-loading" v-if="loading">
                                    <i class="fa fa-spin fa-spinner"></i>
                                </div>

                            </div>
                        </div>

                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Contact Information</h4>
                                </div>

                                <div class="widget-content">
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Country</label>
                                                <select class="chosen-select"
                                                        v-model="user.country_id"
                                                        @change="selectCities('input'), showSaveBtn = true">
                                                    <option v-for="country in countries"
                                                            :selected="country.id === user.country_id"
                                                            :value="country.id">
                                                        {{ country.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>City</label>
                                                <select class="chosen-select"
                                                        v-model="user.city_id"
                                                        @change="showSaveBtn = true">
                                                    <option v-for="city in selectedCities"
                                                            :selected="city.id === user.city_id"
                                                            :value="city.id">
                                                        {{ city.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Complete Address</label>
                                                <input type="text"
                                                       v-model="user.address"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Postal Code</label>
                                                <input type="text"
                                                       v-model="user.zip"
                                                       @keydown="showSaveBtn = true">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="widget-loading" v-if="loading">
                                    <i class="fa fa-spin fa-spinner"></i>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </section>
        <section v-if="user.type == 3" class="user-dashboard">
            <div class="dashboard-outer">
                <div class="upper-title-box">
                    <h3>My Profile</h3>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>My Information</h4>
                                </div>

                                <div class="widget-content">
                                    <h6 style="font-size: 15px;line-height: 20px;color: #202124;font-weight: 500;margin-bottom: 10px;">Profile Image</h6>
                                    <div class="uploading-outer">
                                        <div class="uploadButton">
                                            <form action="">
                                                <input
                                                    class="uploadButton-input"
                                                    type="file"
                                                    @change="uploadImage($event),showSaveBtn = true"
                                                    id="upload"/>
                                            </form>
                                            <label class="uploadButton-button ripple-effect" for="upload">
                                                Browse Image
                                            </label>
                                            <span class="uploadButton-file-name"></span>
                                        </div>
                                        <div class="text">Max file size is 1MB, Minimum dimension: 330x300 And Suitable
                                            files are .jpg & .png
                                        </div>
                                    </div>
                                    <div class="preview view-personal-image" v-if="previewImage || user.image">
                                        <img :src="previewImage" v-if="previewImage">
                                        <img :src="'/images/users/' + user.image" v-else>
                                    </div>
                                    <h6 style="font-size: 15px;line-height: 20px;color: #202124;font-weight: 500;margin-bottom: 10px;">
                                        Profile Cover
                                    </h6>
                                    <div class="uploading-outer">
                                        <div class="uploadButton">
                                            <form action="">
                                                <input
                                                    class="uploadButton-input"
                                                    type="file"
                                                    @change="uploadCover($event),showSaveBtn = true"
                                                    id="up"/>
                                            </form>
                                            <label class="uploadButton-button ripple-effect" for="up">
                                                Browse Image
                                            </label>
                                            <span class="uploadButton-file-name"></span>
                                        </div>
                                        <div class="text">Max file size is 1MB, Minimum dimension: 330x300 And Suitable
                                            files are .jpg & .png
                                        </div>
                                    </div>

                                    <div class="preview view-personal-image cover-preview" v-if="previewCover || user.cover">
                                        <img :src="previewCover" v-if="previewCover">
                                        <img :src="'/images/covers/' + user.cover" v-else>
                                    </div>

                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Full Name</label>
                                                <input type="text"
                                                       name="name"
                                                       v-model="user.name"
                                                       @keydown="showSaveBtn = true">
                                            </div>
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Business Name</label>
                                                <input type="text"
                                                       name="name"
                                                       v-model="user.b_name"
                                                       @keydown="showSaveBtn = true">
                                            </div>
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Business Email</label>
                                                <input type="text"
                                                       name="name"
                                                       v-model="user.b_email"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Phone</label>
                                                <input type="text"
                                                       name="phone"
                                                       v-model="user.phone"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Job Category</label>
                                                <select class="chosen-select"
                                                        v-model="user.category_id"
                                                        @change="showSaveBtn = true">
                                                    <option v-for="category in categories"
                                                            :value="category.id"
                                                            :selected="user.category_id === category.id">
                                                        {{ category.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Website</label>
                                                <input type="text"
                                                       name="website"
                                                       v-model="user.website"
                                                       @keydown="showSaveBtn = true">
                                            </div>


                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Birthday Date</label>
                                                <input type="date" v-model="user.birthday" @change="showSaveBtn = true">
                                            </div>


                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Languages</label>
                                                <v-select :options="languages"
                                                          v-model="user.lang"
                                                          @input="setLanguages"
                                                          multiple></v-select>
                                            </div>


                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Experience (years)</label>
                                                <select class="chosen-select"
                                                        v-model="user.experience"
                                                        @change="showSaveBtn = true">
                                                    <option value="0-2">0 to 2 (Years)</option>
                                                    <option value="3-5">3 to 5 (Years)</option>
                                                    <option value="6-8">6 to 8 (Years)</option>
                                                    <option value="+9">+9 (Years)</option>
                                                </select>
                                            </div>


                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Education Level</label>
                                                <select class="chosen-select"
                                                        v-model="user.education"
                                                        @change="showSaveBtn = true">
                                                    <option value="Primary">Primary</option>
                                                    <option value="Secondary">Secondary</option>
                                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                                    <option value="Diploma">Diploma</option>
                                                    <option value="Master's Degree">Master's Degree</option>
                                                    <option value="Phd Degree">Phd Degree</option>
                                                </select>

                                            </div>

                                            <!-- Search Select -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Skills</label>
                                                <v-select :options="skills"
                                                          v-model="user.skill"
                                                          @input="setSkills"
                                                          multiple></v-select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Allow In Search & Listing</label>
                                                <select class="chosen-select"
                                                        v-model="user.status"
                                                        @change="showSaveBtn = true">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <!-- About Company -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>About me</label>
                                                <textarea
                                                    name="description"
                                                    @keydown="showSaveBtn = true"
                                                    v-model="user.description"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="widget-loading" v-if="loading">
                                    <img src="/assets/images/loading.gif">
                                </div>

                            </div>
                        </div>

                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Social Network</h4>
                                </div>

                                <div class="widget-content">
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Facebook</label>
                                                <input type="text"
                                                       name="facebook"
                                                       v-model="user.facebook"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Twitter</label>
                                                <input type="text"
                                                       name="twitter"
                                                       v-model="user.twitter"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Linkedin</label>
                                                <input type="text"
                                                       name="linkedin"
                                                       v-model="user.linkedin"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Instagram</label>
                                                <input type="text"
                                                       placeholder=""
                                                       v-model="user.instagram"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="widget-loading" v-if="loading">
                                    <img src="/assets/images/loading.gif">
                                </div>

                            </div>
                        </div>

                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Contact Information</h4>
                                </div>

                                <div class="widget-content">
                                    <form class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Country</label>
                                                <select class="chosen-select"
                                                        v-model="user.country_id"
                                                        @change="selectCities('input'), showSaveBtn = true">
                                                    <option v-for="country in countries"
                                                            :selected="country.id === user.country_id"
                                                            :value="country.id">
                                                        {{ country.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>City</label>
                                                <select class="chosen-select"
                                                        v-model="user.city_id"
                                                        @change="showSaveBtn = true">
                                                    <option v-for="city in selectedCities"
                                                            :selected="city.id === user.city_id"
                                                            :value="city.id">
                                                        {{ city.name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Complete Address</label>
                                                <input type="text"
                                                       v-model="user.address"
                                                       @keydown="showSaveBtn = true">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Postal Code</label>
                                                <input type="text"
                                                       v-model="user.zip"
                                                       @keydown="showSaveBtn = true">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="widget-loading" v-if="loading">
                                    <img src="/assets/images/loading.gif">
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- Save Button -->
        <div class="float-btn" v-if="showSaveBtn">
            <button class="theme-btn btn-style-seven"
                    :class="{'bg-gray':btnLoading}"
                    @click="saveChanges"
                    type="button"
                    id="saveBtn">
                <span v-if="!btnLoading">Save</span>
                <i class="fas fa-spinner fa-pulse fa-lg" v-if="btnLoading"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        document.title = "Dashboard - Profile"
        // Get User
        axios.get('/request/profile/get-user-profile')
            .then((res) => {
                if(res.data == 0) {
                    window.location.href= "/login"
                }
                this.user = res.data.user
                this.categories = res.data.categories
                this.countries = res.data.countries
                this.cities = res.data.cities
                // Trigger Cities
                this.selectCities()
                this.loading = false
            })
            .catch((err) => {
                console.log(err)
            })
    },
    data: function () {
        return {
            user: "",
            showSaveBtn: false,
            categories: [],
            countries: [],
            cities: [],
            selectedCities: [],
            previewImage: "",
            previewCover: "",
            newImage: "",
            newCover: "",
            btnLoading: false,
            skills: [
                'PHP',
                'Python',
                'CSS',
                'Java',
                'Algorithm',
                'Laravel',
                'React',
                'Vue',
                'Photoshop',
                'XD',
            ],
            languages: [
                'English',
                'Arabic',
                'Germany',
            ],
            loading: true
        }
    },
    methods: {
        saveChanges: function () {
            let btn = document.getElementById('saveBtn')
            btn.setAttribute('disabled', '')
            this.btnLoading = true

            const fd = new FormData();
            Object.entries(this.user).forEach(([key, value]) => {
                fd.append(key, value);
            });
            fd.append('image', this.newImage)
            fd.append('cover', this.newCover)

            axios({
                method: "post",
                url: "/request/profile/update-profile",
                data: fd,
                headers: {"Content-Type": "multipart/form-data"},
            })
                .then((res) => {
                    // console.log(res.data)
                    this.btnLoading = false
                    if (res.data === 1) {
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
                            title: 'Saved successfully'
                        })
                        this.showSaveBtn = false
                        if (this.previewImage)
                            document.getElementsByClassName('thumb')[0].setAttribute('src', this.previewImage)
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
        },
        uploadImage: function (e) {
            this.previewImage = URL.createObjectURL(e.target.files[0])
            this.newImage = e.target.files[0]
        },
        uploadCover: function (e) {
            this.previewCover = URL.createObjectURL(e.target.files[0])
            this.newCover = e.target.files[0]
        },
        selectCities: function (i) {
            let user_country = this.user.country_id
            this.selectedCities = this.cities.filter(function (c) {
                if (c.country_id === user_country) {
                    return true;
                }
                return false; // skip
            }).map(function (c) {
                return c;
            });

            if (i && i === 'input') {
                this.user.city_id = this.selectedCities[0].id
            }

            // console.log(this.selectedCities)
        },
        setSkills: function () {
            this.user.skills = this.user.skill.join()
            this.showSaveBtn = true
        },
        setLanguages: function () {
            this.user.languages = this.user.lang.join()
            this.showSaveBtn = true
        }
    }
}
</script>

<style>
.float-btn {
    position: fixed;
    right: 25px;
    bottom: 25px;
    z-index: 9999;
}

.float-btn button {
    font-size: 18px;
}

.view-personal-image {
    text-align: center;
    margin-bottom: 60px;
}

.view-personal-image img {
    width: 200px !important;
    height: 200px !important;
}

.vs__dropdown-toggle {
    position: relative;
    width: 100%;
    line-height: 30px;
    padding: 15px 20px !important;
    font-size: 15px;
    color: #696969;
    background: #F0F5F7 !important;
    border: 1px solid #F0F5F7 !important;
    box-sizing: border-box !important;
    border-radius: 8px !important;
    transition: all 300ms ease;
}
.cover-preview img {
    width: 100% !important;
    height: auto !important;
}
</style>
