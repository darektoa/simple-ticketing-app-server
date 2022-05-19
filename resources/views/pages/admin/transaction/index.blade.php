<x-layout app>
    <x-layout.section title="Transactions" />
    <x-card class="mb-4">
        <x-card.head>
            <x-text bold color="primary" value="Transactions" />
            <x-form method="GET" class="ms-auto d-none d-md-flex">
                <x-input name="search" placeholder="Search..." value="{{ request()->search ?? '' }}" class="me-2"/>
                <x-button outline type="submit" value="Search" />
            </x-form>
        </x-card.head>
        <x-card.body>

            <!-- MODAL TOPUP -->
            <x-modal id="modalTopup" title="Topup" :action="route('transactions.topup')">
                <x-modal.body>
                    <x-input type="text" name="amount" label="Amount:" />
                </x-modal.body>
            </x-modal>

            <x-table.instant
                :data="$transactions->items()"
                hidden="status|type|detail|updated_at"
                visible="created_at:created on" />

            {{ $transactions->links() }}
        </x-card.body>
    </x-card>
</x-layout>