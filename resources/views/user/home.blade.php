<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4"><i class="fa-solid fa-gauge" style="color: blue"></i> Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <x-menu :actdate="$actdate"/>

    <div class="row gx-5">
        <div class="col">
            <div class="card mb-2 shadow p-3 bg-body rounded">
                <div class="card-header d-flex text-light bg-white text-dark">
                    <center>
                    <div class="d-flex">
                        <center><h3><i class="fa-solid fa-cart-shopping text-primary"></i> No. of Products</h3></center>
                    </div>
                    </center>
                    
                </div>
                <div class="card-body">
                <h2>{{$prod}}</h2>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-2 shadow p-3 bg-body rounded">
                <div class="card-header d-flex text-light bg-white text-dark">
                    <center>
                    <div class="d-flex">
                        <center><h3><i class="fa-solid fa-store"></i> No. Supplier</h3></center>
                    </div>
                    </center>
                    
                </div>
                <div class="card-body">
                    <h2>{{$sup}}</h2>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mb-2 shadow p-3 bg-body rounded">
                <div class="card-header d-flex text-light bg-white text-dark">
                    <center>
                    <div class="d-flex">
                        <center><h3><i class="fa-solid fa-tag text-danger"></i> No. of Product Category</h3></center>
                    </div>
                    </center>
                    
                </div>
                <div class="card-body">
                <h2>{{$cat}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow p-3 mb-5 bg-body rounded" style="width: 60%; margin: auto;">
        <div class="card-header d-flex text-light bg-white text-dark">
            <center>
            <div class="d-flex">
                <center><h3><i class="fa-solid fa-toilet-portable text-danger"></i> Out of stocks product</h3></center>
            </div>
            </center>
            
        </div>
        <div class="card-body">
          <table class="ui celled table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Remaining Stock</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($products as $product)
                <tr>
                    <td>{{$product->product_name}}</td>
                    <td @if($product->remaining_quantity <= 20)class="bg-danger" @endif>{{$product->remaining_quantity}}</td>
                </tr>
            @empty
                <h6>You have no products added yet!</h6>
                <a href="/add-inventory" class="btn primary"><i class="fa-solid fa-circle-plus"></i> Add?</a>
            @endforelse
        </tbody>
    </table>
        </div>
    </div>
</x-layout>