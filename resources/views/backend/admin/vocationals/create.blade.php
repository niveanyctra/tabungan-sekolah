<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jurusan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container p-5">
                    <form action="{{ route('admin.vocationals.store') }}" method="post" x-data="{role_id: 4}">
                        @csrf
                        <div class="form-group row mb-3">
                            <label class="col-lg-3 col-form-label">Kepala Jurusan <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="hov_id" class="form-control @error('hov_id') is-invalid @enderror">
                                    <option value="">Pilih Guru</option>
                                    <option disabled>----------</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('hov_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-3 col-form-label">Nama Jurusan <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="p-3 text-end border-top">
                            <span class="text-muted float-start">
                                <strong class="text-danger">*</strong> Harus diisi
                            </span>
                            <div style="float: right">
                                <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Kembali</a>
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
