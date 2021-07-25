<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>

    <x-user-photo />

    <ul>

            @foreach(config('sidebar.items') as $sidebarItems)
                @if(!array_key_exists('permission',$sidebarItems) ||
                 auth()->user()->hasAnyPermission($sidebarItems['permission']) ||
                 auth()->user()->hasPermissionTo(saeid\RolePermission\Models\Permission::PERMISSION_SUPER_ADMIN))
                    <li class="item-li {{$sidebarItems['icon']}} @if(str_starts_with(request()->url(),$sidebarItems['url'])) is-active @endif"><a href="{{$sidebarItems['url']}}">{{$sidebarItems['title']}}</a></li>
                @endif
                @endforeach

    </ul>

</div>
