@props(['products'])
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

    <x-modal/>
