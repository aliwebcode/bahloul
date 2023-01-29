@extends('admin.layout.app')
@section('services', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">تعديل خدمة</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-right">تعديل خدمة</h6>
            <a href="{{ route('admin.services.index') }}" class="btn btn-primary float-left">رجوع</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.services.update') }}" method="post">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <div class="form-group">
                    <label>الخدمة بالألمانية</label>
                    <input type="text" class="form-control text-left" name="name" value="{{ $service->name }}">
                </div>
                <div class="form-group">
                    <label>الخدمة بالعربية</label>
                    <input type="text" class="form-control" name="name_ar" value="{{ $service->name_ar }}">
                </div>
                <div class="form-group">
                    <label>الخدمة بالانجليزية</label>
                    <input type="text" class="form-control text-left" name="name_en" value="{{ $service->name_en }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="تعديل">
                </div>
            </form>
        </div>
    </div>

@endsection
