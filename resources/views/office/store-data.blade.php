<table class="table" id="store_table">
    <thead>
        <tr>
            <th class="border-top-0">Id</th>
            <th class="border-top-0">Name</th>
            <th class="border-top-0">Address</th>
            <th class="border-top-0">Type</th>
            <th class="border-top-0 text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['stores'] as $store)
        <tr>
            <td class="">{{ $store->id }}</td>
            <td class="">{{ $store->name.' - '.$store->street }}</td>
            <td class="">{{ $store->street.' '.$store->city.', '.$store->province }}</td>
            <td class="">{{ $store->access->name }}</td>
            <td class="text-center">
                <a class="btn btn-info text-white" href="edit_store/{{$store->id}}" name="" id=""><i class="far fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data['stores']->links() !!}