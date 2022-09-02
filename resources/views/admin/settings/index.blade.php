@extends('admin.layout.app')
@section('settings', 'active')
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
                    <textarea name="description" class="form-control" cols="30" rows="10">{{ $settings->description }}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
