<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4">Sales Forecast</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row gx-5">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex bg-primary text-light">
                    <div class="">
                        <form action="" class="d-flex">
                            <select name="date" id="" class="form-control">
                                <option value="{{$month->date}}" selected>{{$month->date}}</option>
                                @foreach ($date as $d)
                                    <option value="{{$d->date}}">{{$d->date}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-warning">Quarter Forecast</button>
                        </form>
                    </div>
                    
                </div>
                <div class="card-body">
                    {!! $sales->container() !!}
                </div>
            </div>
        </div>

        <div class="col">
           <div class="card mb-4">
                <div class="card-header d-flex bg-primary text-light">
                    <div class="">
                        <h2>Forecast result</h2>
                    </div>
                    
                </div>
                <div class="card-body">
                    {!! $result->container() !!}
                </div>
            </div>
        </div>

    </div>
    
    {!! $sales->script() !!}
    {!! $result->script() !!}

</x-layout>