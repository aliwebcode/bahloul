@extends('front.layouts.app')

@section('style')
    <style>
        #add-education {
            display: none;
        }
        .modal {
            max-width: 100% !important;
            height: 100%;
        }
    </style>
@endsection
@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>My Resume</h3>
                <div class="text">Ready to jump back in?</div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>CV</h4>
                            </div>

                            <div class="widget-content">
                                <form class="default-form">
                                    <div class="row">
                                        <div class="uploading-outer">
                                            <div class="uploadButton">
                                                <input class="uploadButton-input" type="file" name="attachments[]"
                                                       accept="application/pdf" id="upload" multiple/>
                                                <label class="uploadButton-button ripple-effect" for="upload">Browse
                                                    CV</label>
                                                <span class="uploadButton-file-name"></span>
                                            </div>
                                            <div class="text">Max file size is 1MB, Minimum dimension: 330x300 And
                                                Suitable files are .jpg & .png
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <!-- Resume / Education -->
                                            <div class="resume-outer">
                                                <div class="upper-title">
                                                    <h4>Education</h4>
                                                    <button class="add-info-btn"
                                                            type="button"
                                                            id="addEducationBtn">
                                                        <span class="icon flaticon-plus"></span>
                                                        Add Education
                                                    </button>
                                                </div>
                                            @forelse($user->user_education as $edu)
                                                <!-- Resume BLock -->
                                                    <div class="resume-block">
                                                        <div class="inner">
                                                            <span class="name"></span>
                                                            <div class="title-box">
                                                                <div class="info-box">
                                                                    <h3>{{ $edu->certificate  }}
                                                                        in {{ $edu->field  }}</h3>
                                                                    <span>{{ $edu->college  }}</span>
                                                                </div>
                                                                <div class="edit-box">
                                                                    <span
                                                                        class="year">{{ $edu->start_year  }} {{ $edu->end_year ? '- '.$edu->end_year : ''  }}</span>
                                                                    <div class="edit-btns">
                                                                        <button data-toggle="modal"
                                                                                onclick="editModal({{ $edu->id }})"
                                                                                data-target="#edit-education-model">
                                                                            <span class="la la-pencil"></span>
                                                                        </button>
                                                                        <button><span class="la la-trash"></span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text">{{ $edu->description  }}</div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="p-2">
                                                        <p>No Education added.</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <!-- Add Education -->
                                            <div class="row" id="add-education">
                                                <div class="col-12" style="margin-bottom: 20px">
                                                    <h4>Add new education</h4>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>College Name</label>
                                                    <input type="text"
                                                           class="form-control" name="college" id="college" required>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Certificate</label>
                                                    <input type="text"
                                                           class="form-control" name="certificate" id="certificate"
                                                           required>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Field</label>
                                                    <input type="text"
                                                           class="form-control" name="field" id="field" required>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Start Year</label>
                                                    <input type="number"
                                                           class="form-control" name="start_year" id="start_year"
                                                           required>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>End Year <small>(Let the field empty if you still
                                                            studying)</small></label>
                                                    <input type="number"
                                                           class="form-control" name="end_year" id="end_year">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label>Description</label>
                                                    <textarea class="form-control" name="description" id="description" cols="30"
                                                              rows="10" required></textarea>
                                                </div>
                                                <div class="form-group col-6">
                                                    <p id="edu-empty-msg" class="alert alert-danger" style="display:none;">Please fill required fields</p>
                                                    <input type="button" onclick="saveEducation()" value="Save"
                                                           class="btn btn-primary">
                                                    <input type="button" onclick="$('#add-education').hide()"
                                                           value="Cancel"
                                                           class="btn btn-light">
                                                </div>
                                            </div>

                                            <!-- Resume / Work & Experience -->
                                            <div class="resume-outer theme-blue">
                                                <div class="upper-title">
                                                    <h4>Work & Experience</h4>
                                                    <button class="add-info-btn"><span
                                                            class="icon flaticon-plus"></span> Add Work
                                                    </button>
                                                </div>
                                                <!-- Resume BLock -->
                                                <div class="resume-block">
                                                    <div class="inner">
                                                        <span class="name">S</span>
                                                        <div class="title-box">
                                                            <div class="info-box">
                                                                <h3>Product Designer</h3>
                                                                <span>Spotify Inc.</span>
                                                            </div>
                                                            <div class="edit-box">
                                                                <span class="year">2012 - 2014</span>
                                                                <div class="edit-btns">
                                                                    <button><span class="la la-pencil"></span></button>
                                                                    <button><span class="la la-trash"></span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit. Proin a ipsum tellus. Interdum et malesuada
                                                            fames ac ante<br> ipsum primis in faucibus.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Resume BLock -->
                                                <div class="resume-block">
                                                    <div class="inner">
                                                        <span class="name">D</span>
                                                        <div class="title-box">
                                                            <div class="info-box">
                                                                <h3>Sr UX Engineer</h3>
                                                                <span>Dropbox Inc.</span>
                                                            </div>
                                                            <div class="edit-box">
                                                                <span class="year">2012 - 2014</span>
                                                                <div class="edit-btns">
                                                                    <button><span class="la la-pencil"></span></button>
                                                                    <button><span class="la la-trash"></span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit. Proin a ipsum tellus. Interdum et malesuada
                                                            fames ac ante<br> ipsum primis in faucibus.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <div class="uploading-outer">
                                                <div class="uploadButton">
                                                    <input class="uploadButton-input" type="file" name="attachments[]"
                                                           accept="image/*, application/pdf" id="upload" multiple/>
                                                    <label class="uploadButton-button ripple-effect" for="upload">Add
                                                        Portfolio</label>
                                                    <span class="uploadButton-file-name"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-12">
                                            <!-- Resume / Awards -->
                                            <div class="resume-outer theme-yellow">
                                                <div class="upper-title">
                                                    <h4>Awards</h4>
                                                    <button class="add-info-btn"><span
                                                            class="icon flaticon-plus"></span> Awards
                                                    </button>
                                                </div>
                                                <!-- Resume BLock -->
                                                <div class="resume-block">
                                                    <div class="inner">
                                                        <span class="name"></span>
                                                        <div class="title-box">
                                                            <div class="info-box">
                                                                <h3>Perfect Attendance Programs</h3>
                                                                <span></span>
                                                            </div>
                                                            <div class="edit-box">
                                                                <span class="year">2012 - 2014</span>
                                                                <div class="edit-btns">
                                                                    <button><span class="la la-pencil"></span></button>
                                                                    <button><span class="la la-trash"></span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit. Proin a ipsum tellus. Interdum et malesuada
                                                            fames ac ante<br> ipsum primis in faucibus.
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Resume BLock -->
                                                <div class="resume-block">
                                                    <div class="inner">
                                                        <span class="name"></span>
                                                        <div class="title-box">
                                                            <div class="info-box">
                                                                <h3>Top Performer Recognition</h3>
                                                                <span></span>
                                                            </div>
                                                            <div class="edit-box">
                                                                <span class="year">2012 - 2014</span>
                                                                <div class="edit-btns">
                                                                    <button><span class="la la-pencil"></span></button>
                                                                    <button><span class="la la-trash"></span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text">Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit. Proin a ipsum tellus. Interdum et malesuada
                                                            fames ac ante<br> ipsum primis in faucibus.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Search Select -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Skills </label>
                                            <select data-placeholder="Categories" class="chosen-select multiple"
                                                    multiple tabindex="4">
                                                <option value="Banking">Banking</option>
                                                <option value="Digital&Creative">Digital & Creative</option>
                                                <option value="Retail">Retail</option>
                                                <option value="Human Resources">Human Resources</option>
                                                <option value="Management">Management</option>
                                            </select>
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

    <div class="modal fade text-left" id="edit-education-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel18">Edit Education</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                @csrf
                                <input type="hidden" name="edu_id" value="">
                                <div class="form-group">
                                    <label>College Name</label>
                                    <input type="text"
                                           class="form-control" name="college" required>
                                </div>
                                <div class="form-group">
                                    <label>Certificate</label>
                                    <input type="text"
                                           class="form-control" name="certificate"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Field</label>
                                    <input type="text"
                                           class="form-control" name="field" required>
                                </div>
                                <div class="form-group">
                                    <label>Start Year</label>
                                    <input type="number"
                                           class="form-control" name="start_year"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>End Year <small>(Let the field empty if you still
                                            studying)</small></label>
                                    <input type="number"
                                           class="form-control" name="end_year">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" cols="30"
                                              rows="10" required></textarea>
                                    <p id="edu-empty-msg-modal" class="alert alert-danger mt-2" style="display:none;">Please fill required fields</p>
                                    <p id="edu-success-msg-modal" class="alert alert-success mt-2" style="display:none;">Edited successfully! changes will appear after reloading the page.</p>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn btn-success" onclick="updateModal()">
                                Save
                            </button>
                            <button type="submit" class="btn grey btn-outline-secondary" data-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

@endsection
@push('script')
    <script>
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('#addEducationBtn').click(function () {
            $('#add-education input[type="text"],#add-education input[type="number"],#add-education textarea').val('');
            $('#add-education').css('display', 'flex');
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#add-education").offset().top
            }, 1000);
        });
        let saveEducation = function () {
            let college = $('#college').val(),
                certificate = $('#certificate').val(),
                field = $('#field').val(),
                start_year = $('#start_year').val(),
                end_year = $('#end_year').val(),
                description = $('#description').val();
            if (
                college == '' || certificate == '' ||
                field == '' || start_year == '' ||
                description == ''
            ) {
                $('#edu-empty-msg').show();
                return 0;
            } else {
                $('#edu-empty-msg').hide();
            }
            let data = {
                college: college,
                certificate: certificate,
                field: field,
                start_year: start_year,
                end_year: end_year,
                description: description
            }
            $.ajax({
                url: '/education/add',
                type: 'POST',
                data: {_token: CSRF_TOKEN, data: data},
                dataType: 'JSON',
                success: function (response) {
                    $('.resume-outer').append('<div class="resume-block"><div class="inner"><span class="name"></span><div class="title-box"><div class="info-box"><h3>' + data.certificate + ' in ' + data.field + '</h3><span>' + data.college + '</span></div><div class="edit-box"><span class="year">' + data.start_year + ' - ' + data.end_year + '</span><div class="edit-btns"><button><span class="la la-pencil"></span></button><button><span class="la la-trash"></span></button></div></div></div><div class="text">' + data.description + '</div></div></div>');
                    $('#add-education').hide();
                }
            });
        };

        let editModal = function (id) {
            $.ajax({
                url: '/education/get-data/' + id,
                type: 'get',
                dataType: 'JSON',
                success: function (res) {
                    $('#edit-education-model form input[name="edu_id"]').val(res.id);
                    $('#edit-education-model form input[name="college"]').val(res.college);
                    $('#edit-education-model form input[name="certificate"]').val(res.certificate);
                    $('#edit-education-model form input[name="field"]').val(res.field);
                    $('#edit-education-model form input[name="start_year"]').val(res.start_year);
                    $('#edit-education-model form input[name="end_year"]').val(res.end_year);
                    $('#edit-education-model form textarea').text(res.description);
                }
            });
        };

        let updateModal = function () {
            let id = $('#edit-education-model form input[name="edu_id"]').val();
            if(id != '') {
                let data = {
                    edu_id: id,
                    college: $('#edit-education-model form input[name="college"]').val(),
                    certificate: $('#edit-education-model form input[name="certificate"]').val(),
                    field: $('#edit-education-model form input[name="field"]').val(),
                    start_year: $('#edit-education-model form input[name="start_year"]').val(),
                    end_year: $('#edit-education-model form input[name="end_year"]').val(),
                    description: $('#edit-education-model form textarea').val()
                }
                if(data.college == '' || data.certificate == '' || data.field == '' ||
                data.start_year == '' || data.description == '') {
                    $('#edu-empty-msg-modal').show();
                    return  0;
                } else {
                    $('#edu-empty-msg-modal').hide();
                }
                $.ajax({
                    url: '/education/update',
                    data: {_token: CSRF_TOKEN, data: data},
                    type: 'post',
                    dataType: 'JSON',
                    success: function (res) {
                        $('#edu-success-msg-modal').show();
                    }
                });
            }
        };

    </script>
@endpush
