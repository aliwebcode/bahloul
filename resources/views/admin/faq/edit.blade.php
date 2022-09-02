@extends('admin.layout.app')
@section('faq', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">تعديل سؤال</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-right">تعديل سؤال</h6>
            <a href="{{ route('admin.faq.index') }}" class="btn btn-primary float-left">رجوع</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.faq.update') }}" method="post">
                @csrf
                <input type="hidden" name="faq_id" value="{{ $faq->id }}">
                <div class="form-group">
                    <label>السؤال بالألمانية</label>
                    <input type="text" class="form-control text-left" name="question" value="{{ $faq->question }}">
                </div>
                <div class="form-group">
                    <label>السؤال بالعربية</label>
                    <input type="text" class="form-control" name="question_ar" value="{{ $faq->question_ar }}">
                </div>
                <div class="form-group">
                    <label>السؤال بالانجليزية</label>
                    <input type="text" class="form-control text-left" name="question_en" value="{{ $faq->question_en }}">
                </div>
                <div class="form-group">
                    <label>الإجابة بالألمانية</label>
                    <textarea name="answer" class="form-control text-left" cols="30" rows="10">{{ $faq->answer }}</textarea>
                </div>
                <div class="form-group">
                    <label>الإجابة بالعربية</label>
                    <textarea name="answer_ar" class="form-control" cols="30" rows="10">{{ $faq->answer_ar }}</textarea>
                </div>
                <div class="form-group">
                    <label>الإجابة بالانجليزية</label>
                    <textarea name="answer_en" class="form-control text-left" cols="30" rows="10">{{ $faq->answer_en }}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="تعديل">
                </div>
            </form>
        </div>
    </div>

@endsection
