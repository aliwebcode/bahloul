@extends('admin.layout.app')
@section('pages', 'active')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">تعديل صفحة</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-right">تعديل صفحة</h6>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-primary float-left">رجوع</a>
        </div>
        <div class="card-body">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            <form action="{{ route('admin.pages.update') }}" method="post">
                @csrf
                <input type="hidden" name="page_id" value="{{ $page->id }}">
                <div class="form-group">
                    <label for="name">اسم الصفحة بالألمانية</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $page->name }}">
                </div>
                <div class="form-group">
                    <label for="name_ar">اسم الصفحة بالعربية</label>
                    <input type="text" class="form-control" name="name_ar" id="name_ar" value="{{ $page->name_ar }}">
                </div>
                <div class="form-group">
                    <label for="name_en">اسم الصفحة بالانجليزية</label>
                    <input type="text" class="form-control" name="name_en" id="name_en" value="{{ $page->name_en }}">
                </div>

                <div class="form-group">
                    <label for="body">محتوى الصفحة بالألمانية</label>
                    <textarea class="form-control summernote" name="body" id="body" cols="30" rows="10">{{ $page->body }}</textarea>
                </div>
                <div class="form-group">
                    <label for="body_ar">محتوى الصفحة بالعربية</label>
                    <textarea class="form-control summernote" name="body_ar" id="body_ar" cols="30" rows="10">{{ $page->body_ar }}</textarea>
                </div>
                <div class="form-group">
                    <label for="body_en">محتوى الصفحة بالانجليزية</label>
                    <textarea class="form-control summernote" name="body_en" id="body_en" cols="30" rows="10">{{ $page->body_en }}</textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="تعديل">
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