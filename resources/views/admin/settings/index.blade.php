@extends('admin.layout.app')
@section('settings', 'active')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الإعدادات</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-right">الإعدادات</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>اسم الموقع</label>
                    <input type="text" name="website_name" class="form-control" value="{{ $settings->website_name }}">
                </div>
                <div class="form-group">
                    <label>الشعار</label>
                    <input type="file" name="logo" class="form-control">
                </div>
                <div class="form-group">
                    <label>وصف الموقع</label>
                    <input type="text" name="description" class="form-control" value="{{ $settings->description }}">
                </div>
                <hr />
                <h5>بيانات التواصل</h5>
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" class="form-control" name="phone" value="{{ $settings->phone }}">
                </div>
                <div class="form-group">
                    <label>رقم الواتساب</label>
                    <input type="text" class="form-control" name="whatsapp" value="{{ $settings->whatsapp }}">
                </div>
                <div class="form-group">
                    <label>حساب فيسبوك</label>
                    <input type="text" class="form-control" name="facebook" value="{{ $settings->facebook }}">
                </div>
                <div class="form-group">
                    <label>حساب تويتر</label>
                    <input type="text" class="form-control" name="twitter" value="{{ $settings->twitter }}">
                </div>
                <div class="form-group">
                    <label>حساب إنستغرام</label>
                    <input type="text" class="form-control" name="instagram" value="{{ $settings->instagram }}">
                </div>
                <div class="form-group">
                    <label>حساب لينكيد إن</label>
                    <input type="text" class="form-control" name="linkedin" value="{{ $settings->linkedin }}">
                </div>
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-right">إعدادات الصفحة الرئيسية</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>صورة قسم (من نحن)</label>
                    <input type="file" name="about_image" class="form-control">
                </div>
                <div class="form-group">
                    <label>قسم من نحن (ألمانية)</label>
                    <textarea name="about_text" class="form-control summernote" cols="30" rows="10">{{ $settings->about_text }}</textarea>
                </div>
                <div class="form-group">
                    <label>قسم من نحن (إنكليزية)</label>
                    <textarea name="about_text_en" class="form-control summernote" cols="30" rows="10">{{ $settings->about_text_en }}</textarea>
                </div>
                <div class="form-group">
                    <label>قسم من نحن (عربية)</label>
                    <textarea name="about_text_ar" class="form-control summernote" cols="30" rows="10">{{ $settings->about_text_ar }}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('.summernote').summernote({
            tabSize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        })
    </script>
@endpush