<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container p-5">
                    <form action="{{ route('admin.users.store') }}" method="post" x-data="{role_id: 5}">
                        @csrf
                        <div class="form-group row mb-3">
                            <label class="col-lg-3 col-form-label">Nama <span class="text-danger">*</span></label>
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
                        <div class="form-group row mb-3">
                            <label class="col-lg-3 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                                <div class="invalid-feedback">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-3 col-form-label">Role <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="role_id" x-model="role_id" class="form-control @error('role') is-invalid @enderror">
                                    <option value="">Pilih role</option>
                                    <option disabled>----------</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('role')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3" x-show="role_id == 5">
                            <label class="col-lg-3 col-form-label">Jurusan <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select id="vocational" name="vocational_id" class="form-control @error('vocational_id') is-invalid @enderror">
                                    <option value="">Pilih Jurusan</option>
                                    <option disabled>----------</option>
                                    @foreach ($vocationals as $vocational)
                                        <option value="{{ $vocational->id }}">{{ $vocational->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('vocational_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3"  x-show="role_id == 5">
                            <label class="col-lg-3 col-form-label">Kelas <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select id="kelas" disabled name="classroom_id" class="form-control @error('classroom_id') is-invalid @enderror">
                                    <option value="">Pilih Jurusan Terlebih Dahulu</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('classroom_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-3 col-form-label">Password <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3 mt-3">
                            <label class="col-lg-3 col-form-label">Konfirmasi Password <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('password_confirmation')
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
    <script>
        document.getElementById('vocational').addEventListener('change', function () {
        var vocationalId = this.value;
        var kelasSelect = document.getElementById('kelas');

        // Clear existing options
        kelasSelect.innerHTML = '';

        // If vocational is selected, fetch kelas
        if (vocationalId) {
            fetch('/get-classroom-by-vocational/' + vocationalId)
                .then(response => response.json())
                .then(data => {
                    // Enable the kelas select
                    kelasSelect.removeAttribute('disabled');

                    // Populate kelas options
                    data.forEach(kelas => {
                        var option = document.createElement('option');
                        option.value = kelas.id;
                        option.text = kelas.name;
                        kelasSelect.add(option);
                    });
                });
        } else {
            // If no vocational is selected, disable and clear kelas select
            kelasSelect.setAttribute('disabled', true);
        }
    });
    </script>
</x-admin-layout>
