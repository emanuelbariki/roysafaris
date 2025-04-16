@extends('layouts.app')

@section('content')
    <center><h4>Edit Lodge</h4></center>
    <form action="{{ route('lodges.update', $lodge) }}" method="POST">
        @csrf @method('PUT')
        @include('lodges.form', ['lodge' => $lodge])
        
    </form>
@endsection
