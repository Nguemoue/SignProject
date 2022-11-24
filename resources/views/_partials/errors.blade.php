@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <ul class="list-unstyled">
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    </div>
@endif
