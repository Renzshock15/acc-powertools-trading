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
            <th class="border-top-0">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['products'] as $product)
        <tr>
            <td><a class="click_image" role="button" data-image="{{$product->image}}" data-description="{{$product->description}}" data-name="{{$product->code .' '.$product->name}}"><img src="{{$product->image ? '../images/uploads/products/'.$product->image : '../images/app/upload-photo.jpg'}}" alt="" style="width: 30px;"></a></td>
            <td><a href="product-info/{{ $product->id }}">{{ $product->code }}</a></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->discount.'%' }}</td>
            <td>{{ minusPercentage($product->price, $product->discount)  }}</td>
            <td>{{ $product->brand->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>
                <button class="btn btn-danger text-white delete_product" name="delete_product" id="delete_product" data-id="{{ $product->id }}" data-label="{{ $product->name }}"><i class="far fa-trash-alt"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data['products']->links() !!}