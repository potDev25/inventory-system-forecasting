<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4">Inventory</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    
    <div class="card mb-4 p-2">
    <div class="card-header bg-dark text-light">
        <i class="fas fa-table me-1"></i>
        Inventory Table Date: {{ date('M-Y', strtotime($total_month->created_at))}}
        @if ($total_value == null)
        <button class="btn btn-warning" id="readonly"><i class="fa-solid fa-pen"></i> EDIT</button>
        <button class="btn btn-secondary" id="cancel" style="display: none"><i class="fa-solid fa-ban"></i> CANCEL</button>
        @elseif($total_value != null)
        <a href="/forecast-product?code={{ $code }}" class="btn btn-info"><i class="fa-solid fa-chart-line"></i> Forecast</a>
        @endif
    </div>
    <div class="card-body">
        <form action="/store-inventory" method="POST" id="form">
            @csrf
        <table id="datatablesSimple" class="ui celled table">
            <thead>
                <tr>
                    <th>PR ID</th>
                    <th>Product Name</th>
                    <th>Supplier</th>
                    <th>Sales</th>
                    <th>Product Remaining</th>
                    <th>Total Sales</th>
                    <th>Total Income</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>PR ID</th>
                    <th>Product Name</th>
                    <th>Supplier</th>
                    <th>Sales</th>
                    <th>Product Remaining</th>
                    <th>Total Sales</th>
                    <th>Total Income</th>
                </tr>
            </tfoot>
            <form action="">
            <input type="hidden" value="{{$date}}" id="date">
            </form>
            <tbody id="inventory-table">
            
                @foreach ($inventories as $inventory)
                    <tr>
                        <td><input type="text" name="product_id[]" value="{{ $inventory->product_id }}" readonly class="form-control"></td>
                        <td>{{ $inventory->product->product_name }}</td>
                        <td>{{ $inventory->product->supplier->supplier }}</td>
                        <td><center><span class="current" style="display: none">CURRENT SALES: {{ $inventory->sales }}</span></center><input type="number" class="form-control prod_id" name="sales[]" value="{{ $inventory->sales }}" required readonly></td>
                        <td>{{ $inventory->product->remaining_quantity }}</td>
                        <td>{{ $inventory->total_sales }}</td>
                        <td>{{ $inventory->income }}</td>
                    </tr>
                @endforeach
                    <tr class="bg-primary" style="background-color: rgb(105, 105, 232); color: #fffff;">
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" value="{{ $total_sales }}" class="form-control" readonly></td>
                        <td class="text-primary"><input type="text" value="{{ $sum }}" class="form-control" readonly></td>
                    </tr>
            </tbody>
        </table>
        @if ($total_value == null) 
        <button class="btn btn-primary mb-3" id="save" style="width: 100%" disabled>SAVE</button>
        @endif

        @if ($total_value == null)
        <form action="/total-value?code={{ $code }}" method="POST">
            @csrf
            <input type="hidden" name="total_income" value="{{ $sum }}" class="form-control" readonly>
            <input type="hidden" name="month" value="{{ date('M-Y', strtotime($total_month->created_at))}}" class="form-control" readonly>
            <input type="hidden" name="total_sales" value="{{ $total_sales }}" class="form-control" readonly>
            <button class="btn btn-secondary" style="width: 100%">Submit Total Sales And Total Income</button>
        </form>
        @endif
        </form>
    </div>
    </div>

    <div class="card">
        <div class="card-header">
            Product Graph
        </div>
        <div class="card-body">
            {!! $pr_gr->container() !!}
        </div>
    </div>

<x-modal/>

<script>

    $(document).ready(function(){
        $('#readonly').on('click', function(){
            $('.prod_id').removeAttr('readOnly')
            $('.prod_id').val('0')
            $('.current').show()
            $('#save').removeAttr('disabled')
            $('#readonly').hide()
            $('#cancel').show()
        })

        $('#cancel').on('click', function(){
            location.reload();
        })
    })

</script>
{!! $pr_gr->script() !!}
</x-layout>