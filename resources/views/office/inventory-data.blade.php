<table class="table" id="inventory_table">
    <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="border-top-0">Code</th>
            <th class="border-top-0">Name</th>
            <th class="border-top-0">Qty</th>
            <th class="border-top-0">Price</th>
            <th class="border-top-0">Location</th>
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
            <td>{{ $inventory->store->name.' - '.$inventory->store->street.' '.$inventory->store->city }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data['inventories']->links() !!}