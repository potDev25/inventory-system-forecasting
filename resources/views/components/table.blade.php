
@forelse ($inventories as $inventory)
    <tr>
        <td>{{$inventory->date}}</td>
        <td>{{$inventory->product->product_name}}</td>
        <td>{{$inventory->sales}}</td>
        <td @if ($inventory->product->remaining_quantity <= 10)
            class="bg-danger text-white"
        @endif>{{$inventory->product->remaining_quantity}}</td>
        <td>{{$inventory->total_sales}}</td>
        <td>{{$inventory->income}}</td>
    </tr>
@empty
    <h6>No inventory added</h6>
@endforelse

<x-modal/>
      
