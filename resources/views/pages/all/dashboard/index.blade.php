@php use App\Models\Transaction; @endphp

<x-layout app>
    <x-layout.section title="Dashboard" />
    
    <x-view.row>
        <x-card.info title="Total Registrants" :value="Transaction::count()" icon="fa-users text-primary" />
        <x-card.info title="Pending Transactions" :value="Transaction::where('status', 1)->count()" icon="fa-coins text-gray-300" color="warning" />
        <x-card.info title="Total Buying" value="48" icon="fa-cart-shopping text-gray-300" color="success" />
        <x-card.info title="Total Refund" value="10" icon="fa-clock-rotate-left text-gray-300" color="danger" />
    </x-view.row>

    <x-table.instant 
        hidden="destination_id"
        :data="$destinations"   
    />
</x-layout.section>