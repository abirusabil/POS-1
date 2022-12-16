@extends('adminlte::page')

@section('title', 'Purchase')

@section('content_header')
@stop
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <h3 class="card-title">Purchase Product</h3>
            </div> 
        </div>
        <!-- /.card-header -->
        <div class="card-body ">  
            <form action="{{ route('products.updatepurchase') }}" method="post">
                @csrf
                <div class="form-group mb-3 px-3">
                    <label for="product_id" class="form_label">Product</label>
                    <div class="search_select_box ">
                        <select data-live-search="true"  name="product_id"  id="product_id"  class="form-select w-100 border rounded" aria-label="Default select example">
                            <option selected>Choice Product</option>
                            @foreach ($products as $product)
                             <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group mb-3 px-3">
                    <label for="size" class="form_label">Size</label>
                    <select  data-live-search="true" class="form-select  w-100 border rounded p-2" name="size"  id="size">
                        <option selected value="-">Choice Size</option>
                    </select>
                </div>
                <div class="mb-3 px-3">
                  <label for="price_modal" class="form-label">Price Modal</label>
                  <input type="text" class="form-control"  id="price_modal" name="price_modal" readonly>
                  <input type="hidden" class="form-control" id="name" name="name" readonly>
                  <input type="hidden" name="image" id="image" class="form-control" readonly>
                  <input type="hidden" name="old_qty" id="old_qty" class="form-control" readonly>
                </div>
                <div class="mb-3 px-3">
                    <label for="qty" class="form-label">Quantity</label>
                    <input type="text" class="form-control" name="qty" id="qty">
                </div>
                <button type="submit" class="btn ml-3 btn-primary">Submit</button>
              </form>
           
        </div>

    </div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>

    $(document).ready(function(){
        $('.search_select_box select').selectpicker();

        $('#product_id').on('change', function(e){
            const productId = e.target.value;
            const productName = document.querySelector('#name');
            const productSize = document.querySelector('#size');
            const productPriceModal = document.querySelector('#price_modal');
            const productImage = document.querySelector('#image');
            const productOldQty = document.querySelector('#old_qty');

            const REQUEST_URL = `https://workethicstudio.com/wp-json/wc/v3/products/${productId}?consumer_key=ck_d0af19fdc508051a34b90ba681635e0b4bcc882a&consumer_secret=cs_4aea9aeb04000260238cdaa19995fe8ffdac2c80`;

            fetch(REQUEST_URL)
            .then(res => res.json())
            .then(function(res){
                const sizes = res.attributes[0]?.options;
                let sizeElements = '';

                productPriceModal.value = res.price;
                productOldQty.value = res.stock_quantity;
                productName.value = res.name;
                productImage.value = res.images[0].src;

                sizes?.forEach(function(size){
                    sizeElements += `
                        <option value="${size}">${size}</option>
                    `;
                });

                $('#size').append(sizeElements);


                // console.log(sizes, sizeElements);
            });
        });
    });

</script>
@stop
