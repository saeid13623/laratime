@extends('Dashboard::master')

@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دسته بندی ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام دسته بندی</th>
                        <th>نام انگلیسی دسته بندی</th>
                        <th>دسته پدر</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                    <tr role="row" class="" id="trTag">
                        <td><a href="">{{$category->id}}</a></td>
                        <td><a href="">{{$category->title}}</a></td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->Parent}}</td>

                        <td>
                            <a href="" onclick=" deleteItem( event, '{{route('category.destroy',$category->id)}}')" class="item-delete mlg-15" title="حذف"></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="{{route('category.edit',$category->id)}}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
       @include('Category::create')

    </div>
@stop()
@section('css')
    <link rel="stylesheet" href="/css/jquery.toast.min.css">
@stop()
@section('js')
    <script src="/js/jquery.toast.min.js"></script>
    <script>
        function deleteItem(event,route){
            event.preventDefault();
            if(confirm('آیا میخواهید حذف کنید')){
                $.post(route, { _method: "delete", _token: $('meta[name="_token"]').attr('content') })
                    .done(function () {
                        event.target.closest('tr').remove();
                        $.toast({
                            heading: 'Information',
                            text: 'عملیات موفقیت آمیز بود',
                            icon: 'info',
                            loader: true,        // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        })
                    })
                    .fail(function () {

                    })
            }
        }
    </script>
@stop
