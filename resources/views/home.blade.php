@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="row">
                            @if(session('message'))
                                <div class="alert alert-success">
                                    {{session('message')}}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <h2>Lista de productos</h2>

                            <hr>
                            <br>
                            <p align="right">
                                {{--<a href="{{ route('areas.create') }}" class="btn btn-success">Capturar Área</a>--}}
                                <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
                                <a href="{{ route('products.create') }}" class="btn btn-success">Crear nuevo</a>
                            </p>
                        </div>
                        <div class="row">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Acciones</th>
                                    <th>Id</th>
                                    <th>Estante</th>
                                    <th>Nombre</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
                        <!--
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
                        -->
                        <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
                        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
                        <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
                        <script type="text/javascript">
                            var data = @json($products);

                            $(document).ready(function() {
                                $('#example').DataTable({
                                    "data": data,
                                    "pageLength": 100,
                                    "order": [
                                        [0, "desc"]
                                    ],
                                    "language": {
                                        "sProcessing": "Procesando...",
                                        "sLengthMenu": "Mostrar _MENU_ registros",
                                        "sZeroRecords": "No se encontraron resultados",
                                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                                        "sInfoPostFix": "",
                                        "sSearch": "Buscar:",
                                        "sUrl": "",
                                        "sInfoThousands": ",",
                                        "sLoadingRecords": "Cargando...",
                                        "oPaginate": {
                                            "sFirst": "Primero",
                                            "sLast": "Último",
                                            "sNext": "Siguiente",
                                            "sPrevious": "Anterior"
                                        },
                                        "oAria": {
                                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                        }
                                    },
                                    responsive: true,
                                    // dom: 'Bfrtip',
                                    dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
                                    buttons: [
                                        'copy', 'excel',
                                        {
                                            extend: 'pdfHtml5',
                                            orientation: 'landscape',
                                            pageSize: 'LETTER',
                                        }

                                    ]
                                })

                            });


                            jQuery.extend( jQuery.fn.dataTableExt.oSort, {
                                "portugues-pre": function ( data ) {
                                    var a = 'a';
                                    var e = 'e';
                                    var i = 'i';
                                    var o = 'o';
                                    var u = 'u';
                                    var c = 'c';
                                    var special_letters = {
                                        "Á": a, "á": a, "Ã": a, "ã": a, "À": a, "à": a,
                                        "É": e, "é": e, "Ê": e, "ê": e,
                                        "Í": i, "í": i, "Î": i, "î": i,
                                        "Ó": o, "ó": o, "Õ": o, "õ": o, "Ô": o, "ô": o,
                                        "Ú": u, "ú": u, "Ü": u, "ü": u,
                                        "ç": c, "Ç": c
                                    };
                                    for (var val in special_letters)
                                        data = data.split(val).join(special_letters[val]).toLowerCase();
                                    return data;
                                },
                                "portugues-asc": function ( a, b ) {
                                    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
                                },
                                "portugues-desc": function ( a, b ) {
                                    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
                                }
                            } );
                            //"columnDefs": [{ type: 'portugues', targets: "_all" }],

                        </script>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <p>Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis laboris ipsum velit id veniam. Quis ut consectetur adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu. Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint minim consectetur qui.</p>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <p>Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
