@extends('admin.layout.app')
@section('users', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">لوحة التحكم - {{ $user->name }}</h1>
    </div>

    <a href="{{ route('admin.users', $type) }}"
       class="d-sm-inline-block btn btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right text-white-50"></i>
        رجوع
    </a>

    @if($user->blocked == 1)
        <form action="{{ route('admin.users.unblock') }}" method="post" class="d-inline-block">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <button type="submit" class="d-sm-inline-block btn btn-success shadow-sm mb-4">
                <i class="fas fa-unlock text-white-50"></i>
                فك الحظر
            </button>
        </form>
    @else
        <a onclick="del({{ $user->id }})"
           data-toggle="modal"
           data-target="#blockModal"
           class="d-sm-inline-block btn btn-danger shadow-sm mb-4">
            <i class="fas fa-ban text-white-50"></i>
            حظر المستخدم
        </a>
    @endif

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    @if($type == "resume")
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">البيانات الأساسية</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-3">
                        @if($user->image)
                            <img src="{{ asset('/images/users/' . $user->image) }}" class="w-100">
                        @else
                            <img src="{{ asset('/assets/images/default_avatar.png') }}" class="w-100">
                        @endif
                    </div>
                    <div class="col-12 col-sm-9">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>الاسم:</strong></h6>
                                {{ $user->name }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>اسم المستخدم:</strong></h6>
                                {{ $user->username }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>البريد الإلكتروني:</strong></h6>
                                {{ $user->email }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>رقم الهاتف:</strong></h6>
                                {{ $user->phone ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>البلد:</strong></h6>
                                {{ $user->country ? $user->country->name : 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>المدينة:</strong></h6>
                                {{ $user->city ? $user->city->name : 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>الجنس:</strong></h6>
                                @if($user->gender)
                                    {{ $user->gender == 'male' ? 'ذكر' : 'أنثى' }}
                                @else
                                    غير محدد
                                @endif
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>تاريخ الميلاد:</strong></h6>
                                {{ $user->birthday ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>المسمى الوظيفي:</strong></h6>
                                {{ $user->job_title ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>رابط الموقع الإلكتروني:</strong></h6>
                                {{ $user->website ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>مستوى التعليم:</strong></h6>
                                {{ $user->education ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>مستوى الخبرة:</strong></h6>
                                {{ $user->experience ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>اللغات:</strong></h6>
                                @if($user->languages)
                                    @foreach(explode(",",$user->languages) as $lang)
                                        {{ $lang }}
                                    @endforeach
                                @else
                                    غير محدد
                                @endif
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>المهارات:</strong></h6>
                                {{ $user->name }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>العنوان:</strong></h6>
                                {{ $user->address ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 my-3">
                                <h6><strong>وصف قصير:</strong></h6>
                                {{ $user->description ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 my-3">
                                <h6><strong>ظهور الحساب:</strong></h6>
                                {{ $user->status == 1 ? 'مفعل' : 'غير مفعل' }}
                            </div>
                            <div class="col-12 col-md-6 my-3">
                                <h6><strong>حالة الحساب:</strong></h6>
                                {{ $user->blocked == 1 ? 'محظور' : 'غير محظور' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">بيانات الدراسة</h6>
            </div>
            <div class="card-body">
                @if($user->user_education && $user->user_education->count() > 0)
                    <ul style="padding: 0">
                        @foreach($user->user_education as $edu)
                            <li style="background-color: #eee;padding: 10px;margin: 5px 0">
                                شهادة
                                <strong>{{ $edu->certificate }}</strong>
                                في
                                <strong>{{ $edu->college }}</strong>
                                تخصص
                                <strong>{{ $edu->field }}</strong>
                                سنة البدء
                                <strong>{{ $edu->start_year }}</strong>
                                سنة التخرج
                                <strong>{{ $edu->end_year ?? 'حتى الآن' }}</strong>
                                <h6 class="mt-2">
                                    وصف:
                                    <strong>{{ $edu->description ?? '-' }}</strong>
                                </h6>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <h6>لا يوجد شهادات مضافة.</h6>
                @endif
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">بيانات خبرة العمل</h6>
            </div>
            <div class="card-body">
                @if($user->user_experience && $user->user_experience->count() > 0)
                    <ul style="padding: 0">
                        @foreach($user->user_experience as $exp)
                            <li style="background-color: #eee;padding: 10px;margin: 5px 0">
                                <h6 class="mt-2">
                                    المسمى الوظيفي:
                                    <strong>{{ $exp->job_title }}</strong>
                                </h6>
                                <h6 class="mt-2">
                                    الشركة:
                                    <strong>{{ $exp->company }}</strong>
                                </h6>
                                <h6 class="mt-2">
                                    سنة البدء:
                                    <strong>{{ $exp->start_year }}</strong>
                                </h6>
                                <h6 class="mt-2">
                                    سنة ترك العمل:
                                    <strong>{{ $exp->end_year ?? 'حتى الآن' }}</strong>
                                </h6>
                                <h6 class="mt-2">
                                    وصف:
                                    <strong>{{ $exp->description ?? '-' }}</strong>
                                </h6>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <h6>لا يوجد خبرات مضافة.</h6>
                @endif
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">معرض الأعمال</h6>
            </div>
            <div class="card-body">
                @if($user->user_portfolio && $user->user_portfolio->count() > 0)
                    <div class="row">
                        @foreach($user->user_portfolio as $port)
                            @foreach($port->portfolio_images as $img)
                                <div class="col-12 col-md-4 text-center my-4">
                                    <img src="{{ asset('/images/portfolio/' . $img->image) }}"
                                         style="width: 100%;height: 400px;border: 2px solid #ccc">
                                    <h5 class="my-2">{{ $port->title }}</h5>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @else
                    <h6>لا يوجد أعمال مضافة.</h6>
                @endif
            </div>
        </div>
    @elseif($type == "company")
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">البيانات الأساسية</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-3">
                        @if($user->image)
                            <img src="{{ asset('/images/users/' . $user->image) }}" class="w-100">
                        @else
                            <img src="{{ asset('/assets/images/default_avatar.png') }}" class="w-100">
                        @endif
                    </div>
                    <div class="col-12 col-sm-9">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>الاسم:</strong></h6>
                                {{ $user->name }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>اسم المستخدم:</strong></h6>
                                {{ $user->username }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>البريد الإلكتروني:</strong></h6>
                                {{ $user->email }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>البريد الإلكتروني للشركة:</strong></h6>
                                {{ $user->company_email }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>رقم الهاتف:</strong></h6>
                                {{ $user->phone ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>تأسست عام:</strong></h6>
                                {{ $user->founded_in ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>حجم الشركة (موظفين):</strong></h6>
                                {{ $user->company_size ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>البلد:</strong></h6>
                                {{ $user->country ? $user->country->name : 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>المدينة:</strong></h6>
                                {{ $user->city ? $user->city->name : 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>رابط الموقع الإلكتروني:</strong></h6>
                                {{ $user->website ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>العنوان:</strong></h6>
                                {{ $user->address ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>الرمز البريدي:</strong></h6>
                                {{ $user->zip ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 my-3">
                                <h6><strong>وصف قصير:</strong></h6>
                                {{ $user->description ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 my-3">
                                <h6><strong>ظهور الحساب:</strong></h6>
                                {{ $user->status == 1 ? 'مفعل' : 'غير مفعل' }}
                            </div>
                            <div class="col-12 col-md-6 my-3">
                                <h6><strong>حالة الحساب:</strong></h6>
                                {{ $user->blocked == 1 ? 'محظور' : 'غير محظور' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">معرض الأعمال</h6>
            </div>
            <div class="card-body">
                @if($user->user_portfolio && $user->user_portfolio->count() > 0)
                    <div class="row">
                        @foreach($user->user_portfolio as $port)
                            @foreach($port->portfolio_images as $img)
                                <div class="col-12 col-md-4 text-center my-4">
                                    <img src="{{ asset('/images/portfolio/' . $img->image) }}"
                                         style="width: 100%;height: 400px;border: 2px solid #ccc">
                                    <h5 class="my-2">{{ $port->title }}</h5>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @else
                    <h6>لا يوجد أعمال مضافة.</h6>
                @endif
            </div>
        </div>
    @elseif($type == "business")
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">البيانات الأساسية</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-3">
                        @if($user->image)
                            <img src="{{ asset('/images/users/' . $user->image) }}" class="w-100">
                        @else
                            <img src="{{ asset('/assets/images/default_avatar.png') }}" class="w-100">
                        @endif
                    </div>
                    <div class="col-12 col-sm-9">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>الاسم:</strong></h6>
                                {{ $user->name }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>اسم المستخدم:</strong></h6>
                                {{ $user->username }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>اسم العمل المحلي:</strong></h6>
                                {{ $user->b_name ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>البريد الإلكتروني:</strong></h6>
                                {{ $user->email }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>البريد الإلكتروني للعمل:</strong></h6>
                                {{ $user->b_email ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>رقم الهاتف:</strong></h6>
                                {{ $user->phone ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>تصنيف العمل:</strong></h6>
                                {{ $user->category ? $user->category->name : 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>البلد:</strong></h6>
                                {{ $user->country ? $user->country->name : 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>المدينة:</strong></h6>
                                {{ $user->city ? $user->city->name : 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>رابط الموقع الإلكتروني:</strong></h6>
                                {{ $user->website ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>العنوان:</strong></h6>
                                {{ $user->address ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>تاريخ الميلاد:</strong></h6>
                                {{ $user->birthday ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>مستوى التعليم:</strong></h6>
                                {{ $user->education ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>مستوى الخبرة:</strong></h6>
                                {{ $user->experience ? $user->experience . ' سنة' : 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>اللغات:</strong></h6>
                                @if($user->languages)
                                    @foreach(explode(",",$user->languages) as $lang)
                                        {{ $lang }}
                                    @endforeach
                                @else
                                    غير محدد
                                @endif
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>المهارات:</strong></h6>
                                {{ $user->name }}
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 my-3">
                                <h6><strong>الرمز البريدي:</strong></h6>
                                {{ $user->zip ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 my-3">
                                <h6><strong>وصف قصير:</strong></h6>
                                {{ $user->description ?? 'غير محدد' }}
                            </div>
                            <div class="col-12 col-md-6 my-3">
                                <h6><strong>ظهور الحساب:</strong></h6>
                                {{ $user->status == 1 ? 'مفعل' : 'غير مفعل' }}
                            </div>
                            <div class="col-12 col-md-6 my-3">
                                <h6><strong>حالة الحساب:</strong></h6>
                                {{ $user->blocked == 1 ? 'محظور' : 'غير محظور' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">معرض الأعمال</h6>
            </div>
            <div class="card-body">
                @if($user->user_portfolio && $user->user_portfolio->count() > 0)
                    <div class="row">
                        @foreach($user->user_portfolio as $port)
                            @foreach($port->portfolio_images as $img)
                                <div class="col-12 col-md-4 text-center my-4">
                                    <img src="{{ asset('/images/portfolio/' . $img->image) }}"
                                         style="width: 100%;height: 400px;border: 2px solid #ccc">
                                    <h5 class="my-2">{{ $port->title }}</h5>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                @else
                    <h6>لا يوجد أعمال مضافة.</h6>
                @endif
            </div>
        </div>
    @endif


    <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <p>هل أنت متأكد من خيار حظر المستخدم؟</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <form action="{{ route('admin.users.block') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="0" id="modal_id">
                        <input type="submit" value="حظر" class="btn btn-danger">
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