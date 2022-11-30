<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Live !! Partie</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4 text-center">Bienvenue {{ auth()->user()->name}} c'est partie pour le live !!!!</h1>
        <div class="card shadow">
            <div class="card-header">
                <h4 class="card-title">Titre du live</h4>
            </div>
            <div class="card-body shadow">
                <fieldset>
                    <legend class="mb-4">Details sur le live</legend>
                    <div class="form-group">
                        <label for="titre">Titre du live</label>
                        <input type="text" name="titre" class="form-control" id="titre">
                    </div>
                    <div class="form-group">
                        <label for="titre">Lien</label>
                        <input type="url" name="lien" class="form-control" id="lien">
                    </div>

                    <button tabindex="1" type="button" class="btn btn-success" id="submitButton">Valider</button>
                </fieldset>
            </div>
        </div>
    </div>
	<script src="{{asset('js/live.js')}}"></script>
</body>
</html>
