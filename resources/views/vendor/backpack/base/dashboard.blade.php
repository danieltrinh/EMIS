@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection

@section('content')
<?php $user = Auth::user();?>

  @if($user)        
    @if ($user->hasRole('admin')) 
      @include('admin.dashboard.admin')
    @elseif ($user->hasRole('teacher'))
    
      @include('admin.dashboard.teacher')
    @elseif ($user->hasRole('student'))
    
      @include('admin.dashboard.student')
    @elseif ($user->hasRole('parent'))
    
      @include('admin.dashboard.parent')
    @elseif ($user->hasRole('principle'))
      @include('admin.dashboard.principle')
    
    @endif
  @endif

@endsection
