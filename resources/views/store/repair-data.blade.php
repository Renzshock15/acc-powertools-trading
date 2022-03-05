<table class="table" id="product_table">
    <thead>
        <tr>
            <th class="border-top-0" width="5%">Id</th>
            <th class="border-top-0" width="30%">Product Name</th>
            <th class="border-top-0" width="10%">Serial</th>
            <th class="border-top-0" width="15%">Receipt</th>
            <th class="border-top-0" width="10%">Entry Date</th>
            <th class="border-top-0 text-center" width="15%">Status</th>
            <th class="border-top-0" width="5%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['repairs'] as $repair)
        <tr>
            <td class="">{{ $repair->id }}</td>
            <td class=""><a class="click_product_name" data-name="{{$repair->customer->name}}" data-number="{{$repair->customer->number}}" data-user="{{$repair->user->first_name}}" role="button" id="">{{ $repair->product->code.' '.$repair->product->name }}</a></td>
            <td class="">{{ $repair->serial }}</td>
            <td class="">{{ $repair->receipt }}</td>
            <td class="">{{ $repair->entry_date }}</td>
            <td class="text-center"><button class="btn text-white {{$repair->status === 'Delivered'? ' btn-success' : ($repair->status === 'To deliver'? ' btn-danger' : ' btn-secondary')}} click_status" data-status="{{$repair->status}}" data-id="{{$repair->id}}">{{ $repair->status }}</button></td>
            <td class="text-center">
                <a class="btn btn-primary text-white" href="edit_repair/{{$repair->id}}" name="" id=""><i class="far fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data['repairs']->links() !!}