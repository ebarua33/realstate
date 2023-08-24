@extends('user.user_dashboard')

@section('user')
    <!-- banner-section -->
    @include('user.user_home.banner')
    <!-- banner-section end -->


    <!-- category-section -->
    @include('user.user_home.category')
    <!-- category-section end -->


    <!-- feature-section -->
    @include('user.user_home.feature')
    <!-- feature-section end -->


    <!-- video-section -->
    @include('user.user_home.video')
    <!-- video-section end -->


    <!-- deals-section -->
    @include('user.user_home.deals')
    <!-- deals-section end -->


    <!-- testimonial-section end -->
    @include('user.user_home.testimonial')
    <!-- testimonial-section end -->


    <!-- chooseus-section -->
    @include('user.user_home.choose_us')
    <!-- chooseus-section end -->


    <!-- place-section -->
    @include('user.user_home.place')
    <!-- place-section end -->


    <!-- team-section -->
    @include('user.user_home.team')
    <!-- team-section end -->


    <!-- cta-section -->
    @include('user.user_home.cta')
    <!-- cta-section end -->


    <!-- news-section -->
    @include('user.user_home.news')
    <!-- news-section end -->


    <!-- download-section -->
    @include('user.user_home.download')
    <!-- download-section end -->
@endsection
