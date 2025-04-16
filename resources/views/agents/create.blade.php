@extends('layouts.app')

@section('content')
    <h4>Create Agent</h4>
    <form action="{{ route('agents.store') }}" method="POST">@csrf
        @include('agents.form')
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
