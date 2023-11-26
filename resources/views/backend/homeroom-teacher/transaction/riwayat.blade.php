<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi') }}
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat as $data)
                                        <tr>
                                            <td class="py-2">{{ $loop->iteration }}</td>
                                            <td class="py-2">{{ $data->user->name }}</td>
                                            <td class="py-2">{{ $data->no_transaksi }}</td>
                                            <td class="py-2">{{ $data->type }}</td>
                                            <td class="py-2">Rp. {{ number_format(intval($data->amount), 0, ',', '.') }}
                                            </td>
                                            <td class="py-2">{{ $data->created_at }}</td>
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
</x-teacher-layout>
