<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container p-5">
                    <div class="pb-3">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                            Tambah Data Pengguna Baru
                        </a>
                    </div>
                    <x-alert />
                    <div class="bg-seconday">
                        <div class="">
                            <table id="myTable" class="ui celled table nowrap unstackable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th data-priority="1">Nama</th>
                                        @if (auth()->user()->role_id == 1)
                                            <th>Password</th>
                                        @endif
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="py-2">{{ $loop->iteration }}</td>
                                            <td class="py-2">{{ $user->name }}</td>
                                            @if (auth()->user()->role_id == 1)
                                                <td class="py-2">{{ $user->password_hint }}</td>
                                            @endif
                                            <td class="py-2 fw-bold">
                                                @switch($user->roles->name)
                                                    @case('SuperAdmin')
                                                        <span class="badge text-bg-info">
                                                            Super Admin
                                                        </span>
                                                    @break

                                                    @case('Administrator')
                                                        <span class="badge text-bg-primary">
                                                            Administrator
                                                        </span>
                                                    @break

                                                    @case('Teacher')
                                                        <span class="badge text-bg-success">
                                                            Teacher
                                                        </span>
                                                    @break

                                                    @case('Student')
                                                        <span class="badge text-bg-light">
                                                            Student
                                                        </span>
                                                    @break

                                                    @default
                                                @endswitch
                                            </td>
                                            <td class="py-2">
                                                <div class="d-flex justify-content-end" style="gap: 5px">
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-warning">Ubah</a>
                                                    @if (Auth::id() != $user->id)
                                                        <button type="button"
                                                            data-action="{{ route('admin.users.destroy', $user->id) }}"
                                                            data-confirm-text="Anda yakin menghapus data pengguna ini?"
                                                            class="btn btn-sm btn-danger btn-delete">
                                                            Hapus
                                                        </button>
                                                    @else
                                                        <div class="btn btn-sm btn-secondary disabled">Hapus</div>
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
