<x-student-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Riwayat') }}
                    </h2>
                </x-slot>
                <div class="container p-5">
                    <div class="bg-secondary">
                        <table id="myTable" class="ui celled table nowrap unstackable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Transaksi</th>
                                    <th>Nama Pengirim</th>
                                    <th>Nama Penerima</th>
                                    <th>Tipe Transaksi</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $key => $data)

                                @endforeach
                                <tr>
                                    <td>{{ $transaksi->firstItem() + $key }}</td>
                                    <td>{{$transaksi->no_transaksi}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
