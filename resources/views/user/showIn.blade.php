<x-layout :month="$month" :suppliers="$suppliers">
    <button onclick="history.back()" class="btn btn-info"><i class="fa-solid fa-backward"></i></button>
    <h1 class="mt-4">Stock In for the month of {{$date}}</h1>
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
        <div class="card-header d-flex bg-primary text-light">
            <div class="">
                <i class="fa-solid fa-plus-minus"></i>
                Stock In for the month of {{$date}}
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
                            <td>{{$d->date_received}}</td>
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
</x-layout>