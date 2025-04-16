
<form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        @include('reservations.form')
</form>
        
