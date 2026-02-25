<x-app-layout>
    <div class="container-fluid">
        <div class="page-header">
            <h4 class="page-title">Pengaturan Profil</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#"><i class="fas fa-home"></i></a>
                </li>
                <li class="separator"><i class="fas fa-angle-right"></i></li>
                <li class="nav-item"><a href="#">User</a></li>
                <li class="separator"><i class="fas fa-angle-right"></i></li>
                <li class="nav-item"><a href="#">Edit Profil</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-header" style="background-image: url('/assets/img/blogpost.jpg')">
                        <div class="profile-picture">
                            <div class="avatar avatar-xl">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/img/profile.jpg') }}"
                                    alt="..." class="avatar-img rounded-circle border border-white">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-profile text-center">
                            <div class="name">{{ $user->name }}</div>
                            <div class="job text-muted">{{ $user->email }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Informasi Pribadi</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name', $user->name) }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group @error('email') has-error @enderror">
                                        <label for="email">Alamat Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            value="{{ old('phone', $user->phone) }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="gender">Jenis Kelamin</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="">Pilih...</option>
                                            <option value="laki-laki"
                                                {{ old('gender', $user->gender) == 'laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="perempuan"
                                                {{ old('gender', $user->gender) == 'perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="date_of_birth">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="date_of_birth"
                                            id="date_of_birth"
                                            value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="avatar">Update Foto Profil</label>
                                        <input type="file" class="form-control-file" name="avatar" id="avatar">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Alamat Lengkap</label>
                                        <textarea class="form-control" name="address" id="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex gap-2 justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </div>
                </form>
            </div>

            @if (auth()->user()->isPsycholog())
                <div class="col-md-8 offset-md-4 mt-3">
                    @livewire('psychologist-profile-update')
                </div>
            @endif

            @if (auth()->user()->isPsycholog())
                {{-- Form Riwayat Pendidikan --}}
                <div class="col-md-8 offset-md-4 mt-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">Riwayat Pendidikan</div>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalAddEducation">
                                <i class="fas fa-plus"></i> Tambah Pendidikan
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Institusi</th>
                                            <th>Gelar & Jurusan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user->psycholog->educations ?? [] as $edu)
                                            <tr>
                                                <td>{{ $edu->graduation_year }}</td>
                                                <td>{{ $edu->institution_name }}</td>
                                                <td>{{ $edu->degree }} - {{ $edu->major }}</td>
                                                <td>
                                                    <form action="{{ route('education.destroy', $edu->id) }}"
                                                        method="POST" class="form-delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link btn-danger">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Belum ada data
                                                    pendidikan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Tambah Pendidikan --}}
                <div class="modal fade" id="modalAddEducation" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('education.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-bold">Tambah Pendidikan Baru</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Institusi / Universitas</label>
                                        <input type="text" name="institution_name" class="form-control"
                                            placeholder="Contoh: Universitas Tarumanagara" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Gelar</label>
                                        <input type="text" name="degree" class="form-control"
                                            placeholder="Contoh: Sarjana Psikologi" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Bidang Studi / Major</label>
                                        <input type="text" name="major" class="form-control"
                                            placeholder="Contoh: Psikologi Klinis">
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Lulus</label>
                                        <input type="number" name="graduation_year" class="form-control"
                                            min="1900" max="{{ date('Y') }}" value="{{ date('Y') }}"
                                            required>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif


            @if (auth()->user()->isPsycholog())
                {{-- form set rekening wallet untuk psikolog --}}
                <div class="col-md-8 offset-md-4 mt-3">
                    <form action="{{ route('bank_account.update') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Informasi Rekening Bank</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div
                                            class="form-group @error('bank_name', 'updateWallet') has-error @enderror">
                                            <label for="bank_name">Nama Bank</label>
                                            <input type="text" placeholder="Contoh : BNI , BRI"
                                                class="form-control" name="bank_name" id="bank_name"
                                                value="{{ old('bank_name', $user->psycholog->wallet->bank_name ?? '') }}">
                                            @error('bank_name', 'updateWallet')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div
                                            class="form-group @error('account_number', 'updateWallet') has-error @enderror">
                                            <label for="account_number">Nomor Rekening</label>
                                            <input type="text" class="form-control" name="account_number"
                                                id="account_number"
                                                value="{{ old('account_number', $user->psycholog->wallet->account_number ?? '') }}">
                                            @error('account_number', 'updateWallet')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        {{-- holder name --}}
                                        <div
                                            class="form-group @error('account_holder_name', 'updateWallet') has-error @enderror">
                                            <label for="account_holder_name">Nama Pemilik Rekening</label>
                                            <input type="text" class="form-control" name="account_holder_name"
                                                id="account_holder_name"
                                                value="{{ old('account_holder_name', $user->psycholog->wallet->account_holder_name ?? '') }}">
                                            @error('account_holder_name', 'updateWallet')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-wallet mr-1"></i> Simpan Rekening
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            <div class="col-md-8 offset-md-4 mt-3">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Keamanan Kata Sandi</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div
                                        class="form-group @error('current_password', 'updatePassword') has-error @enderror">
                                        <label for="current_password">Kata Sandi Saat Ini</label>
                                        <input type="password" class="form-control" name="current_password"
                                            id="current_password">
                                        @error('current_password', 'updatePassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('password', 'updatePassword') has-error @enderror">
                                        <label for="new_password">Kata Sandi Baru</label>
                                        <input type="password" class="form-control" name="password"
                                            id="new_password">
                                        @error('password', 'updatePassword')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-key mr-1"></i> Perbarui Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
</x-app-layout>
