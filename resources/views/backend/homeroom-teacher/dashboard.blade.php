<x-teacher-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="m-4">
                    <h1>Selamat Datang Bapak/Ibu {{ $teacher->name }}</h1>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <h2>Wali Kelas {{ $kelas->name }} // Total Siswa {{ $students }}</h2>
                        </div>

                        <div class="col-12 mb-5">
                            <div>
                                <canvas id="chartTeacher" width="400" height="170"></canvas>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <h3>Tabungan Masuk Bulan Ini <span class="text-success fw-bold ms-3">Rp. {{ number_format(intval($masuk->sum('amount')), 0, ',', '.') }}</span></h3>
                            <table id="masuk" class="ui celled table nowrap unstackable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th data-priority="1">No Transaksi</th>
                                        <th>Nama Siswa</th>
                                        <th width="15%" data-priority="2">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($masuk as $data)
                                        <tr>
                                            <td class="py-2">{{ $loop->iteration }}</td>
                                            <td class="py-2">{{ $data->no_transaksi }}</td>
                                            <td class="py-2">{{ $data->user->name }}</td>
                                            <td class="py-2">Rp. {{ number_format(intval($data->amount), 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <h3>Tabungan Keluar Bulan Ini <span class="text-danger fw-bold ms-3">Rp. {{ number_format(intval($tarik->sum('amount')), 0, ',', '.') }}</span></h3>
                            <table id="keluar" class="ui celled table nowrap unstackable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th data-priority="1">No Transaksi</th>
                                        <th>Nama Siswa</th>
                                        <th width="15%" data-priority="2">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tarik as $data)
                                        <tr>
                                            <td class="py-2">{{ $loop->iteration }}</td>
                                            <td class="py-2">{{ $data->no_transaksi }}</td>
                                            <td class="py-2">{{ $data->user->name }}</td>
                                            <td class="py-2">Rp. {{ number_format(intval($data->amount), 0, ',', '.') }}</td>
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
    @push('script')
        <script>
            let data = @json($chartData);
            const ctx = document.getElementById('chartTeacher');

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
                $('#masuk').DataTable({
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
                $('#keluar').DataTable({
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
</x-teacher-layout>
