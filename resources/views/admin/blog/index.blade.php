@extends('admin.template')

@section('main')
    <h1 class="text-center">Les blogs</h1>
    <div class="float-right d-flex justify-content-around mb-3 border p-2 btn-link btn btn-light">
        <a href="{{ route('admin.blogCat.index') }}">gerer les categorie</a>
    </div>
    &nbsp;
    <div class="float-right d-flex justify-content-around mb-3 border p-2 btn-link btn btn-light">
        <a href="{{ route('admin.blogs.create') }}">Ajouter un blog</a>
    </div>
    <div class="table-responsive mb-1">
        <table class="table  table-bordered">
            <caption>Listes des blogs Enregistres</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Photo</th>
					<th>Titre</th>
					<th>Contenu</th>
					<th>Poste le </th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td> {{ $blog->titre }} </td>
                        <td><img src="{{asset('storage/'.$blog->photo)}}" style="border-radius: 0;transform: scale(2) translateX(50%);" class="card d-block border"  alt=""></td>
                        <td>{{$blog->titre}}</td>
						<td>{{ Str::words($blog->content??"Non definie",2) }}</td>
                        <td> {{ $blog->created_at->Format("d M y") }} </td>
                        <td>
                            <div class="btn-group">
                                <form method="POST"
                                    action="{{ route('admin.blogs.destroy', ['blog' => $blog->id]) }}"
                                    class="menu-icon">
                                    @csrf
                                    @method('delete')
                                    <button class="mdi mdi-delete mdi-30px btn btn-outline-warning" type="submit"> </button>
                                </form>
                                &nbsp;
                                <a href="{{ route('admin.blogs.edit', ['blog' => $blog->id]) }}"
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

    @if (session()->has('messages.info'))
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/toastr.js') }}"></script>
        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "rtl": false,
                "positionClass": "toast-top-full-width",
                "prblogDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["info"](`{{ session("messages.info")  }}`,"Information")
        </script>
    @endif

@endpush
