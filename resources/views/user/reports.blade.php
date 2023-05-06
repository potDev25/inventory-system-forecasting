<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4">Reports</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    
        <div class="card mb-4" id="income">
            <div class="card-header d-flex">
                <div class="">
                    <i class="fas fa-chart-area me-1"></i>
                    Graph Report
                </div>
                <div class="ms-2">
                    
                </div>
                
            </div>
            <div class="card-body">{!! $chart->container() !!}</div>
        </div>

            <div class="card mb-4 p-2">
            <div class="card-header bg-dark text-light" id="table">
                <i class="fas fa-table me-1"></i>
                Data Table
            </div>
            <div class="card-body">
                <form action="">
                <table id="datatablesSimple" class="ui celled table">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Total Monthly Sales</th>
                            <th>Total Monthly Income</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Month</th>
                            <th>Total Monthly Sales</th>
                            <th>Total Monthly Income</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <form action="">
                    <input type="hidden" value="" id="date">
                    </form>
                    <tbody id="inventory-table">
                    
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $d->month }}</td>
                                <td>{{ $d->total_sales }}</td>
                                <td>{{ $d->total_income }}</td>
                                <td><a href="/create-inventory?code={{ $d->code }}" class="btn btn-primary">View Data</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                </form>
            </div>
            </div>

    {!! $chart->script() !!}
</x-layout>