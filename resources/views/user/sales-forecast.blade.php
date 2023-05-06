<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4">Forecast Result</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Forecast</li>
    </ol>
    <div class="row">
        <div class="card mb-4">
                <div class="card-header d-flex">
                    <div class="">
                        <i class="fas fa-chart-area me-1"></i>
                        Sales Report {{$rm}}
                    </div>
                    <div class="ms-2">
                      
                    </div>
                  
                </div>
                <div class="card-body">{!! $chart->container() !!}</div>
            </div>
    </div>
    {!! $chart->script() !!}
</x-layout>