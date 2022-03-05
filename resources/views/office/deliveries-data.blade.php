<table class="table" id="product_table">
    <thead>
        <tr>
            <th class="border-top-0" width="5%">Id</th>
            <th class="border-top-0" width="20%">Packing List</th>
            <th class="border-top-0" width="15%">Date</th>
            <th class="border-top-0" width="25%">Deliver To</th>
            <th class="border-top-0" width="10%">Status</th>
            <th class="border-top-0 text-center" width="10%" colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['transactions'] as $transaction)
        <tr>
            <td class="">{{$transaction->id}}</td>
            <td class="">{{$transaction->transaction_receipt}}</td>
            <td class="">{{$transaction->transaction_date}}</td>
            <td class="">{{$transaction->to}}</td>
            <td class="{{$transaction->status === 'Delivered'? 'text-success':''}}">{{$transaction->status}}</td>
            <td class="text-center"><a class="btn btn-info" href="delivery_items/{{$transaction->id}}"><i class="far fa-eye"></i></a></td>
            @if($transaction->status === 'Pending')
            <td class=""><button class="btn btn-danger text-white" data-label="" data-price="" id="cancel_transaction"><i class="fas fa-times"></i></button></td>
            @else
            <td></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data['transactions']->links() !!}