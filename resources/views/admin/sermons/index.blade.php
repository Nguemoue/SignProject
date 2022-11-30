@extends('admin.template')

@section('main')
    <h1 class="text-center">Les Sermons</h1>
    <div class="float-right mb-3 border p-2 btn-link btn btn-light">
        <a href="{{ route('admin.sermons.create') }}">Creer un Sermon</a>
    </div>
    <div class="table-responsive mb-1">
        <table class="table  table-bordered">
            <caption>Listes des Sermons</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Poste le </th>
                    <th>Actionn</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sermons as $sermon)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td> {{ $sermon->titre }} </td>
                        <td> {{ $sermon->author }} </td>
                        <td> {{ Str::words($sermon->description, 5) }} </td>
                        <td> {{ $sermon->created_at->diffForHumans() }} </td>
                        <td>
                            <div class="btn-group">
                                <form method="POST"
                                    action="{{ route('admin.sermons.destroy', ['sermon' => $sermon->id]) }}"
                                    class="menu-icon">
                                    @csrf
                                    @method('delete')
                                    <button class="mdi mdi-delete mdi-30px btn btn-outline-warning" type="submit"> </button>
                                </form>
                                &nbsp;
                                <a href="{{ route('admin.sermons.edit', ['sermon' => $sermon->id]) }}"
                                    class="btn btn-outline-info"><i class="mdi mdi-pencil"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
@endpush
@push('scripts')
    @includeIf("_partials.session_messages")
@endpush
