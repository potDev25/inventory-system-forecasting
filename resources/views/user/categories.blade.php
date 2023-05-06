<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4">Categories</h1>
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
                 Add Product Categories
            </div>
            
        </div>
        <div class="card-body">
            <form action="/store-category" method="POST">
                @csrf
                <div class="container px-4">
                    <div class="row gx-5">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Product category</span>
                                <input type="text" class="form-control @error('product_category') is-invalid @enderror" placeholder="product category" aria-label="Username" aria-describedby="basic-addon1" name="product_category">
                            </div>
                            @error('product_category')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Product Description</span>
                        <textarea class="form-control @error('description') is-invalid @enderror" aria-label="With textarea" name="description"></textarea>
                    </div>
                    @error('description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <br>
                <button class="btn btn-primary">Save Category</button>
                </div>
               
            </form>
        </div>
    </div>

    <div class="card-body">
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>Category Id</th>
                <th>Product Category</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Category Id</th>
                <th>Product Category</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
                
            @forelse ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->product_category}}</td>
                    <td>{{$category->description}}</td>
                    <td>
                        <form action="/destroy-category?id={{$category->id}}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <p>You have no product categories</p>
            @endforelse
            
        </tbody>
    </table>
</div>

</x-layout>