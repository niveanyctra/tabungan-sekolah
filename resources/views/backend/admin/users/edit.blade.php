<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit USer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container p-5">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="post" x-data="{ role_id: {{ $user->role_id }} }">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3">
                            <label class="col-lg-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}">
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
                                    value="{{ old('email', $user->email) }}">
                                <div class="invalid-feedback">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3 mt-3">
                            <label class="col-lg-3 col-form-label">Role <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select x-model="role_id" {{ Auth::id() == $user->id ? 'disabled' : '' }} name="role_id"
                                    class="form-control @error('role_id') is-invalid @enderror">
                                    <option value="{{ $user->role_id }}"{{ $user->role_id == '1' ? 'selected' : '' }}>
                                        {{ $user->roles->name }}</option>
                                    <option disabled>----------</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('role_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3" x-show="role_id == 4">
                            <label class="col-lg-3 col-form-label">Jurusan <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select id="vocational" name="vocational_id"
                                        class="form-control @error('vocational_id') is-invalid @enderror"
                                        x-model="selectedVocational">
                                    @if ($user->student && $user->student->classroom)
                                        <option value="{{ $user->student->classroom->vocational_id }}">
                                            {{ $user->student->classroom->vocational->name }}
                                        </option>
                                    @endif
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
                        <div class="form-group row mb-3" x-show="role_id == 4">
                            <label class="col-lg-3 col-form-label">Kelas <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select id="kelas" name="classroom_id"
                                        class="form-control @error('classroom_id') is-invalid @enderror"
                                        x-model="selectedClassroom">
                                    @if ($user->student && $user->student->classroom)
                                        <option value="{{ $user->student->classroom_id }}">
                                            {{ $user->student->classroom->name }}
                                        </option>
                                    @endif
                                    <option disabled>----------</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('classroom_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-lg-12">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah
                                    password</small>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-lg-3 col-form-label">Password Baru</label>
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
                            <label class="col-lg-3 col-form-label">Konfirmasi Password</label>
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
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role_id');
            const vocationalSelect = document.getElementById('vocational');
            const classSelect = document.getElementById('kelas');
            const initialClassOptions = classSelect.innerHTML;

            function updateClassOptions(selectedVocationalId) {
                // Make an AJAX request to get the relevant data for classrooms based on the selected vocational
                // Replace this URL with the actual endpoint in your application
                fetch(`/get-classrooms/${selectedVocationalId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update class options
                        classSelect.innerHTML = initialClassOptions; // Reset to initial options
                        data.classrooms.forEach(classroom => {
                            const option = document.createElement('option');
                            option.value = classroom.id;
                            option.text = classroom.name;
                            classSelect.add(option);
                        });
                    })
                    .catch(error => console.error('Error fetching classrooms:', error));
            }

            // Initial update
            const selectedVocationalId = vocationalSelect.value;
            updateClassOptions(selectedVocationalId);

            // Update options when vocational selection changes
            vocationalSelect.addEventListener('change', function () {
                const selectedVocationalId = vocationalSelect.value;
                updateClassOptions(selectedVocationalId);
            });

            // Update options when role selection changes
            roleSelect.addEventListener('change', function () {
                const selectedRoleId = roleSelect.value;
                if (selectedRoleId === '4') {
                    // Make an AJAX request to get the relevant data for vocationals
                    // Replace this URL with the actual endpoint in your application
                    fetch(`/get-vocationals`)
                        .then(response => response.json())
                        .then(data => {
                            // Update vocational options
                            vocationalSelect.innerHTML = '';
                            data.vocationals.forEach(vocational => {
                                const option = document.createElement('option');
                                option.value = vocational.id;
                                option.text = vocational.name;
                                vocationalSelect.add(option);
                            });

                            // Update class options
                            updateClassOptions(vocationalSelect.value);
                        })
                        .catch(error => console.error('Error fetching vocationals:', error));
                } else {
                    // Reset vocational options and class options
                    vocationalSelect.innerHTML = '';
                    classSelect.innerHTML = initialClassOptions;
                }
            });
        });
    </script>
</x-admin-layout>
