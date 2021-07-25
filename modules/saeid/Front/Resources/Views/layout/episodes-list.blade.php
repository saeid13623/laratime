<div class="episodes-list">
    <div class="episodes-list--title">

        <span style="text-align: right;float: right">فهرست جلسات</span>

        @can('download',$course)
        <span >
        <a href="{{route('courses.downloadLink',$course->id)}}">دریافت همه لینک های دانلود</a>
        <a class="detail-download">
            <i class="icon-download"></i>
        </a>
    </span>
        @endcan

    </div>

    <div class="episodes-list-section">
        @foreach($lessons as $lesson)
            <div class="episodes-list-item  @cannot("download",$lesson) lock @endcannot">
                <div class="section-right">
                    <span class="episodes-list-number">{{$lesson->number}}</span>
                    <div class="episodes-list-title">
                        <a href="{{$lesson->path()}}">{{ $lesson->title }}</a>
                    </div>
                </div>
                <div class="section-left">
                    <div class="episodes-list-details">
                        <div class="episodes-list-details">
                            <span class="detail-type">{{$lesson->type}}</span>
                            <span class="detail-time">{{$lesson->time}}</span>
                            <a class="detail-download" @can('download',$lesson) href="{{ $lesson->downloadLink() }} @endcan">
                                <i class="icon-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
