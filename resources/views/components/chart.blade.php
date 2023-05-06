@props(['chart', 'month', 'sales'])
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Gross Income for the month of {{$month}}
            </div>
            <div class="card-body">{!! $chart->container() !!}</div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Total Sales for the month of {{$month}}
            </div>
            <div class="card-body">{!! $sales->container() !!}</div>
        </div>
    </div>
</div>

