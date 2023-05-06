<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4">Sales Inventory</h1>
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

    <div class="card mb-4">
        <div class="card-header d-flex">
            <div class="">
                <i class="fa-solid fa-plus-minus"></i>
                 Create Sales Inventory
            </div>
            
        </div>
        <div class="card-body">
            <form action="/add-date" method="POST">
                @csrf
                <div class="container px-4">
                    <div class="row gx-5">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Month</span>
                                <select class="form-control @error('month') is-invalid @enderror" aria-label="Username" aria-describedby="basic-addon1" name="month">
                                    <option value="" selected>--Month--</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            @error('month')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Year</span>
                                <select class="form-control @error('year') is-invalid @enderror" aria-label="Username" aria-describedby="basic-addon1" name="year">
                                    <option value="" selected>--Year--</option>
                                    
                                    @for ($i = 2022; $i <= 2050; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor

                                </select>
                            </div>
                            @error('year')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <br>
                    <button class="btn btn-primary">Submit</button>
                   <input type="hidden" name="user_id" value="{{auth()->id()}}">
                </div>
            </form>
        </div>
    </div>  

</x-layout>