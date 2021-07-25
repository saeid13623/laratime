<!DOCTYPE html>
<html lang="en">
@include('Dashboard::layout.head')
<body>
    <div class="content">
        @include('Dashboard::layout.sidebar')
        @include('Dashboard::layout.header')
        @include('Dashboard::layout.breadcrumb')
        <div class="main-content">
        @yield('content')
        </div>
    </div>
</body>
@include('Dashboard::layout.footer')
