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

    <br>
    <div>
    </div>
    <div class="card mb-4">
        <div class="card-header d-flex bg-dark text-light">
            <div class="">
                <i class="fa-solid fa-plus-minus"></i>
                Products
            </div>
            
        </div>
        <div class="card-body">
            <x-product-table :products="$products"/>
        </div>
    </div>

    <script>

        $(document).ready(function(){

            $('#category').on('change', function(){
                var category = $(this).val()
                alert(category)
            })

        })

    </script>
</x-layout>