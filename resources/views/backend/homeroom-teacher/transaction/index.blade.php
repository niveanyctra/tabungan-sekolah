<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi Siswa') }}
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
                                        <th>Foto Siswa</th>
                                        <th>Email</th>
                                        <th>Jumlah</th>
                                        <th width="8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $data)
                                        <tr>
                                            <td class="py-2">{{ $loop->iteration }}</td>
                                            <td class="py-2">{{ $data->user->name }}</td>
                                            <td class="py-2">
                                                <img class="img-fluid" width="50"
                                                    src="{{ $data->user->profile_photo_url }}" alt="{{ $data->user->name }}" />
                                            </td>
                                            <td class="py-2">{{ $data->user->email }}</td>
                                            <td class="py-2">Rp. {{ number_format(intval($data->jumlah), 0, ',', '.') }}
                                            </td>
                                            <td class="py-2">
                                                {{-- <div class="d-flex justify-content-end" style="gap: 5px">
                                                    @if ($data->status == '0')
                                                        <a href="{{ route('admin.konfirmasi.transaksi', $data->id) }}"
                                                            class="btn btn-sm btn-success">Confirm</a>
                                                    @else
                                                        <div class="btn disabled btn-sm btn-secondary">Transaksi
                                                            Berhasil
                                                        </div>
                                                    @endif

                                                </div> --}}
                                                <a href="{{route('ht.transaksiSetor',$data->user->name)}}" class="btn btn-sm btn-info">
                                                    Setor
                                                </a>
                                                <a href="{{route('ht.transaksiTarik',$data->user->name)}}" class="btn btn-sm btn-warning">
                                                    Tarik
                                                </a>
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
</x-teacher-layout>
