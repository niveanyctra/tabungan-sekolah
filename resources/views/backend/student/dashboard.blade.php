<x-student-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
                </x-slot>
                <div class="row">
                    <h3>Selamat Datang, {{ $auth->name }}</h3>
                    <div class="col-4 d-block mx-auto">
                        <div class="bg-info rounded-4 d-inline-block p-2 ">

                            <div class="fw-semibold fs-5 py-1 px-2"><i class="fa-solid fa-wallet"></i> Saldo Kamu :
                                <span class="fw-light">{{ number_format(intval($profile->jumlah), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 d-block mx-auto">
                        <div class="bg-success rounded-4 d-inline-block p-2">

                            <div class="fw-semibold fs-5 py-1 px-2"><i class="fa-solid fa-arrow-down"></i> Pemasukan
                                Bulan Ini :
                                <span class="fw-light">{{ number_format(intval($msk), 0, ',', '.') }}</span>
                            </div>
                        </div>

                    </div>
                    <div class="col-4 d-block mx-auto">
                        <div class="bg-danger rounded-4 d-inline-block p-2">

                            <div class="fw-semibold fs-5 py-1 px-2"><i class="fa-solid fa-arrow-up"></i> Pengeluaran
                                Bulan Ini :
                                <span class="fw-light">{{ number_format(intval($klr), 0, ',', '.') }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-block mx-auto mx-5 mt-2">
                        {{-- <a href="{{ route('transaksiTransfer') }}" class="btn btn-xl btn-info">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                                <span class="ms-1">

                                    Transfer
                                </span>
                            </a> --}}
                        <a href="{{ url('/transaksi/riwayat/' . $auth->id) }}" class="btn btn-lg btn-info my-2">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <span class="ms-1">

                                Riwayat
                            </span>
                        </a>
                    </div>
                    <div class="col-6 d-block mx-auto">

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-student-layout>
