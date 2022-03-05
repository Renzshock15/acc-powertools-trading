<table class="table" id="product_table">
    <thead>
        <tr>
            <th class="border-top-0" width="5%">Id</th>
            <th class="border-top-0" width="15%">Type</th>
            <th class="border-top-0" width="20%">Receipt</th>
            <th class="border-top-0" width="15%">Date</th>
            <th class="border-top-0" width="25%">Transacted By</th>
            <th class="border-top-0" width="10%">Status</th>
            <th class="border-top-0 text-center" colspan="2" width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['transactions'] as $transaction)
        <tr>
            <td class="">{{$transaction->id}}</td>
            <td class="">{{$transaction->transaction_type->type_name}}</td>
            <td class="">{{$transaction->transaction_receipt}}</td>
            <td class="">{{$transaction->transaction_date}}</td>
            <td class="">{{$transaction->store->name.' - '.$transaction->store->street.' '.$transaction->store->city}}</td>
            <td class="">{{$transaction->status}}</td>
            <td class="text-center"><a class="btn btn-warning" href="transacted_items/{{$transaction->id}}"><i class="far fa-eye"></i></a></td>
            @if($transaction->status === 'Cancelled')
            <td class="text-center"><button class="btn btn-info show_reason"><i class="fas fa-comment-alt"></i></button></td>
            @else
            <td></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data['transactions']->links() !!}