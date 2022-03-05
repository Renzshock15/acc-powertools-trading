<table class="table table-striped" id="inventory_table">
    <thead>
        <tr>
            <th class="border-top-0">No.</th>
            <th class="border-top-0">Type</th>
            <th class="border-top-0">Receipt</th>
            <th class="border-top-0">Transaction date</th>
            <th class="border-top-0">From</th>
            <th class="border-top-0">To</th>
            <th class="border-top-0">Status</th>
            <th class="border-top-0 text-center" colspan="2" width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['transactions'] as $transaction)
        <tr>
            <td class="border-top-0">{{ $transaction->id }}</td>
            <td class="border-top-0">{{ $transaction->transaction_type->type_name }}</td>
            <td class="border-top-0">{{ $transaction->transaction_receipt }}</td>
            <td class="border-top-0">{{ $transaction->transaction_date }}</td>
            <td class="border-top-0">{{ $transaction->from }}</td>
            <td class="border-top-0">{{ $transaction->to }}</td>
            <td class="border-top-0">{{ $transaction->status }}</td>
            <td class="border-top-0 text-center">
                @if($transaction->status === 'Unboxed')

                @else
                <a href="transacted_items/{{ $transaction->id }}"><button class="btn btn-warning text-white" data-label="" data-price=""><i class="fas fa-eye"></i></button></a>
                @endif
            </td>
            <td class="border-top-0 text-center">
                @if($transaction->status === 'Transfered')

                @elseif($transaction->status === 'Cancelled')
                <button class="btn btn-info text-white" data-label="" data-price="" id="show_reason"><i class="fas fa-list"></i></button>
                @elseif($transaction->status === 'Received' && $transaction->transaction_type->type_name === 'Transfer')

                @elseif($transaction->status === 'Unboxed')

                @else
                <button class="btn btn-danger text-white" data-label="" data-price="" id="cancel_transaction"><i class="fas fa-times"></i></button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $data['transactions']->links() }}