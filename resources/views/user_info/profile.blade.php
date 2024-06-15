@extends('layouts.app')

@section('title', 'reservation')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="h1 text-start"><span class="underline">&nbsp;Use</span>r Profile</div>
        </div>
    </div>

    
    <div class="row ms-1">
      <div class="col-2 me-3 tab-active"> 
        <a href="{{route('profile', ['id' => $user->id])}}" class="tab-link-active">Profile</a>  
      </div>

      <div class="col-2 me-3 tab">
        <a href="{{route('reservation', ['id' => $user->id])}}" class="tab-link">Reservation</a>
      </div>

      <div class="col-2 tab">
        <a href="{{route('favorite', ['id' => $user->id])}}" class="tab-link">Favorite</a>
      </div>
    </div>
    

    <div class="card mt-0">
      <div class="card-body">

      </div>
    </div>

</div>

@endsection