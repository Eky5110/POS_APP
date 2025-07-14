@if ($errors->any())
    <div class="alert alert-{{ $type }}">
        @foreach ($errors->all() as $e )
        <small class="d-block">{{ $e }}</small>
        @endforeach
    </div>
@endif  