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

              <img src="{{Auth::guard('web')->user()->image ? asset('storage/'.Auth::guard('web')->user()->image) : asset("https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp")}}"
                alt="Avatar" class="img-fluid my-5" style="width: 80px;" />

              <h5>{{Auth::guard('web')->user()->last_name}} {{Auth::guard('web')->user()->first_name}}</h5>
              <p>Normal User</p>
              <input type="file" name="image" class="btn btn-primary @error('image') is-invalid @enderror">
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <input type="email" name="email" class="form-control" value="{{Auth::guard('web')->user()->email}}">
                  </div>
                </div>
                <h6>Name</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Last Name</h6>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{Auth::guard('web')->user()->last_name}}">
                  </div>
                  <div class="col-6 mb-3">
                     <h6>First Name</h6>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{Auth::guard('web')->user()->first_name}}">
                  </div>
                </div>
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Department/Business Name</h6>
                    <input type="text" name="business" class="form-control @error('business') is-invalid @enderror" value="{{Auth::guard('web')->user()->business}}">
                  </div>
                </div>
                <div class="d-flex justify-content-start">
                  <button class="btn btn-primary">Update Profile</button>
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