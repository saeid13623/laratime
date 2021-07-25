<div class="col-12 bg-white margin-bottom-15 border-radius-3">
    <p class="box__title">سرفصل ها</p>
    <form action="{{ route('seasons.store',$course->id) }}" method="post" class="padding-30">
        @CSRF

        <input type="text" name="title" placeholder="عنوان سرفصل" class="text">

        <input type="text" name="number" placeholder="شماره سرفصل" class="text">
        <button type="submit" class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
    <div class="table__box padding-30">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th class="p-r-90">شناسه</th>
                <th>عنوان فصل</th>
                <th>وضعیت دوره</th>
                <th>وضعیت تایید</th>

                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>

            @foreach($course->seasons as $season)
            <tr role="row" class="">
                <td>{{ $season->number }}</td>
                <td><a href="">{{ $season->title }}</a></td>
                <td class="confirmation_status">
                    <span style="@if($season->confirmation_status == saeid\Course\Model\Season::CONFIRMATION_STATUS_ACCEPTED)  color:#00b894 @else color:#e73368  @endif">
                        @lang($season->confirmation_status)
                    </span>
                </td>
                <td class="status">
                    <span style="@if($season->status == saeid\Course\Model\Season::STATUS_OPENED)  color:#00b894 @else color:#e73368  @endif">
                        @lang($season->status)
                    </span>
                </td>
                <td>
                    <a href="" onclick="deleteItem(event,'{{ route('seasons.destroy',$season->id) }}')" class="item-delete mlg-15" title="حذف"></a>

                    @can(saeid\RolePermission\Models\Permission::PERMISSION_MANAGE_COURSE)
                    <a href="" class="item-confirm mlg-15" title="تایید"
                       onclick="updateConfirmationStatus(event,'{{ route('seasons.accept',$season->id) }}','آیاازتاییدآیتم اطمینان دارید','تاییدشده')" >
                    </a>
                    <a href="" class="item-reject mlg-15" title="رد"
                       onclick="updateConfirmationStatus(event,'{{ route('seasons.reject',$season->id) }}','آیااز رد آیتم اطمینان دارید','ردشده')">
                    </a>
                    <a href="" class="item-lock mlg-15 lockedItem"
                       onclick="updateStatus(event,'{{ route('seasons.opened',$season->id)}}'
                           ,'آیا ازتغییروضعیت دوره به باز شده اطمینان دارید','بازشده')" title="باز">
                    </a>
                    <a href="" class="item-lock-red mlg-15 lockedItem"
                       onclick="updateStatus(event,'{{ route('seasons.locked',$season->id)}}'
                           ,'آیا ازتغییروضعیت دوره به قفل شده اطمینان دارید','قفل شده')" title="قفل">
                    </a>
                    @endcan
                    <a href="{{ route('seasons.edit',$season->id) }}" class="item-edit " title="ویرایش"></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

