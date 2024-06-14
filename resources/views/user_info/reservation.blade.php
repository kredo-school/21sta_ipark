@extends('layouts.app')

@section('title', 'reservation')

@section('content')
<style>
.row{
  text-align: center;
}

.tab{
  background-color: white;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  border: 1px solid orange;
  padding: 10px;
  margin-bottom: 0px;
  font-weight: bold;
}

.tab-link{
  text-decoration: none;
  color: orange;
}

.tab-link-active{
  text-decoration: none;
  color: white;
}

.tab-active{
  background-color: orange;
  color: white;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  padding: 10px;
  margin-bottom: 0px;
  font-weight: bold;
}

.card{
  background-color: white;
  border-top: 5px solid orange;
  border-right: none;         
  border-bottom: none;        
  border-left: none;  
}
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="h1 text-start"><span class="underline">&nbsp;Res</span>ervation History</div>
        </div>
    </div>

    
    <div class="row ms-1">
      <div class="col-2 me-3 tab"> 
        <a href="{{route('profile', ['id' => $user->id])}}" class="tab-link">Profile</a>  
      </div>

      <div class="col-2 me-3 tab-active">
        <a href="{{route('reservation', ['id' => $user->id])}}" class="tab-link-active">Reservation</a>
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