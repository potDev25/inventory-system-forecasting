<x-layout :month="$month" :suppliers="$suppliers">
    <button onclick="history.back()" class="btn btn-info"><i class="fa-solid fa-backward"></i></button>
    <h1 class="mt-4">Supplier: {{ $supplier_name->supplier }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
    </ol>
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>

    <br>
    <div class="card mb-4">
        <div class="card-header d-flex bg-dark text-light">
            <div class="d-flex">
                <button class="btn btn-primary" id="add-btn" value="{{ $supplier_id }}">Add New Product</button>
                <a class="btn btn-secondary" href="/buy-product?id={{ $supplier_id }}">Order Product</a>
            </div>
            
        </div>
        <div class="card-body">
            
            <table id="datatablesSimple" class="ui celled table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Remaining Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Remaining Stock</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
        
                    @forelse ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_category}}</td>
                            <td @if($product->remaining_quantity <= 20)class="bg-danger" @endif>{{$product->remaining_quantity}}</td>
                            <td>
                            <center>
                                <form action="/delete-product?id={{$product->id}}" class="d-flex" method="POST">
                                    @csrf
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="/update-product?product_id={{$product->id}}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>
                                        <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </form>
                            </center>
                            </td>
                        </tr>
                    @empty
                        <h6>You have no products added yet!</h6>
                        <a href="/add-inventory" class="btn primary"><i class="fa-solid fa-circle-plus"></i> Add?</a>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $('#add-btn').on('click', function(){

                var supplier_id = $(this).val();
                
                $('#supplier_id').val(supplier_id)
                $('#add').modal('show');
            })

            $('#create_product').on('submit', function(e){
                
            })

        })

    </script>
</x-layout>

<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          

            <form action="/manual-product?supplier_id={{ $supplier_id }}" id="create_product" method="POST">
                @csrf
                <input type="hidden" name="supplier_id" id="supplier_id">
                <div class="container px-4">
                    <div class="row gx-5">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Product name</span>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" placeholder="product name" aria-label="Username" aria-describedby="basic-addon1" name="product_name" required>
                            </div>
                            @error('product_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                       <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Product category</span>
                                <select name="product_category" id="" class="form-control" required>
                                    <option value="" selected>Select product category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->product_category}}">{{$category->product_category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('product_category')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Product Description</span>
                        <textarea class="form-control @error('product_description') is-invalid @enderror" aria-label="With textarea" name="product_description" required></textarea>
                    </div>
                    @error('product_description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <br>
                </div>


        </div>
        <div class="modal-footer bg-info">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
        </div>
      </div>
    </div>
  </div>