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
        <x-card.body style="min-height: 400px">

            <!-- MODAL SHOW TRANSACTION -->
            <x-modal id="modalShowTrx" title="Detail">
                <x-modal.body>
                    <div class="mb-1">Name: <span id="trxReceiverName"></span></div>
                    <div class="mb-1">Phone: <span id="trxReceiverPhone"></span></div>
                    <x-input.label class="mt-3 fw-bold">Detail:</x-input.label>
                    <div id="trxReceiverDetail"></div>
                </x-modal.body>
                <x-modal.foot>
                    <x-button outline color="secondary" data-bs-dismiss="modal" value="Close" />
                </x-modal.foot>
            </x-modal>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Destination</th>
                        <th>Addons</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($transactions as $transaction)
                    @php
                        $receiver = $transaction->receiver;
                    @endphp
                    <tr>
                        <td class="align-middle">{{ $transaction->code }}</td>
                        <td class="align-middle">
                            <h6 class="fw-bold m-0">{{ $receiver->full_name }} [{{ $receiver->gender_name }}]</h6>
                            <small>{{ $receiver->email }}</small>
                        </td>
                        <td class="align-middle">{{ $transaction->destination->destination->name }}</td>
                        <td class="align-middle">{{ $transaction->addon->addon->name ?? 'None' }}</td>
                        <td class="align-middle">{{ $transaction->amount }}</td>
                        <td class="align-middle">{{ $transaction->status_name }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            {{ $transactions->links() }}
        </x-card.body>
    </x-card>
</x-layout>