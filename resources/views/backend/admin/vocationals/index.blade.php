<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jurusan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container p-5">
                    <div class="pb-3">
                        <a href="{{ route('admin.vocationals.create') }}" class="btn btn-success">
                            Tambah Data Jurusan Baru
                        </a>
                    </div>
                    <x-alert />
                    <div class="bg-seconday">
                        <div class="">
                            <table id="myTable" class="ui celled table nowrap unstackable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th data-priority="1">Jurusan</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vocationals as $vocational)
                                        <tr>
                                            <td class="py-2">{{ $loop->iteration }}</td>
                                            <td class="py-2">{{ $vocational->name }}</td>
                                            <td class="py-2">{{ $vocational->classrooms->count() }} Kelas</td>
                                            <td class="py-2">
                                                <div class="d-flex justify-content-end" style="gap: 5px">
                                                    <a href="{{ route('admin.vocationals.edit', $vocational->id) }}"
                                                        class="btn btn-sm btn-warning">Ubah</a>
                                                    <button type="button"
                                                        data-action="{{ route('admin.vocationals.destroy', $vocational->id) }}"
                                                        data-confirm-text="Anda yakin menghapus data pengguna ini?"
                                                        class="btn btn-sm btn-danger btn-delete">
                                                        Hapus
                                                    </button>
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
