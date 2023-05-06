<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4">Product Sales Forecast</h1>
    <h5 class="text-bold">Month of: {{ date('M-Y', strtotime($total_month->created_at))}}</h5>
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
    
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Current Value
                </div>
                <div class="card-body">
                    {!! $pr_gr->container() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Future Value
                </div>
                <div class="card-body">
                    {!! $pr_gr1->container() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">DATA</div>
        <div class="card-body">
            <h4>Value for Quarterly Forecast</h4>
            <ul class="list-group">
                @foreach ($getProduct as $item)
                    <li class="list-group-item">{{ $item->product_name }} : <span>{{ $item->total_sales }}</span></li>
                @endforeach
            </ul>

            <h4>Value for Annual Forecast</h4>
            <ul class="list-group">
            @foreach ($getProductAnnual as $item)
                <li class="list-group-item">{{ $item->product_name }} : <span>{{ $item->total_sales }}</span></li>
            @endforeach
            </ul>
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
{!! $pr_gr1->script() !!}
</x-layout>