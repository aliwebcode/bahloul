@extends('front.layouts.app')

{{--@include('front.partials.sidebar')--}}

@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>My Profile</h3>
                <div class="text">Ready to jump back in?</div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>My Profile</h4>
                            </div>

                            <div class="widget-content">

                                <div class="uploading-outer">
                                    <div class="uploadButton">
                                        <input class="uploadButton-input" type="file"  name="attachments[]" accept="image/*, application/pdf" id="upload" multiple/>
                                        <label class="uploadButton-button ripple-effect" for="upload">Browse Logo</label>
                                        <span class="uploadButton-file-name"></span>
                                    </div>
                                    <div class="text">Max file size is 1MB, Minimum dimension: 330x300 And Suitable files are .jpg & .png</div>
                                </div>

                                <form class="default-form">
                                    <div class="row">
                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Full Name</label>
                                            <input type="text" name="name" value="{{ $user->name ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Job Title</label>
                                            <input type="text" name="job_title" value="{{ $user->job_title ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="{{ $user->phone ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Email address</label>
                                            <input type="email" name="email" value="{{ $user->email ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Website</label>
                                            <input type="text" name="website" value="{{ $user->website ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Experience</label>
                                            <input type="text" name="experience" value="{{ $user->experience ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Age</label>
                                            <select class="chosen-select" name="age">
                                                <option>23 - 27 Years</option>
                                                <option>24 - 28 Years</option>
                                                <option>25 - 29 Years</option>
                                                <option>26 - 30 Years</option>
                                            </select>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Education Levels</label>
                                            <input type="text" name="education" value="{{ $user->education ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Languages</label>
                                            <input type="text" name="languages" value="{{ $user->languages ?? '' }}">
                                        </div>

                                        <!-- Search Select -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Skills</label>
                                            <select data-placeholder="Skills" name="skills" class="chosen-select multiple" multiple tabindex="4">
                                                <option value="Banking">Banking</option>
                                                <option value="Digital&Creative">Digital & Creative</option>
                                                <option value="Retail">Retail</option>
                                                <option value="Human Resources">Human Resources</option>
                                                <option value="Management">Management</option>
                                            </select>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Allow In Search & Listing</label>
                                            <select class="chosen-select" name="status">
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>

                                        <!-- About Company -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Description</label>
                                            <textarea name="description">{{ $user->description ?? '' }}</textarea>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <button class="theme-btn btn-style-one">Save</button>
                                        </div>
                                    </div>
                                </form>
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
                                            <input type="text" name="facebook" value="{{ $user->facebook ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Twitter</label>
                                            <input type="text" name="twitter" value="{{ $user->twitter ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Linkedin</label>
                                            <input type="text" name="linkedin" value="{{ $user->linkedin ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-md-12">
                                            <button class="theme-btn btn-style-one">Save</button>
                                        </div>
                                    </div>
                                </form>
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
                                            <select class="chosen-select" name="country">
                                                <option>Australia</option>
                                                <option>Pakistan</option>
                                                <option>Chaina</option>
                                                <option>Japan</option>
                                                <option>India</option>
                                            </select>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>City</label>
                                            <select class="chosen-select" name="city">
                                                <option>Melbourne</option>
                                                <option>Pakistan</option>
                                                <option>Chaina</option>
                                                <option>Japan</option>
                                                <option>India</option>
                                            </select>
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <label>Complete Address</label>
                                            <input type="text" name="address" value="{{ $user->address ?? '' }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-12 col-md-12">
                                            <button class="theme-btn btn-style-one">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </section>
    <!-- End Dashboard -->
@endsection
