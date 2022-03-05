<table class="table" id="inventory_table">
    <thead>
        <tr>
            <th class="border-top-0 for-hide">ID</th>
            <th class="border-top-0">#</th>
            <th class="border-top-0">Code</th>
            <th class="border-top-0">Name</th>
            <th class="border-top-0">Price</th>
            <th class="border-top-0">Qty</th>
            <th class="border-top-0">Add</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['inventories'] as $inventory)
        <tr>
            <td class="for-hide">{{ $inventory->id }}</td>
            <td><img src="{{$inventory->product->image ? '../images/uploads/products/'.$inventory->product->image : '../images/app/upload-photo.jpg'}}" alt="" style="width: 30px;"></td>
            <td><a href="">{{ $inventory->product->code }}</a></td>
            <td>{{ $inventory->product->name }}</td>
            <td>{{ $inventory->product->price }}</td>
            <td>{{ $inventory->quantity }}</td>
            <td>
                <button class="btn btn-primary text-white add_to_sale_list" name="add_to_sale_list" id="add_to_sale_list" data-id="{{ $inventory->id }}" data-label="{{ $inventory->product->code.' '.$inventory->product->name }}" data-price="{{ minusPercentage($inventory->product->price, $inventory->product->discount) }}"><i class="fas fa-plus"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data['inventories']->links() !!}