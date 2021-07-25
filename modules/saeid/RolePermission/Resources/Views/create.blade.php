<div class="col-4 bg-white">
    <p class="box__title">ایجاد نقش کاربری</p>
    <form action="{{route('role-permissions.store')}}" method="post" class="padding-30">
        @CSRF
        <input type="text" required name="name" placeholder="عنوان" class="text">
        @error('name')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <p class="box__title margin-bottom-15">انتخاب مجوز</p>
        @foreach($permissions as $permission)
        <label class="ui-checkbox p-t-10 pr-35">
            <input type="checkbox" name="permissions[{{$permission->name}}]" class="checkedAll"
                   value="{{$permission->name}}"
                   @if(is_array(old('permissions')) && array_key_exists($permission->name,old('permissions'))) checked @endif
            >
            <span class="checkmark "></span>
            @lang($permission->name)
        </label>
        @endforeach
        @error('permissions')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <hr>
        <button class="btn btn-webamooz_net mt-20">اضافه کردن</button>
    </form>
</div>
