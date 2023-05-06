<!-- Modal -->
<div class="modal fade" id="delete-supplier1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="/delete-supplier" method="POST">
          @csrf
          <div class="container px-4">
            <input type="hidden" name="id" id="delete_id">
            Are you sure you want to delete this supplier?
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form> 
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-supplier1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="/edit-supplier" method="POST">
          @csrf
          <div class="container px-4">
            <input type="hidden" name="id" id="supplier_id">
              <div class="row gx-5">
                  <div class="col">
                      <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">Supplier</span>
                          <input type="text" class="form-control" placeholder="Name of the supplier" name="supplier" id="supplier">
                      </div>
                      @error('supplier')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                  </div>

                  <div class="col">
                      <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">Owner</span>
                          <input type="text" class="form-control" placeholder="Name of the Owner" name="owner" id="owner">
                      </div>
                      @error('owner')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                  </div>
              </div>

              <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Address</span>
                  <input type="text" class="form-control" placeholder="Address" name="address" id="address">
              </div>
              @error('address')
                  <span class="text-danger">{{$message}}</span>
              @enderror
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form> 
      </div>
    </div>
  </div>
</div>
