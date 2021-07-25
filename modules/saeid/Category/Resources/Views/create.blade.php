<div class="col-4 bg-white">
    <p class="box__title">ایجاد دسته بندی جدید</p>
    <form action="{{route('category.store')}}" method="post" class="padding-30">
        @CSRF
        <input type="text" required name="title" placeholder="نام دسته بندی" class="text">
        <input type="text" required name="slug" placeholder="نام انگلیسی دسته بندی" class="text">
        <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
        <select name="parent_id" id="parent_id">
            <option value="">ندارد</option>

            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
</div>
