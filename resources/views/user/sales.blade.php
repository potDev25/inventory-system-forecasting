<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4">Sales Forecast</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row">

        <div class="col-md-6"><div class="card mb-4">
            <div class="card-header d-flex bg-primary text-light">
                <div class="">
                    Current Sales Value
                </div>
                
            </div>
            <div class="card-body">
                {!! $chart->container() !!}
            </div>
        </div></div>
        
            <div class="col-md-6"><div class="card mb-4">
                <div class="card-header d-flex bg-primary text-light">
                    <div class="">
                        Forecast Value
                    </div>
                    
                </div>
                <div class="card-body">
                    {!! $predict->container() !!}
                </div>
            </div>
        

    </div>

    <div class="card">

        <div class="card-header">
            Value
        </div>

        <div class="card-body">

            <table id="datatablesSimple" class="ui celled table">
                <thead>
                    <tr>
                        <th>Total Monthly Sales</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Total Monthly Sales</th>
                    </tr>
                </tfoot>
                <form action="">
                <input type="hidden" value="" id="date">
                </form>
                <tbody id="inventory-table">
                
                        @for ($i = 0; $i <= 11; $i++)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ number_format((float)$annual[$i], 2, '.', '') }}</td>
                            </tr>
                        @endfor

                </tbody>
            </table>

        </div>

    </div>

    
    {!! $chart->script() !!}
    {!! $predict->script() !!}
</x-layout>