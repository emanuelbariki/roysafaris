@extends('layouts.app')

@section('content')
    <h4>Edit Agent</h4>
    <form action="{{ route('agents.update', $agent) }}" method="POST">
        @csrf @method('PUT')
        @include('agents.form', ['agent' => $agent])
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
