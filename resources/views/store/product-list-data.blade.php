<table class="table" id="product_table">
    <thead>
        <tr>
            <th class="border-top-0">#</th>
            <th class="border-top-0">Code</th>
            <th class="border-top-0">Name</th>
            <th class="border-top-0">Price</th>
            <th class="border-top-0">Discount</th>
            <th class="border-top-0">Discounted Price</th>
            <th class="border-top-0">Brand</th>
            <th class="border-top-0">Category</th>
            <th class="border-top-0 text-center" colspan="2">Add</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['products'] as $product)
        <tr>
            <td><img src="{{$product->image ? '../images/uploads/products/'.$product->image : '../images/app/upload-photo.jpg'}}" alt="" style="width: 30px;"></td>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->discount.'%' }}</td>
            <td>{{ minusPercentage($product->price, $product->discount)  }}</td>
            <td>{{ $product->brand->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>
                <button class="btn btn-danger text-white" name="get_product" id="get_product" data-id="{{ $product->id }}" data-label="{{ $product->name }}"><i class="fas fa-plus"></i></button>
            </td>
            <td>
                <button class="btn btn-info text-white make_tag_price" name="make_tag_price" id="make_tag_price" data-id="{{ $product->id }}" data-label="{{ $product->name }}"><i class="fas fa-tag"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data['products']->links() !!}