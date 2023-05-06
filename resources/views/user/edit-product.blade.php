<x-layout :month="$month" :suppliers="$suppliers">
    <button onclick="history.back()" class="btn btn-info"><i class="fa-solid fa-backward"></i></button>
    <h1 class="mt-4">Sales Forecast</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <h6>Upload Data Product</h6>
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <br>
    <div class="card mb-4">
        <div class="card-header d-flex">
            <div class="">
                <i class="fa-solid fa-plus-minus"></i>
                 Update Product
            </div>
            
        </div>
        <div class="card-body">
            <form action="/edit-product?product_id={{$product->id}}" method="POST">
                @csrf
                <div class="container px-4">
                    <div class="row gx-5">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Product name</span>
                                <input value="{{$product->product_name}}" type="text" class="form-control @error('product_name') is-invalid @enderror" placeholder="product name" aria-label="Username" aria-describedby="basic-addon1" name="product_name">
                            </div>
                            @error('product_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col">
                             <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Product category</span>
                                <select name="product_category" id="" class="form-control">
                                    <option value="{{$product->product_category}}" selected>{{$product->product_category}}</option>
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
                        <span class="input-group-text" id="basic-addon1">Remaining Stock</span>
                        <input readonly value="{{$product->remaining_quantity}}" type="text" class="form-control @if($product->remaining_quantity <= 20) is-invalid @endif" placeholder="category" aria-label="Username" aria-describedby="basic-addon1" name="">
                    </div>
                    @error('product_category')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text">Product Description</span>
                        <textarea class="form-control @error('product_description') is-invalid @enderror" aria-label="With textarea" name="product_description">{{$product->product_description}}</textarea>
                    </div>
                    @error('product_description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                
                    <br>
                    <button class="btn btn-primary">Submit</button>
                   <input type="hidden" name="user_id" value="{{auth()->id()}}">
                </div>

            </form>
        </div>
    </div>

</x-layout>