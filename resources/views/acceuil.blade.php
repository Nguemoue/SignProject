@extends("template")

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="btn-group">
                    <button class="btn btn-success">Tout</button>
                    <button class="btn">En cours</button>
                    <button class="btn">Complete</button>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group">
                    <span class="input-group-text"></span>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="card p-2">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Collecte</th>
                    <th>Signataires</th>
                    <th>Etat</th>
                    <th>Documment</th>
                    <th>Attestation de Signature</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{now()}}</td>
                    <td>recipent</td>
                    <td>Sadjo Bakari</td>
                    <td><span class="badge bg-danger">en cours</span></td>
                    <td><span class="mdi mdi-file-pdf-box mdi-36px"></span></td>
                    <td><span class="mdi mdi-close bg-danger"></span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
