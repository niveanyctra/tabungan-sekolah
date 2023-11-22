<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="my-5 mx-3 row gap-5">
                    <div class="row justify-between">
                        <div class="col-3 card shadow">
                            <div class="card-body d-flex justify-between">
                                <h3>User <span
                                        class="bg-dark text-light rounded-4 ms-2 shadow p-2 px-3">{{ $users }}</span>
                                </h3>
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                    fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="card shadow">
                                <div class="card-body d-flex justify-between">
                                    <h3>Jurusan <span
                                            class="bg-dark text-light rounded-4 ms-2 shadow p-2 px-3">{{ $vocationals }}</span>
                                        | Kelas <span
                                            class="bg-dark text-light rounded-4 ms-2 shadow p-2 px-3">{{ $classrooms }}</span>
                                    </h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                        fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                        <path
                                            d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z" />
                                        <path
                                            d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3V1Z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 card shadow">
                            <div class="card-body d-flex justify-between">
                                <h3>Siswa <span
                                        class="bg-dark text-light rounded-4 ms-2 shadow p-2 px-3">{{ $students }}</span>
                                </h3>
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                    fill="currentColor" class="bi bi-backpack3" viewBox="0 0 16 16">
                                    <path
                                        d="M4.04 7.43a4 4 0 0 1 7.92 0 .5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14ZM4 9.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-4Zm1 .5v3h6v-3h-1v.5a.5.5 0 0 1-1 0V10H5Z" />
                                    <path
                                        d="M6 2.341V2a2 2 0 1 1 4 0v.341c.465.165.904.385 1.308.653l.416-1.247a1 1 0 0 1 1.748-.284l.77 1.027a1 1 0 0 1 .15.917l-.803 2.407C13.854 6.49 14 7.229 14 8v5.5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5V8c0-.771.146-1.509.41-2.186l-.802-2.407a1 1 0 0 1 .15-.917l.77-1.027a1 1 0 0 1 1.748.284l.416 1.247A5.978 5.978 0 0 1 6 2.34ZM7 2v.083a6.04 6.04 0 0 1 2 0V2a1 1 0 1 0-2 0Zm5.941 2.595.502-1.505-.77-1.027-.532 1.595c.297.284.566.598.8.937ZM3.86 3.658l-.532-1.595-.77 1.027.502 1.505c.234-.339.502-.653.8-.937ZM8 3a5 5 0 0 0-5 5v5.5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5V8a5 5 0 0 0-5-5Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <h3 class="text-center">Total Tabungan Tahun Ini <span class="text-primary fw-bold">Rp.
                            {{ number_format(intval($totalYear), 0, ',', '.') }}</span></h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <h3>
                                Total Tabungan Bulan Ini <br>
                                <span class="text-primary fw-bold">Rp.
                                    {{ number_format(intval($totalMonth), 0, ',', '.') }}</span>
                            </h3>
                        </div>
                        <div class="col-4">
                            <h3>
                                Uang Masuk <br>
                                <span class="text-success fw-bold">Rp.
                                    {{ number_format(intval($masukMonth->sum('amount')), 0, ',', '.') }}</span>
                            </h3>
                        </div>
                        <div class="col-4">
                            <h3>
                                Uang Keluar <br>
                                <span class="text-danger fw-bold">Rp.
                                    {{ number_format(intval($tarikMonth->sum('amount')), 0, ',', '.') }}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="col-12">
                        <div>
                            <canvas id="myChart" width="400" height="170"></canvas>
                        </div>
                    </div>
                    <div class="col-5">
                        <h3>Siswa Belum Aktif <span class="text-danger fw-bold ms-3">{{ $tidak_aktif->count() }}</span>
                        </h3>
                        <table id="activate" class="ui celled table nowrap unstackable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th data-priority="1">Nama</th>
                                    <th width="15%" data-priority="2">Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($status as $user)
                                    <tr>
                                        <td class="py-2">{{ $loop->iteration }}</td>
                                        <td class="py-2">{{ $user->name }}</td>
                                        <td class="py-2">{{ $user->student->classroom->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <h3>Konfirmasi Transaksi <span class="text-danger fw-bold ms-3">{{ $trans->count() }}</span>
                        </h3>
                        <table id="confirm" class="ui celled table nowrap unstackable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th data-priority="1">Nama</th>
                                    <th>No Transaksi</th>
                                    <th>Tipe Transaksi</th>
                                    <th>Jumlah</th>
                                    <th width="15%" data-priority="2">Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trans as $data)
                                    <tr>
                                        <td class="py-2">{{ $loop->iteration }}</td>
                                        <td class="py-2">{{ $data->user->name }}</td>
                                        <td class="py-2">{{ $data->no_transaksi }}</td>
                                        <td class="py-2">{{ $data->type }}</td>
                                        <td class="py-2">Rp. {{ number_format(intval($data->amount), 0, ',', '.') }}
                                        </td>
                                        <td class="py-2">{{ $data->user->student->classroom->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            let data = @json($chartData);
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.bulan,
                    datasets: [{
                        label: 'Setor',
                        data: data.type.Setor,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    }, {
                        label: 'Tarik',
                        data: data.type.Tarik,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#activate').DataTable({
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
            $(document).ready(function() {
                $('#confirm').DataTable({
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
    @endpush
</x-admin-layout>
