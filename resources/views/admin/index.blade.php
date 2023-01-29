@extends('admin.layout.app')
@section('home', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الرئيسية</h1>
    </div>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                متقدمين
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $candidates_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                شركات
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $companies_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weighborder-left-secondary text-uppercase mb-1">
                                أعمال محلية
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $business_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                                وظائف
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jobs_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bars fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">أحدث المستخدمين</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>البلد</th>
                        <th>حالة الحساب</th>
                        <th>نوع الحساب</th>
                        <th>تاريخ الإنضمام</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            @if($user->image)
                            <img src="{{ asset('images/users/' . $user->image) }}" width="100" height="100">
                            @else
                                <img src="{{ asset('assets/images/default_avatar.png') }}" width="100" height="100">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->country ? $user->country->name : '-' }}</td>
                        <td>
                            @if($user->blocked == 1)
                                <label class="badge badge-danger">محظور</label>
                            @else
                                <label class="badge badge-success">فعال</label>
                            @endif
                        </td>
                        <td>
                            @if($user->type == 1)
                                <label>متقدم</label>
                            @elseif($user->type == 2)
                                <label>شركة</label>
                            @elseif($user->type == 3)
                                <label>عمل محلي</label>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format("Y-m-d") }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">لا يوجد مستخدمين.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
