<table class="table" id="product_table">
    <thead>
        <tr>
            <th class="border-top-0 for-hide">Id</th>
            <th class="border-top-0 text-center">#</th>
            <th class="border-top-0">Product Name</th>
            <th class="border-top-0">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['products'] as $product)
        <tr>
            <td class="for-hide">{{ $product->id }}</td>
            <td class="text-center"><img src="{{$product->image ? '../images/uploads/products/'.$product->image : '../images/app/upload-photo.jpg'}}" alt="" style="width: 30px;"></td>
            <td class="">{{ $product->code.' '.$product->name }}</td>
            <td>
                <button class="btn btn-primary text-white add_to_repair_form" name="add_to_repair_form" id="add_to_repair_form" data-id="{{ $product->id }}"><i class="fas fa-plus"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data['products']->links() !!}