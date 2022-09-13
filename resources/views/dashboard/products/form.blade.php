@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
{{--    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">--}}
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

@stop

@section('content')
    <section class="content">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputStatus">Type</label>
                                        <select name="type" class="form-control custom-select" name="drpDown" id="drpDown">
                                            <option value="1">Single product</option>
                                            <option value="2">Variable product</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Image</label>
                                        {{--                            <input>--}}
                                        <input type="file" name="image" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Name</label>
                                        <input type="text" name="name" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Code</label>
                                        <input type="text" name="code" id="inputName" class="form-control">
                                    </div>

                                    {{--                        <div class="form-group">--}}
                                    {{--                            <label for="inputStatus">Status</label>--}}
                                    {{--                            <select id="inputStatus" class="form-control custom-select">--}}
                                    {{--                                <option selected disabled>Select one</option>--}}
                                    {{--                                <option>On Hold</option>--}}
                                    {{--                                <option>Canceled</option>--}}
                                    {{--                                <option>Success</option>--}}
                                    {{--                            </select>--}}
                                    {{--                        </div>--}}

                                    <div class="form-group">
                                        <label for="inputStatus">Barcode Symbology</label>
                                        <select id="inputStatus" name="barcode" class="form-control custom-select">
                                            <option value="barcode128">barcode 128</option>
                                            <option value="qrcode">qrcode</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">price modal</label>
                                        <input type="text" name="price_modal" id="inputName" class="form-control">
                                    </div> <div class="form-group">
                                        <label for="inputName">price sale</label>
                                        <input type="text" name="price" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">Categories</label>
                                        <select id="inputStatus" name="category" class="form-control custom-select">
                                            {{--                                <option selected disabled>Select one</option>--}}
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">Description</label>
                                        <textarea id="summernote" name="dsc">
                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                </textarea>
                                    </div>


                                    {{--                        <div class="form-group">--}}
                                    {{--                            <label for="inputStatus">Tags</label>--}}
                                    {{--                            <select id="inputStatus" name="tag" class="form-control custom-select">--}}
                                    {{--                                @foreach($tags as $tag)--}}
                                    {{--                                    <option value="{{$tag->id}}">{{$tag->name}}</option>--}}
                                    {{--                                @endforeach--}}
                                    {{--                            </select>--}}
                                    {{--                        </div>--}}
                                    {{--                        <div class="form-group">--}}
                                    {{--                            <label for="inputDescription">Project Description</label>--}}
                                    {{--                            <textarea id="inputDescription" class="form-control" rows="4"></textarea>--}}
                                    {{--                        </div>--}}
                                    {{--                        <div class="form-group">--}}
                                    {{--                            <label for="inputStatus">Status</label>--}}
                                    {{--                            <select id="inputStatus" class="form-control custom-select">--}}
                                    {{--                                <option selected disabled>Select one</option>--}}
                                    {{--                                <option>On Hold</option>--}}
                                    {{--                                <option>Canceled</option>--}}
                                    {{--                                <option>Success</option>--}}
                                    {{--                            </select>--}}
                                    {{--                        </div>--}}
                                    {{--                        <div class="form-group">--}}
                                    {{--                            <label for="inputClientCompany">Client Company</label>--}}
                                    {{--                            <input type="text" id="inputClientCompany" class="form-control">--}}
                                    {{--                        </div>--}}
                                    {{--                        <div class="form-group">--}}
                                    {{--                            <label for="inputProjectLeader">Project Leader</label>--}}
                                    {{--                            <input type="text" id="inputProjectLeader" class="form-control">--}}
                                    {{--                        </div>--}}
                                </div>
                            </div>

{{--                            <select class="bootstrap-select" name="drpDown" id="drpDown">--}}
{{--                                <option value="1" selected="selected">Feature 1</option>--}}
{{--                                <option value="2">Feature 2</option>--}}
{{--                                <option value="3">Feature 3</option>--}}
{{--                                <option value="4">Feature 4</option>--}}
{{--                            </select>--}}

{{--                            <div>--}}
{{--                                <p id="1">Text1</p>--}}
{{--                            </div>--}}


                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">quantity</label>
                                        <input type="text" name="quantity" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group" name="ggg" id="ggg">
                                        <label for="inputName">Combo product</label>
                                        <div>
{{--                                            <p>Text2</p>--}}
                                                <table class="table table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <th width="300px">Poduct name</th>
                                                        <th width="100px">Quantity</th>
                                                        <th width="80px"></th>
                                                    </tr>
                                                    </thead>
                                                    <!--elemet sebagai target append-->
                                                    <tbody id="itemlist">
                                                    <tr>
                                                        <td><input name="jenis_input[0]" class="form-control" /></td>
                                                        <td><input name="jumlah_input[0]" class="form-control" /></td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a class="btn btn-small btn-default" onclick="additem(); return false">+<i class="glyphicon glyphicon-plus"></i></a>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                        </div>
                                    </div>


                                </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success float-right"> Save </button>
                </div>
            </div>
        </form>
    </section>
@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>

    <script> console.log('Hi!'); </script>


    <script>


        var i = 1;
        function additem() {
            var itemlist = document.getElementById('itemlist');

//                membuat element
            var row = document.createElement('tr');
            var jenis = document.createElement('td');
            var jumlah = document.createElement('td');
            var aksi = document.createElement('td');

//                meng append element
            itemlist.appendChild(row);
            row.appendChild(jenis);
            row.appendChild(jumlah);
            row.appendChild(aksi);

//                membuat element input
            var jenis_input = document.createElement('input');
            jenis_input.setAttribute('name', 'jenis_input[' + i + ']');
            jenis_input.setAttribute('class', 'form-control');

            var jumlah_input = document.createElement('input');
            jumlah_input.setAttribute('name', 'jumlah_input[' + i + ']');
            jumlah_input.setAttribute('class', 'form-control');

            var hapus = document.createElement('span');

            jenis.appendChild(jenis_input);
            jumlah.appendChild(jumlah_input);
            aksi.appendChild(hapus);

            hapus.innerHTML = '<button class="btn btn-small btn-default">hapus</button>';
//                Aksi Delete
            hapus.onclick = function () {
                row.parentNode.removeChild(row);
            };

            i++;
        }


        $(function () {
            $('#ggg').hide();
            $('#drpDown').change(function() {
                // $('p').hide();
                var a = $(this).val();
                if(a == '1'){

                    $('#ggg').hide();
                }else {
                    $("#ggg").show();
                }
            })



            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });


        })
    </script>
@stop
