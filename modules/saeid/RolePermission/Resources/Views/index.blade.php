@extends('Dashboard::master')

@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">نقشهای کاربری</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نقس کاربری</th>
                        <th>مجوزها</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                    <tr role="row" class="" id="trTag">
                        <td><a href="">{{$role->id}}</a></td>
                        <td><a href="">{{$role->name}}</a></td>
                        <td>
                            <ul>
                                @foreach($role->permissions as $permission)
                                    <li>@lang($permission->name)</li>
                                @endforeach
                            </ul>
                        </td>

                        <td>
                            <a href="" onclick=" deleteItem( event, '{{route('role-permissions.destroy',$role->id)}}')" class="item-delete mlg-15" title="حذف"></a>
                            <a href="{{route('role-permissions.edit',$role->id)}}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
       @include('Permission::create')

    </div>
@stop()
