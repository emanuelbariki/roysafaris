@extends('layouts.app')

@section('content')
    <center><h4>Create Lodge</h4></center>
    <form action="{{ route('lodges.store') }}" method="POST">@csrf
        @include('lodges.form')
    </form>
@endsection
