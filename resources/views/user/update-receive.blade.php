<x-layout :month="$month" :suppliers="$suppliers">
    <button onclick="history.back()" class="btn btn-info"><i class="fa-solid fa-backward"></i></button>
    <h1 class="mt-4">Product Manager</h1>
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

    <div class="card mb-4">
        <div class="card-header d-flex">
            <div class="">
                <i class="fa-solid fa-plus-minus"></i>
                 Store Products
            </div>
            
        </div>
        <div class="card-body">
            <form action="/edit-recieve?id={{$dateReceived->id}}" method="POST">
                @csrf
                <input type="hidden" value="{{$dateReceived->product_id}}" name="product_id">
                <div class="container px-4">
                    <div class="row gx-5">
                       <div class="col">
                            <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Product Name</span>
                                <input type="text" readonly value="{{$dateReceived->product->product_name}}" class="form-control"placeholder="Product barcode" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        </div>

                         <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Barcode</span>
                                <input type="text" value="{{$dateReceived->barcode}}" class="form-control @error('barcode') is-invalid @enderror" placeholder="Product barcode" aria-label="Username" aria-describedby="basic-addon1" name="barcode">
                            </div>
                            @error('barcode')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Unit</span>
                        <input type="text" value="{{$dateReceived->unit}}" class="form-control @error('unit') is-invalid @enderror" placeholder="Unit" aria-label="Username" aria-describedby="basic-addon1" name="unit">
                    </div>
                    @error('unit')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                     <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Amount(Capital)</span>
                        <input type="text" value="{{$dateReceived->amount}}" class="form-control @error('amount') is-invalid @enderror" placeholder="Amount" aria-label="Username" aria-describedby="basic-addon1" name="amount">
                    </div>
                    @error('amount')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Expiration Date</span>
                        <input type="date" value="{{$dateReceived->expiry_date}}" class="form-control @error('expiry_date') is-invalid @enderror" placeholder="Expiration date" aria-label="Username" aria-describedby="basic-addon1" name="expiry_date">
                    </div>
                    @error('expiry_date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Quantity</span>
                        <input type="text" value="{{$dateReceived->stock}}" class="form-control @error('stock') is-invalid @enderror" placeholder="Quantity Stocks" aria-label="Username" aria-describedby="basic-addon1" name="stock">
                    </div>
                    @error('stock')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Selling Price</span>
                        <input type="text" value="{{$dateReceived->price}}" class="form-control @error('price') is-invalid @enderror" placeholder="Selling price" aria-label="Username" aria-describedby="basic-addon1" name="price">
                    </div>
                    @error('price')
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