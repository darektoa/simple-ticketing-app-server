@php use App\Models\Transaction; @endphp

<x-layout app>
    <x-layout.section title="Dashboard" />
    
    <x-view.row>
        <x-card.info title="Total Registrants"    :value="Transaction::count()" icon="fa-users text-primary" />
        <x-card.info title="Pending Transactions" :value="Transaction::where('status', 1)->count()" icon="fa-clock text-gray-300" color="warning" />
        <x-card.info title="Paid Transactions"    :value="Transaction::where('status', 2)->count()" icon="fa-check text-gray-300" color="success" />
        <x-card.info title="Expired Transactions" :value="Transaction::where('status', 4)->count()" icon="fa-xmark text-gray-300" color="danger" />
    </x-view.row>

    <x-card style="min-height: 200px">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Destination</th>
                    <th>Total Registrants</th>
                </tr>
            </thead>
            <tbody>
    
                @foreach($destinations as $destination)
                <tr>
                    <td class="align-middle">{{ $destination->destination->name }}</td>
                    <td class="align-middle">{{ $destination->total }}</td>
                </tr>
                @endforeach
    
            </tbody>
        </table>
    </x-card>
</x-layout.section>