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
                 Add new supplier
            </div>
            
        </div>
        <div class="card-body">
            <form action="/store-supplier" method="post">
                @csrf
                <div class="container px-4">
                    <div class="row gx-5">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Supplier</span>
                                <input type="text" class="form-control" placeholder="Name of the supplier" name="supplier">
                            </div>
                            @error('supplier')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Owner</span>
                                <input type="text" class="form-control" placeholder="Name of the Owner" name="owner">
                            </div>
                            @error('owner')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Address</span>
                        <input type="text" class="form-control" placeholder="Address" name="address">
                    </div>
                    @error('address')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                    <br>
                    <button class="btn btn-primary">ADD</button>
                   <input type="hidden" name="user_id" value="{{auth()->id()}}">
                </div>
            </form>
        </div>
    </div>  

   

    <div class="card bg-info">

        <div class="card-header text-uppercase text-white">Supplier</div>
        <div class="card-body bg-white">

            <table id="datatablesSimple" class="ui celled table">
                <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Owner</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Supplier</th>
                        <th>Owner</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
    
                   @foreach ($suppliers as $supplier)
                       
                        <tr>

                            <td>{{ $supplier->supplier }}</td>
                            <td>{{ $supplier->owner }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>

                                <div class="d-flex">

                                    <button class="btn btn-danger delete_supplier" value="{{ $supplier->id }}"><i class="fa-solid fa-trash-can"></i> Delete</button>

                                </div>

                            </td>

                        </tr>


                   @endforeach
                    
                </tbody>
            </table>

        </div>

    </div>
    <script>


        $(document).ready(function(){

            $('.edit_supplier').on('click', function(){

                var id = $(this).val();
                var supplier = $(this).data('supplier');
                var owner = $(this).data('owner');
                var address = $(this).data('address');
        
                $('#supplier_id').val(id);
                $('#supplier').val(supplier);
                $('#owner').val(owner);
                $('#address').val(address);
                $('#edit_supplier1').modal('show');

            })

            $('.delete_supplier').on('click', function(){

                var id = $(this).val();
        
                $('#delete_id').val(id);
                $('#delete_supplier1').modal('show');

            })
            
        })


    </script>


</x-layout>


<!-- Modal -->
<div class="modal fade" id="delete_supplier1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

