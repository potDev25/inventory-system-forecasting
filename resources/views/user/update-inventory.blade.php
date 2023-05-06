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
            <form action="/edit-inventery?inventory_id={{$id}}" method="POST">
                @csrf
                <div class="container px-4">
                    <div class="row gx-5">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Date</span>
                                <input readonly value="{{$inventory->date}}" readonly type="text" class="form-control @error('product_name') is-invalid @enderror" placeholder="product name" aria-label="Username" aria-describedby="basic-addon1" name="product_name">
                            </div>
                            @error('product_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                   
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Product Name</span>
                        <input value="{{$inventory->product->product_name}}" readonly type="text" class="form-control @error('quantity_stock') is-invalid @enderror" placeholder="category" aria-label="Username" aria-describedby="basic-addon1" name="product_name">
                    </div>
                    @error('quantity_stock')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Product Name</span>
                        <input value="{{$inventory->product->remaining_quantity}}" readonly type="text" class="form-control @error('quantity_stock') is-invalid @enderror" placeholder="category" aria-label="Username" aria-describedby="basic-addon1" name="product_name">
                    </div>
                    @error('quantity_stock')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Quantity</span>
                        <input value="{{$inventory->income}}" readonly type="text" class="form-control @error('selling_price') is-invalid @enderror" placeholder="category" aria-label="Username" aria-describedby="basic-addon1" name="quantity">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Tax 5%</span>
                        <input value="{{$inventory->total_sales}}" readonly type="text" class="form-control @error('selling_price') is-invalid @enderror" placeholder="category" aria-label="Username" aria-describedby="basic-addon1" name="tax5">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Sales</span>
                        <input value="{{$inventory->sales}}" type="text" class="form-control @error('sales') is-invalid @enderror" placeholder="category" aria-label="Username" aria-describedby="basic-addon1" name="sales">
                    </div>
                    
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                   <input type="hidden" name="user_id" value="{{auth()->id()}}">
                </div>

            </form>
        </div>
    </div>

</x-layout>