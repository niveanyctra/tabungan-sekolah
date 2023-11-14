<x-student-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Transaksi') }}
                    </h2>
                </x-slot>
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success align-content-center">

                                {{ session('success') }}
                                <button type="button" class="btn btn-primary float-end " data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Lihat Bukti
                                </button>
                            </div>
                            @endif
                            @include('backend.student.partials.modalbukti')
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                    <div class="row">
                        <div class="col-6 d-block mx-auto">
                            <div class="bg-info rounded-4 d-inline-block p-2 mb-3">

                                <div class="fw-semibold fs-5 py-1 px-2"><i class="fa-solid fa-wallet"></i> Saldo Kamu :
                                    <span
                                        class="fw-light">{{ number_format(intval($profile->jumlah), 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-block mx-auto">

                        </div>
                    </div>
                    <h3>Mau Apa Hari Ini?</h3>
                    <div class="row">
                        <div class="col-6 d-block mx-auto mx-5 mt-2">
                            <a href="{{ route('transaksiSetor') }}" class="btn btn-xl btn-info">
                                <i class="fa-solid fa-money-bills"></i>
                                <span class="ms-1">

                                    Setor
                                </span>
                            </a>
                            <a href="{{ route('transaksiTarik') }}" class="btn btn-xl btn-info mx-3">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                                <span class="ms-1">

                                    Tarik
                                </span>
                            </a>
                            <a href="{{ route('transaksiTransfer') }}" class="btn btn-xl btn-info">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                                <span class="ms-1">

                                    Transfer
                                </span>
                            </a>
                            <a href="{{ url('/transaksi/riwayat/'.$user->id) }}" class="btn btn-xl btn-info ms-3">
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
