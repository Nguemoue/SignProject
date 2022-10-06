<!DOCTYPE html>
<html>
<head>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

</head>
<body>

<div id="app">
    <v-app>
        <v-navigation-drawer inner app v-model="model.navigation">
            <v-app-bar>
                <v-toolbar-title>Menu</v-toolbar-title>
            </v-app-bar>
            <v-list>
                <a href="{{route('acceuil')}}" class="btn btn-success"><span class="mdi mdi-home"></span> Acceuil</a>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar app>
            <v-app-bar-nav-icon @click="model.navigation =! model.navigation"></v-app-bar-nav-icon>
            <img src="{{asset('logo.jpg')}}" width="50" alt="">
            <v-toolbar-title class="mx-4">
                Signature de Fichier
            </v-toolbar-title>
        </v-app-bar>
        <v-main app>
            <v-container fluid>
                <v-stepper v-model="e1">
                    <v-stepper-header flat>
                        <v-stepper-step :complete="e1 > 1" step="1">Charger le document</v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step :complete="e1 > 2" step="2">Saisissez les signataires</v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step step="3" :complete="e1>3">Positionner la signature</v-stepper-step>
                        <v-divider></v-divider>
                        <v-stepper-step step="4">Envoyer</v-stepper-step>
                    </v-stepper-header>

                    <v-stepper-items>
                        <v-stepper-content step="1">
                            <a href="#" class="text-success">Charger vos Documents a faire Signes</a>
                            <v-card class="mb-2" color="">
                                <v-card-title>Remplissez le formulaire</v-card-title>
                                <form action="">
                                    <v-text-field dense v-model="nomCollecte" outlined class="mb-2" append-icon="mdi-account" name="nom"
                                                  label="Nom de la collecte"></v-text-field>
                                    <v-file-input dense  v-model="filePdf" clearable counter counter-size-string
                                                  outlined prepend-icon="" show-size chips
                                                  label="selectionner un fichier"
                                                  prepend-inner-icon="mdi-file-pdf" accept="application/pdf">
                                    </v-file-input>
                                </form>
                            </v-card>
                            <v-btn
                                color="primary"
                                @click="e1 = 2"
                            >
                                Continue
                            </v-btn>

                            <v-btn text>Cancel</v-btn>
                        </v-stepper-content>

                        <v-stepper-content step="2">
                            <div>
                                <h1 class="mb-2 text-center">saisissez les signataires</h1>
                                <div class="form">
                                    <v-text-field dense v-model="nom" outlined label="nom" name="nom"></v-text-field>
                                    <v-text-field dense v-model="prenom" outlined label="prenom"
                                                  name="prenom"></v-text-field>
                                    <v-text-field dense outlined label="email" v-model="email" name="email"></v-text-field>
                                    <v-text-field dense outlined label="mobile" name="mobile" v-model="telephone" ></v-text-field>
                                    <v-text-field dense outlined label="SNI" name="cni"></v-text-field>
                                </div>
                            </div>

                            <v-btn color="success" sm @click="e1=1">precedent</v-btn>
                            <v-btn
                                color="primary"
                                @click="e1 = 3"
                            >
                                Continue
                            </v-btn>

                        </v-stepper-content>

                        <v-stepper-content step="3">
                            <h4 class="text-center">
                                indiquer sur chaque document ou vos correspondant doivent signer
                            </h4>
                            <div class="row">

                                <div class="col col-8">
                                    <div class="card">
                                        <canvas id="the-canvas">
                                        </canvas>
                                        <div>
                                            <button style="border: 1px solid black;margin: 4px; padding: 3px;"
                                                    id="prev">Previous
                                            </button>
                                            <button style="border: 1px solid black;margin: 4px; padding: 3px;"
                                                    id="next">Next
                                            </button>
                                            &nbsp; &nbsp;
                                            <span>Page: <span id="page_num"></span> / <span
                                                    id="page_count"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-4">
                                    <div class="mt-4">
                                        <br><br><br>
                                        <span class="text-success">glissez deposez les champs de signature un par un sur le document</span>
                                        <v-sheet class="px-4 py-4" color="orange" id="draggable"
                                                 class="ui-widget-content">
                                            @{{nom}} @{{prenom}}
                                        </v-sheet>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-2">
                            <v-btn
                                color="primary"
                                @click="e1 = 4"
                            >
                                Continue
                            </v-btn>

                        </v-stepper-content>
                        <v-stepper-content step="4">
                            <h5>Recapitulatif</h5>
                            <p class="text--accent-1">
                                verifier les informations de votre collecte puis valider
                            </p>

                            <div>
                                <em>Nom de Collecte : </em> @{{ nomCollecte }}
                            </div>
                            <div>
                                <em>Document a faire signe: </em> @{{ filePdf }}
                            </div>
                            <div>
                                Activer la verification par : <em>Email</em>
                            </div>
                            <table border="2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Ordre</th>
                                    <th>Prenom</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>@{{ prenom }}</td>
                                    <td>@{{ nom }}</td>
                                    <td>@{{ email }}</td>
                                    <td>@{{ telephone }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="{{route('acceuil')}}" class="btn btn-primary">valider</a>
                            <v-btn text>Cancel</v-btn>
                        </v-stepper-content>
                    </v-stepper-items>
                </v-stepper>
            </v-container>
        </v-main>
    </v-app>
</div>


<script>
    new Vue({
        el: '#app',
        data() {
            return {
                e1: 1,
                nom: null,
                email:null,
                telephone:null,
                nomCollecte:null,
                filePdf:null,
                prenom: null,
                model: {
                    navigation: false
                }
            }
        },
        vuetify: new Vuetify(),
    })
</script>
<script>
    // If absolute URL from the remote server is provided, configure the CORS
    // header on that server.
    var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';

    // Loaded via <script> tag, create shortcut to access PDF.js exports.
    var pdfjsLib = window['pdfjs-dist/build/pdf'];

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

    var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 0.8,
        canvas = document.getElementById('the-canvas'),
        ctx = canvas.getContext('2d');

    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num) {
        pageRendering = true;
        // Using promise to fetch the page
        pdfDoc.getPage(num).then(function (page) {
            var viewport = page.getViewport({scale: scale});
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function () {
                pageRendering = false;
                if (pageNumPending !== null) {
                    // New page rendering is pending
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });
        });

        // Update page counters
        document.getElementById('page_num').textContent = num;
    }

    /**
     * If another page rendering in progress, waits until the rendering is
     * finised. Otherwise, executes rendering immediately.
     */
    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    /**
     * Displays previous page.
     */
    function onPrevPage() {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    }

    document.getElementById('prev').addEventListener('click', onPrevPage);

    /**
     * Displays next page.
     */
    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    }

    document.getElementById('next').addEventListener('click', onNextPage);

    /**
     * Asynchronously downloads PDF.
     */
    pdfjsLib.getDocument(url).promise.then(function (pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('page_count').textContent = pdfDoc.numPages;

        // Initial/first page rendering
        renderPage(pageNum);
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function () {
        $("#draggable").draggable();
    });
</script>
</body>
</html>
