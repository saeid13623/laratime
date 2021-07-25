@extends('Front::layout.master')

@section('content')


    <main id="index" class="mrt-150">
        <div class="bt-0-top article mr-202"></div>
        <div class="bt-1-top">
            <div class="container">
                <div class="tutor">
                    <div class="tutor-item">
                        <div class="tutor-avatar">
                            <span class="tutor-image" id="tutor-image" >
                                <img src="{{($tutor->image) ? $tutor->image->thumb : '' }}" class="tutor-avatar-img">
                            </span>
                            <div class="tutor-author-name">
                                <a id="tutor-author-name" href="" title="{{ $tutor->name }}">
                                    <h3 class="title"><span class="tutor-author--name">{{ $tutor->name }}</span></h3>
                                </a>
                            </div>
                            <div id="Modal1" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="close">&times;</div>
                                    </div>
                                    <div class="modal-body">
                                        <img class="tutor--avatar--img" src="{{($tutor->image) ? $tutor->image->thumb : '' }}" alt="">
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tutor-item">
                        <div class="stat">
                            <span class="tutor-number tutor-count-courses"> {{ count((array)$tutor->courses) }}</span>
                            <span class="">تعداد دوره ها</span>
                        </div>
                        <div class="stat">

                            <span class="tutor-number">{{ $tutor->countStudent() }} </span>
                            <span class="">تعداد  دانشجویان</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box-filter">
                <div class="b-head">
                    <h2>دوره های محمد نیکو</h2>
                </div>
                <div class="posts">
                  @foreach($tutor->courses as $latestCourse)
                      @include('Front::layout.singleCourseBox')
                  @endforeach
                </div>
            </div>
            {{--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-content" style="width: 800px;">
                    <div class="modal-header">
                        <div class="close">×</div>
                    </div>
                    <div class="modal-body">
                        <img class="tutor--avatar--img" data-toggle="modal"  data-target="#exampleModal"
                             src="{{ $tutor->image->thumb }}" alt="{{ $tutor->name }}">
                    </div>

                </div>
            </div>--}}
        </div>
    </main>


@endsection

