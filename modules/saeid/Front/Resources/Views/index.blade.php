@extends('Front::layout.master')

@section('content')
    <main id="index">
        <article class="container article">
            @include('Front::layout.ads-top')
            @include('Front::layout.top-info')
            @include('Front::layout.latestCourse')
            @include('Front::layout.popularCourse')
        </article>
        @include('Front::layout.latestArticle')
    </main>

@endsection
