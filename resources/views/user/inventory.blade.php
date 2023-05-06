<x-layout :month="$month" :suppliers="$suppliers">
    <h1 class="mt-4"><i class="fa-solid fa-coins text-primary"></i> Sales Inventory</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="mb-3">

       

    </div>
    <div class="card mb-4 p-2">
    <div class="card-header bg-dark text-light">
        <i class="fas fa-table me-1"></i>
        Inventory Table
    </div>
    <div class="card-body">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
        <form action="">
        <table id="datatablesSimple" class="ui celled table">
            <thead>
                <tr>
                <th>Date Stock In</th>
                <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Date Stock In</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>

                @forelse ($inventories as $inventory)
                    <tr>
                        <td>{{ date('M-d-Y H:i:s', strtotime($inventory->created_at))}}</td>
                        <td class="d-flex">
                            <form action="/delete-inventory?id={{$inventory->id}}" class="d-flex" method="POST">
                                @csrf
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a class="btn btn-primary" href="/create-inventory?code={{$inventory->code}}"><i class="fa-solid fa-eye"></i></a>
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <h6>No inventory added</h6>
                @endforelse
            </tbody>
        </table>
        </form>
    </div>
    </div>
</x-layout>