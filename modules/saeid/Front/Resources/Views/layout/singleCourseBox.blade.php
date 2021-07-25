<div class="col">
    <a href="{{$latestCourse->path()}}">
        <div class="course-status">
            {{$latestCourse->status}}
        </div>
        <div class="discountBadge">
            <p>{{$latestCourse->percent}}%</p>
            تخفیف
        </div>
        <div class="card-img"><img src="{{$latestCourse->thumb}}" alt="www.laratime.ir"></div>
        <div class="card-title"><h2>{{$latestCourse->title}}</h2></div>
        <div class="card-body">

            <img src="{{$latestCourse->teacher->thumb }}" alt="{{ $latestCourse->teacher->name }}">
            <a href="{{ route('tutorSingle',$latestCourse->teacher->username) }}">
                <span>{{ $latestCourse->teacher->name }}</span>
            </a>
        </div>
        <div class="card-details">
            <div class="time">{{$latestCourse->getDurationCourse()}}</div>
            <div class="price">
                <div class="discountPrice">{{$latestCourse->price}}</div>
                <div class="endPrice">{{$latestCourse->price}}</div>
            </div>
        </div>
    </a>
</div>
