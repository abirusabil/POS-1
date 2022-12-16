@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
{{--    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">--}}
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

@stop

@section('content')
    <section class="content">
        <form action="{{(($data != null) ? route('products.update',$data->id) : route('products.store'))}}" method="post" enctype="multipart/form-data">
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
                                    @if($data == null)
                                        <div class="form-group">
                                            <label for="inputStatus">Type</label>
                                            <select name="type" class="form-control custom-select" name="drpDown" id="drpDown" readonly>
                                                <option value="2">Variable product</option>
                                                <option value="1">Single product</option>                                               
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="inputName">Image</label>
                                        {{--                            <input>--}}
                                        <input type="file" name="image" multiple="multiple" id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Name</label>
                                        <input type="text" name="name" id="inputName" value="{{($data != null) ? $data->name : ''}}" class="form-control">
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
                                        <input type="text" name="price_modal" value="{{($data != null) ? $sql->price_modal : ''}}" id="price_modal" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="sale">price sale</label>
                                        <input type="text" name="price_sale" value="{{($data != null) ? $sql->price_sale : ''}} " id="price_sale" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">Categories</label>
                                        <select id="inputStatus" name="category" class="form-control custom-select">
                                            <option value="{{($data != null) ? $data->categories[0]->id : ''}}">{{($data != null) ? $data->categories[0]->name : ''}}</option>

                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">Description</label>
                                        <textarea id="summernote" name="dsc">
                                            {{($data != null) ? $data->short_description : ''}}
                                </textarea>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="card-body">
                                    {{-- <div class="form-group">
                                        <label for="inputName">quantity</label>
                                        <input type="text" name="quantity" value="{{($data != null) ? $data->stock_quantity : ''}} " id="inputName" class="form-control">
                                    </div> --}}
                                    
                                    {{-- <input type="hidden" name="quantity" value="{{($data != null) ? $data->stock_quantity : ''}} " id="inputName" class="form-control"> --}}
                                    <div class="form-group" name="ggg" id="ggg" style="display:{{ ($data != null && $data->type === "simple") ? "none" : ''}}">
                                        <label for="inputName">Chose Size</label>
                                        <div>
                                            <ul class="list-group">
                                               
                                                <li class="list-group-item mt-2 border rounded p-1">
                                                    <input class="form-check-input ml-1" type="checkbox" name=size[] id="size" @checked(($type && array_search('S',$attributes) != "" ) ? true : false) value="S">
                                                    <label class="form-check-label ml-4" for="flexSwitchCheckDefault">S</label>
                                                </li>
                                                <li class="list-group-item mt-2 border rounded p-1">
                                                    <input class="form-check-input ml-1" type="checkbox" name=size[] id="size" @checked(($type && array_search('M',$attributes) !=  "") ? true : false) value="M">
                                                    <label class="form-check-label ml-4" for="flexSwitchCheckDefault">M</label>
                                                </li>
                                                <li class="list-group-item mt-2 border rounded p-1">
                                                    <input class="form-check-input ml-1" type="checkbox" name=size[] id="size" @checked(($type && array_search('L',$attributes) !=  "") ? true : false ) value="L">
                                                    <label class="form-check-label ml-4" for="flexSwitchCheckDefault">L</label>
                                                </li>
                                                <li class="list-group-item mt-2 border rounded p-1">
                                                    <input class="form-check-input ml-1" type="checkbox" name=size[] id="size" @checked(($type && array_search('XL',$attributes) != "" ) ? true : false ) value="XL">
                                                    <label class="form-check-label ml-4" for="flexSwitchCheckDefault">XL</label>
                                                </li>
                                                <li class="list-group-item mt-2 border rounded p-1">
                                                    <input class="form-check-input ml-1" type="checkbox" name=size[] id="size" @checked(($type && array_search('XXL',$attributes) != "" ) ? true : false ) value="XXL">
                                                    <label class="form-check-label ml-4" for="flexSwitchCheckDefault">XXL</label>
                                                </li>
                                                <li class="list-group-item mt-2 border rounded p-1">
                                                    <input class="form-check-input ml-1" type="checkbox" name=size[] id="size" @checked(($type && array_search('XXXL',$attributes) != "" ) ? true : false) value="XXXL">
                                                    <label class="form-check-label ml-4" for="flexSwitchCheckDefault">XXXL</label>
                                                </li>
                                            </ul>
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
                <div class="col-12 mb-3 ml-2">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success float-right ml-2"> Save </button>
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
            // var size = document.createElement('td');
            var aksi = document.createElement('td');

            jenis.setAttribute('class', 'px-1');
            // jumlah.setAttribute('class', 'px-1');

            jenis.innerHTML = `
                <select name="jenis_input[${i}]" class="form-control form-select-lg px-1" aria-label="Default select example">
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="XXXL">XXXL</option>
                </select>
            `;

//                meng append element
            itemlist.appendChild(row);
            row.appendChild(jenis);
            // row.appendChild(jumlah);
            // row.appendChild(size);
            row.appendChild(aksi);

//                membuat element input
            // var jenis_input = document.createElement('input');
            // jenis_input.setAttribute('name', 'jenis_input[' + i + ']');
            // jenis_input.setAttribute('class', 'form-control px-1');

            var jumlah_input = document.createElement('input');
            jumlah_input.setAttribute('name', 'jumlah_input[' + i + ']');
            jumlah_input.setAttribute('class', 'form-control px-1');

            var hapus = document.createElement('span');

            // jenis.appendChild(jenis_input);
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
