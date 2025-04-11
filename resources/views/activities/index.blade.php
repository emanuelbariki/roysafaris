@extends('layouts.app')

@section('content')
<div class="container-fluid card-body">
    <h4 class="mb-4">Activities</h4>

   
    <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('activities.create') }}" class="btn btn-primary">Create New Activity</a>
                    </div><!--end card-header-->
                    <div class="card-body">                                    
                        <div class="table-responsive">
                        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->name }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->price }}</td>
                        <td>{{ $activity->location }}</td>
                        <td>{{ $activity->start_date }}</td>
                        <td>{{ $activity->end_date }}</td>
                        <td>
                            <a href="{{ route('activities.edit', $activity) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
</div><!--end card-body-->
</div>
</div>

</div>
@endsection