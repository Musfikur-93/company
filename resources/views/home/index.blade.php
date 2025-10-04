@extends('home.home_master')
@section('home')

  @include('home.homelayout.slider')
  <!-- end hero -->
  @include('home.homelayout.features')
  <!-- end content -->

  @include('home.homelayout.clarifies')
  <!-- end content -->

  @include('home.homelayout.get_all')
  <!-- end content -->

  @include('home.homelayout.usability')
  <!-- end video -->

  @include('home.homelayout.reviews')
  <!-- end testimonial -->

  @include('home.homelayout.faq')
  <!-- end faq -->

  @include('home.homelayout.cta')
  <!-- end cta -->


@endsection
