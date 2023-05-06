<div class="modal fade" id="history" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          

            <table id="datatablesSimple" class="ui celled table">

                <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Supplier</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </tfoot>

                <tbody>

                    @foreach ($histories as $history)
                        
                        <tr>

                            <td>{{ $history->supplier->supplier }}</td>
                            <td>{{ date('M-d-Y H:i:s', strtotime($history->created_at))}}</td>
                            <td><a href="/view-product?code={{ $history->code }}&id={{ $supplier_name->id }}" class="btn btn-primary">View</a></td>

                        </tr>

                    @endforeach

                </tbody>


            </table>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<x-layout :month="$month" :suppliers="$suppliers">
    <button onclick="history.back()" class="btn btn-info"><i class="fa-solid fa-backward"></i></button>
    <h1 class="mt-4">Supplier: {{ $supplier_name->supplier }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
    </ol>
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>

    <br>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#history"><i class="fa-solid fa-clock-rotate-left"></i> History</button>
    <div class="card mb-4">
        <div class="card-header d-flex bg-dark text-light">
            <div class="d-flex">
                <h5>Buy Product</h5>
            </div>
            
        </div>
        <div class="card-body">
            <form action="/store-buy?id={{ $supplier_name->id }}" method="POST">
                @csrf
            <table class="ui celled table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Qnty/Unit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="content">
                            <tr>    

                                <td>
                                    <select name="product_id[]" id="product_id" class="form-control" required>
                                    <option value="" selected>Select Product</option>
                                    
                                    @foreach ($products as $product)
                                        
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>

                                    @endforeach
                                    </select>
                                </td>
                                <td>

                                    <input type="number" name="qnty[]" class="form-control" required>

                                </td>
                                <td>

                                    <button type="button" class="btn btn-warning" id="add-btn"><i class="fa-solid fa-plus"></i></button>

                                </td>


                            </tr>

                            <button class="form-control btn btn-success" type="submit">SUBMIT</button>

                    
                </tbody>
            </table>

        </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        
        $(document).ready(function(){
            
            $('#add-btn').on('click', function(){
                let html = '';

                html += '<tr>'
                html += '<td><select name="product_id[]" id="product_id" class="form-control" required>'
                html += '<option value="" selected>Select Product</option>'
                html += '@foreach ($products as $product)<option value="{{ $product->id }}">{{ $product->product_name }}</option>@endforeach </select> </td>'
                html += '<td> <input type="number" name="qnty[]" class="form-control" required> </td>'
                html += '<td><button type="button" class="btn btn-danger" id="add-remove"><i class="fa-solid fa-trash"></i></button></td>'
                html += '</tr>'


                $('#content').append(html)

            })

            $(document).on('click', '#add-remove', function(){
                $(this).closest('tr').remove()
            })

        })

    </script>
</x-layout>

