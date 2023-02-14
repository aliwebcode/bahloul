@extends('admin.layout.app')
@section('services', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الخدمات</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary float-right">الخدمات</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>الخدمة</th>
                                <th>تاريخ الإضافة</th>
                                <th>خيارات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->created_at->format("Y-m-d") }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.services.edit',$service->id) }}"
                                               class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            <a onclick="del({{ $service->id }})"
                                               data-toggle="modal"
                                               data-target="#deleteModal"
                                               class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="10">لا يوجد خدمات.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($services && $services->count() > 0)
                        {{ $services->links() }}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary float-right">إضافة خدمة</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.services.save') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">اسم الخدمة بالألمانية</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name_ar">اسم الخدمة بالعربية</label>
                            <input type="text" class="form-control" name="name_ar" id="name_ar">
                        </div>
                        <div class="form-group">
                            <label for="name_en">اسم الخدمة بالانجليزية</label>
                            <input type="text" class="form-control" name="name_en" id="name_en">
                        </div>
                        <div class="form-group">
                            <label for="page_id">الصفحة (الرابط)</label>
                            <select class="form-control" name="page_id" id="page_id">
                                @forelse($pages as $page)
                                    <option value="{{ $page->id }}">{{ $page->name }}</option>
                                    @empty
                                    <option value="">لا يوجد صفحات</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="إضافة">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">هل أنت متأكد؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>في حال التأكيد لا يمكنك التراجع.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <form action="{{ route('admin.services.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="0" id="id">
                        <input type="submit" value="حذف" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        let del = function (id) {
            document.getElementById('id').value = id
        }
    </script>
@endpush
