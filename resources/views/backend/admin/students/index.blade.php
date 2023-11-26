<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container p-5">
                    <div class="bg-seconday">
                        <x-alert />
                        <div class="">
                            <table id="myTable" class="ui celled table nowrap unstackable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th data-priority="1">Nama</th>
                                        <th>Foto Siswa</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Email</th>
                                        <th data-priority="2">Tabungan</th>
                                        <th width="17%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="py-2">{{ $loop->iteration }}</td>
                                            <td class="py-2">{{ $user->name }}</td>
                                            <td class="py-2">
                                                <img class="img-fluid" width="50"
                                                    src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                            </td>
                                            <td class="py-2">
                                                @if ($user->student)
                                                    @if ($user->student->classroom_id)
                                                        {{ $user->student->classroom->name }}
                                                    @else
                                                        <span class="badge text-bg-danger">Kelas Not Found</span>
                                                    @endif
                                                @else
                                                    <span class="badge text-bg-danger">Siswa Not Found</span>
                                                @endif
                                            </td>
                                            <td class="py-2">
                                                @if ($user->student)
                                                    @if ($user->student->classroom_id)
                                                        {{ $user->student->classroom->vocational->name }}
                                                    @else
                                                        <span class="badge text-bg-danger">Jurusan Not Found</span>
                                                    @endif
                                                @else
                                                    <span class="badge text-bg-danger">Siswa Not Found</span>
                                                @endif
                                            </td>
                                            <td class="py-2 text-center">{{ $user->email }}</td>
                                            <td class="py-2 text-center">Rp. {{ number_format(intval($user->student->jumlah), 0, ',', '.') }}</td>
                                            <td class="py-2">
                                                <div class="d-flex justify-content-end" style="gap: 5px">
                                                    @if ($user->status == '0')
                                                        <div class="btn disabled btn-sm btn-secondary">
                                                            Siswa belum aktif
                                                        </div>
                                                    @else
                                                        <a href="{{ route('admin.students.setor', $user->id) }}" class="btn btn-sm btn-info">Setor</a>
                                                        <a href="{{ route('admin.students.tarik', $user->id) }}" class="btn btn-sm btn-warning">Tarik</a>
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
