@extends('layouts.app')

@section('content')
<div class="container-fluid card-body">
    <h4 class="mb-4">Enquiries</h4>


    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('enquiries.create') }}" class="btn btn-primary mb-3">Create New Enquiry</a>
            </div>
            <!--end card-header-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquiries as $enquiry)
                            <tr>
                                <td>{{ $enquiry->id }}</td>
                                <td>{{ $enquiry->first_name }}</td>
                                <td>{{ $enquiry->last_name }}</td>
                                <td>{{ $enquiry->email }}</td>
                                <td>{{ $enquiry->phone }}</td>
                                <td>
                                    <a href="{{ route('enquiries.edit', $enquiry->id) }}"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('enquiries.destroy', $enquiry->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this enquiry?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end card-body-->
        </div>
    </div>

</div>
@endsection