<x-teacher-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Tarik') }}
                    </h2>
                </x-slot>
                <div class="row">
                    <div class="col-6 d-block mx-auto">
                        <div class="bg-info rounded-4 d-inline-block p-2 mb-3">

                            <div class="fw-semibold fs-5 py-1 px-2"><i class="fa-solid fa-wallet"></i> Saldo Kamu : <span
                                    class="fw-light">{{ number_format(intval($profile->jumlah), 0, ',', '.') }}</span></div>
                        </div>
                    </div>
                    <div class="col-6 d-block mx-auto">

                    </div>
                </div>
                {{-- <h3>Mau Setor Berapa Hari Ini?</h3> --}}
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading fw-semibold fs-5">Mau Menarik Berapa Hari Ini?</div>

                            <div class="panel-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form class="form-horizontal" method="POST" action="{{route('transaksiWithdraw')}}">
                                    @csrf

                                    <div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
                                        <label for="jumlah" class="col-md-4 control-label">Jumlah</label>

                                        <div class="col-md-6">
                                            <input id="jumlah" type="number" class="form-control" name="jumlah"
                                                value="{{ old('jumlah') }}" required>

                                            @if ($errors->has('jumlah'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('jumlah') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" name="type" value="Tarik">
                                    <div class="form-group my-3">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-info">
                                                Tarik Uang
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-teacher-layout>
