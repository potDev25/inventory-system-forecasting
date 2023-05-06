<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4">Product Recieve</h1>
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
        <div class="card-header d-flex text-light bg-dark">
            <div class="">
                <i class="fa-solid fa-plus-minus"></i>
                 Date Entry <a href="/date-receive?user_id={{ auth()->user()->id }}&code=" class="btn btn-primary">Store Products</a>
            </div>
            
        </div>
    
    <table id="datatablesSimple" class="ui celled table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>

                @foreach ($dateReceived as $date)
                    <tr>
                        <td>{{ date('M-Y', strtotime($date->created_at))}}</td>
                        <td><a href="/date-receive?user_id={{ auth()->user()->id }}&code={{ $date->code }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td>
                    </tr>
                @endforeach
                
            </tbody>
    </table>

    <x-modal/>


</x-layout>

