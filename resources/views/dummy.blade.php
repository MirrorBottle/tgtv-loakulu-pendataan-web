{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
  <div class="container-fluid">
    <div class="row page-titles mx-0">
      <div class="col-12 p-md-0">
        <div class="welcome-text">
          <h4>{{$name}}</h4>
        </div>
      </div>
    </div>
  </div>
@endsection			