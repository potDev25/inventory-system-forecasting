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
            <form action="/store-product?code={{ $code }}" method="POST">
                @csrf
                <div class="container px-4">
                    <div class="row gx-5">
                       <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Product</span>
                                <select name="product_id" id="" class="form-control">
                                    <option value="" selected>Products</option>
                                    @forelse ($products as $product)
                                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @empty
                                        <option value="">You have no product entry</option>
                                    @endforelse
                                </select>
                            </div>
                             @error('product_id')
                                <span class="text-danger">{{$message}}</span>
                             @enderror
                        </div>

                         <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Barcode</span>
                                <input type="text" value="{{old('barcode')}}" class="form-control @error('barcode') is-invalid @enderror" placeholder="Product barcode" aria-label="Username" aria-describedby="basic-addon1" name="barcode">
                            </div>
                            @error('barcode')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Unit</span>
                        <select name="unit" id="" class="form-control">
                            <option value="" selected>Select Unit</option>
                            <option value="Pack">Pack</option>
                            <option value="Sock">Sock</option>
                            <option value="Box">Box</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"># Unit</span>
                        <input required type="number" value="{{old('unit')}}" class="form-control @error('unit') is-invalid @enderror" placeholder="Unit" aria-label="Username" aria-describedby="basic-addon1" name="no_unit">
                    </div>
                    @error('unit')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Quantity</span>
                        <input required type="number" value="{{old('stock')}}" class="form-control @error('stock') is-invalid @enderror" placeholder="Quantity Pcs" aria-label="Username" aria-describedby="basic-addon1" name="stock" id="stock">
                    </div>
                    @error('stock')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Original Price/Pcs</span>
                        <input required type="text" id="origanal_price" value="{{old('stock')}}" class="form-control @error('stock') is-invalid @enderror" placeholder="Original Price" aria-label="Username" aria-describedby="basic-addon1" name="original_price">
                    </div>
                    @error('stock')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                     <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Amount(Capital)</span>
                        <input type="text" value="{{old('amount')}}" id="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="Amount" aria-label="Username" aria-describedby="basic-addon1" name="amount" readonly>
                    </div>
                    @error('amount')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Expiration Date</span>
                        <input type="date" value="{{old('expiry_date')}}" class="form-control @error('expiry_date') is-invalid @enderror" placeholder="Expiration date" aria-label="Username" aria-describedby="basic-addon1" name="expiry_date">
                    </div>
                    @error('expiry_date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Selling Price</span>
                        <input type="text" value="{{old('stock')}}" class="form-control @error('price') is-invalid @enderror" placeholder="Selling price" aria-label="Username" aria-describedby="basic-addon1" name="price">
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

    <br>
    <div class="card mb-4">
        <div class="card-header d-flex bg-primary text-light">
            <div class="">
                <i class="fa-solid fa-plus-minus"></i>
                Stock In 
            </div>
            
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="ui celled table">
                <thead>
                    <tr>
                        <th>Barcode ID</th>
                        <th>Product Name</th>
                        <th>Date</th>
                        <th>Expiray Date</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Remaining Stock</th>
                        <th>Selling Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Barcode ID</th>
                        <th>Product Name</th>
                        <th>Date</th>
                        <th>Expiray Date</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Remaining Stock</th>
                        <th>Selling Price</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($data as $d)
                        <tr>
                            <td>{{$d->barcode}}</td>
                            <td>{{$d->product->product_name}}</td>
                            <td>{{ date('M-d-Y H:i:s', strtotime($d->created_at))}}</td>
                            <td>{{$d->expiry_date}}</td>
                            <td>{{$d->stock}}</td>
                            <td>{{$d->unit}}</td>
                             <td @if ($d->product->remaining_quantity <= 10)
                                class="bg-danger text-white"
                            @endif>{{$d->product->remaining_quantity}}</td>
                            <td>{{$d->price}}</td>
                            <td class="d-flex">
                                <form action="/delete-recieve?id={{$d->id}}" class="d-flex" method="POST">
                                    @csrf
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>

                                        <a href="/update-receive?id={{$d->id}}" class="btn btn-warning"><i class="fa-solid fa-pen"></i></a>

                                    </div>
                                </form>
                            </td>
                        </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            
            $('#origanal_price').on('change', function(){
                var stock = $('#stock').val()
                var original_price = $(this).val()
                
                var capital_amount = stock * original_price;

                $('#amount').val(capital_amount);
            })


        })
    </script>
</x-layout>