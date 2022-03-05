<table class="table" id="inventory_table">
    <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="border-top-0">Code</th>
            <th class="border-top-0">Name</th>
            <th class="border-top-0">Qty</th>
            <th class="border-top-0">Price</th>
            <th class="border-top-0">Discount</th>
            <th class="border-top-0">Discounted Price</th>
            <th class="border-top-0 text-center" colspan="2" width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['inventories'] as $inventory)
        <tr>
            <td><img src="{{$inventory->product->image ? '../images/uploads/products/'.$inventory->product->image : '../images/app/upload-photo.jpg'}}" alt="" style="width: 30px;"></td>
            <td><a class="show_details" data-img="{{ $inventory->product->image }}" data-name="{{ $inventory->product->name }}" data-details="{{ $inventory->product->description }}" role="button">{{ $inventory->product->code }}</a></td>
            <td>{{ $inventory->product->name }}</td>
            <td>{{ $inventory->quantity }}</td>
            <td>{{ $inventory->product->price }}</td>
            <td>{{ $inventory->product->discount.'%' }}</td>
            <td>{{ minusPercentage($inventory->product->price, $inventory->product->discount) }}</td>
            <td class="text-center">
                <button class="btn btn-primary text-white add_inventory" name="add_inventory" id="add_inventory" data-id="{{ $inventory->id }}" data-label="{{ $inventory->product->name }}"><i class="fas fa-plus"></i></button>
            </td>
            <td class="text-center">
                @if($inventory->product->unit->name === 'pack')
                <button class="btn btn-dark text-white repack_inventory" name="add_inventory" id="add_inventory" data-id="{{ $inventory->id }}" data-label="{{ $inventory->product->name }}"><i class="fas fa-bomb"></i></button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $data['inventories']->links() }}