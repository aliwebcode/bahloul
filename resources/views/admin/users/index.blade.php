@extends('admin.layout.app')
@section('users', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        @if($type == "resume")
            <h1 class="h3 mb-0 text-gray-800">المستخدمين - المستقلين</h1>
        @elseif($type == "company")
            <h1 class="h3 mb-0 text-gray-800">المستخدمين - الشركات</h1>
        @elseif($type == "business")
            <h1 class="h3 mb-0 text-gray-800">المستخدمين - الأعمال</h1>
        @endif
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if($type == "resume")
                <h6 class="m-0 font-weight-bold text-primary">المستخدمين - المستقلين</h6>
            @elseif($type == "company")
                <h6 class="m-0 font-weight-bold text-primary">المستخدمين - الشركات</h6>
            @elseif($type == "business")
                <h6 class="m-0 font-weight-bold text-primary">المستخدمين - الأعمال</h6>
            @endif
            <div class="mt-3">
                <form action="{{ route('admin.users', $type) }}" method="get">
                    <div class="form-group">
                        <input type="text" name="word" class="form-control w-50 float-right"
                               placeholder="كلمة البحث...">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary mx-2" value="بحث">
                    </div>
                </form>
            </div>
            @if(\request()->word)
                <div class="mt-3">
                    نتائج البحث عن:
                    <strong>{{ \request()->word }}</strong>
                    <a href="{{ route('admin.users',$type) }}" class="btn btn-secondary btn-sm">حذف</a>
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>اسم المستخدم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم الهاتف</th>
                        <th>البلد</th>
                        <th>المدينة</th>
                        <th>حالة الحساب</th>
                        <th>تاريخ الإنضمام</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                @if($user->image)
                                    <img src="{{ asset('/images/users/' . $user->image) }}" width="100" height="100">
                                @else
                                    <img src="{{ asset('/assets/images/default_avatar.png') }}" width="100"
                                         height="100">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '-' }}</td>
                            <td>{{ $user->country ? $user->country->name : '-' }}</td>
                            <td>{{ $user->city ? $user->city->name : '-' }}</td>
                            <td>
                                @if($user->blocked == 1)
                                    <label class="badge badge-danger">محظور</label>
                                @else
                                    <label class="badge badge-success">فعال</label>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format("Y-m-d") }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.show',$user->id) }}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                    <a onclick="del({{ $user->id }})"
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
                            <td class="text-center" colspan="10">لا يوجد مستخدمين.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($users && $users->count() > 0)
                {{ $users->links() }}
            @endif
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
                    <p>في حال التأكيد لا يمكنك التراجع وسيتم حذف كل بيانات المستخدم.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <form action="{{ route('admin.users.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="0" id="modal_id">
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
            document.getElementById('modal_id').value = id
        }
    </script>
@endpush
