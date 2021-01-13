@extends('layouts.app')

@section('content')
  <div>
    <p>{{$user->name}}</p>
    <p>{{ $user->email }}</p>
  </div>
@endsection
