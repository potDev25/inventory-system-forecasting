<div class="card mb-4 p-2">
<div class="card-header">
    <i class="fas fa-table me-1"></i>
    Users Table
</div>
<div class="card-body">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
    <table id="datatablesSimple">
        <thead>
            <tr>
                <th>User</th>
                <th>Business</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>User</th>
                <th>Business</th>
                <th>email</th>
                <th>Verified</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>

            @forelse ($users as $user)
                <tr @if(!$user->allow) class="bg-danger" @endif>
                    <td class="d-flex align-itmes-center">
                        <img class="" src="{{$user->image ? asset('storage/'.$user->image): asset('https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp')}}" alt="" style="height: 50px; width: 30px; border-radius: 50%;">
                        <p class="mt-3 ml-2"> {{$user->last_name}} {{$user->first_name}}</p>
                    </td>
                    <td>
                        {{$user->business}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td class="">
                        @if (!$user->email_verified)
                            <span class="btn btn-warning font-sm"><i class="fa-solid fa-circle-exclamation"></i></span>
                        @else
                            <p class="btn btn-success"><i class="fa-solid fa-circle-check"></i></p>
                        @endif
                    </td>
                    <td class="">
                        @if (!$user->active)
                            <span class="btn btn-warning font-sm" style="font-size: .5rem">Offline</span>
                        @else
                            <p class="btn btn-success" style="font-size: .5rem">Active</p>
                        @endif
                    </td>
                    <td>
                        <form action="/admin-block?id={{$user->id}}" method="POST">
                            @csrf
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/user-profile?id={{$user->id}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>

                                @if (!$user->allow)
                                    <button class="btn btn-warning"><i class="fa-solid fa-circle-check"></i></button>
                                @else
                                    <button class="btn btn-warning"><i class="fa-solid fa-circle-xmark"></i></button>
                                @endif
                            </div>
                        </form>
                    </td>
                </tr>
            @empty
                
            @endforelse
            
        </tbody>
    </table>
</div>
</div>