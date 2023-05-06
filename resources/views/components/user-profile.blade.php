@props(['profile'])
<section class="vh-100" style="background-color: #f4f5f7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
    <form action="/update-profile" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="col mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">

              <img src="{{$profile->image ? asset('storage/'.$profile->image) : asset("https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp")}}"
                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />

              <h5>{{$profile->last_name}} {{$profile->first_name}}</h5>
              <p>Normal User</p>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <input type="email" name="email" class="form-control" value="{{$profile->email}}" readonly>
                  </div>
                </div>
                <h6>Name</h6>
                <hr class="mt-0 mb-4">
                
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Department/Business Name</h6>
                    <input type="text" name="business" class="form-control @error('business') is-invalid @enderror" value="{{$profile->business}}" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    </form>
  </div>
</section>