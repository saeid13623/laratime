@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">کاربران</a></li>
@stop
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">  کاربر</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ای دی</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>موبایل</th>
                        <th>تاریخ عضویت</th>
                        <th>ای پی</th>
                        <th>نقش کاربری</th>
                        <th>وضعصت حساب کاربر</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr role="row" class="" id="trTag">
                        <td>{{$loop->index +1}}</td>
                        <td><a href="">{{$user->name}}</a></td>
                        <td width="80">{{ $user->email }}</td>
                        <td width="80">{{ $user->mobile }}</td>
                        <td width="80">{{ $user->created_at }}</td>
                        <td width="80">{{ $user->ip }}</td>

                        <td>
                            <ul>
                                @foreach($user->roles as $userRole)
                                    <li class="ss">@lang($userRole->name)
                                        <a class="item-delete mlg-15" href="#"
                                           onclick="deleteItem1(event,'{{ route('users.removeRole',["user"=>$user->id,"role"=>$userRole->name]) }}')">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <li>
                                <a  onclick="setFormAction({{ $user->id }})" style="color: #0c3d8c;font-size: 12px;" href="#login-form" rel="modal:open">اضافه کردن </a>
                            </li>
                        </td>
                        <td class="status">{!! $user->hasVerifiedEmail() ? '<span class="text-success" > تاییدشده</span>' : '<span class="text-error" > تاییدنشده</span>' !!}</td>

                        <td>
                            <a href="" onclick=" deleteItem( event, '{{route('users.destroy',$user->id)}}')"
                               class="item-delete mlg-15" title="حذف">
                            </a>
                            <a href="{{ route('users.edit',$user->id) }}" class="item-edit mlg-15" title="ویرایش"></a>
                            <a href="" class="item-confirm mlg-15 " onclick="updateStatus(event,'{{ route('users.manualVerified',$user->id) }}'
                                ,'آیا ازتغییروضعیت کاربر به تایید شده اطمینان دارید','تاییدشده') " title="تاییدحساب کاربری">
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div id="login-form" class="modal">
                    <form id="select-user-role" action="{{ route('users-addRole',0) }}" method="post">
                        @CSRF
                        <select name="role" id="">
                            <option>یک نقش انتخاب کنید</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-webamooz_net mt-20">اضافه کردن</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@stop()

@section('js')
    <script>
        function setFormAction(userId) {
            let form = $('#select-user-role')
            let action = '{{ route('users-addRole',0) }}';
            form.attr('action',action.replace('/0/','/' + userId+ '/'));
        }

        @if(session()->has('feedbacks'))
            @foreach(session()->get('feedbacks') as $item)
        $.toast({
            heading: "{{ $item["title"] }}",
            text: "{{ $item["body"] }}",
            icon: "{{ $item["type"] }}",
            loader: true,        // Change it to false to disable loader
            loaderBg: '#9EC600'  // To change the background
        })
            @endforeach
         @endif
    </script>
    <script>
       {{-- @include('Commen.Responses.AjaxResponse')--}}
    </script>
@stop
