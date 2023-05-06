<x-layout :month="$month" :suppliers="$suppliers">
    <button onclick="history.back()" class="btn btn-info" id="back"><i class="fa-solid fa-backward"></i></button>
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
    <button class="btn btn-secondary" id="print-btn">Print</button>
    <div class="card mb-4" id="print">
        <div class="card-header d-flex bg-dark text-light">
            <div class="d-flex">
                {{ $supplier_name->supplier }} Date: {{ date('M-d-Y ', strtotime($date->created_at)) }}
            </div>
            
        </div>
        <div class="card-body">
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Supplier</th>
                        <th>Qnty/Unit</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                           
                    @foreach ($products as $product)
                        <tr>

                            <td>{{ $product->product->product_name }}</td>
                            <td>{{ $product->product->supplier->supplier }}</td>
                            <td>{{ $product->qnty }}</td>
                            <td>

                                <input type="checkbox" name="" id="" disabled class="border border-secondary">

                            </td>

                        </tr>
                    @endforeach
                    
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        
        $(document).ready(function(){
            $('#print-btn').on('click', function(){
                print();
            })
        })
        
    </script>
</x-layout>

