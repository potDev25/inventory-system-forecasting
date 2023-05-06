<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4"><i class="fa-solid fa-cart-shopping text-primary"></i> Products</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Products</li>
    </ol>
    <a href="/add-product" class="btn btn-primary">Add Product</a>
    <div class="card mb-4">
        <div class="card-header d-flex text-light bg-dark">
            <div class="">
                <i class="fa-solid fa-plus-minus"></i>
                 <h6>Product Record</h6>
            </div>
            
        </div>
        <div class="card-body">
            <x-product-table :products="$products"/>
        </div>
    </div>  
    <br><br>
</x-layout>