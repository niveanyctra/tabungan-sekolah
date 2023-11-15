<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Transaksi') }}
        </h2>
    </x-slot>
    <x-alert />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container p-5">
                    <div class="bg-seconday">
                        <div class="">
                            <table id="myTable" class="ui celled table nowrap unstackable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th data-priority="1">Nama</th>
                                        <th>No Transaksi</th>
                                        <th>Tipe Transaksi</th>
                                        <th>Jumlah</th>
                                        <th width="20%">Tanggal</th>
                                        <th width="15%" data-priority="2">Status</th>
                                        <th width="8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trans as $data)
                                        <tr>
                                            <td class="py-2">{{ $loop->iteration }}</td>
                                            <td class="py-2">{{ $data->user->name }}</td>
                                            <td class="py-2">{{ $data->no_transaksi }}</td>
                                            <td class="py-2">{{ $data->type }}</td>
                                            <td class="py-2">{{ $data->amount }}</td>
                                            <td class="py-2">{{ $data->created_at }}</td>
                                            <td class="py-2 text-center">
                                                @if ($data->status)
                                                    <span class="badge text-bg-success">Confirmed</span>
                                                @else
                                                    <span class="badge text-bg-secondary">Not Confirmed</span>
                                                @endif
                                            </td>
                                            <td class="py-2">
                                                <div class="d-flex justify-content-end" style="gap: 5px">
                                                    @if ($data->status == '0')
                                                        <a href="{{ route('admin.konfirmasi.transaksi', $data->id) }}"
                                                            class="btn btn-sm btn-success">Confirm</a>
                                                    @else
                                                        <div class="btn disabled btn-sm btn-secondary">Transaksi Berhasil
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 2,
                        targets: -1
                    }
                ]
            });
        });
    </script>
</x-admin-layout>
