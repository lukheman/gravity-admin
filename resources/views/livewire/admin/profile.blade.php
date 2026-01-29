<div>
    {{-- Page Header --}}
    <x-admin.page-header title="Profile" subtitle="Kelola informasi akun Anda">
        <x-slot:actions>
            <x-admin.badge variant="success" icon="fas fa-user-check">
                {{ Auth::user()->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi' }}
            </x-admin.badge>
        </x-slot:actions>
    </x-admin.page-header>

    {{-- Flash Messages --}}
    @if (session('success'))
        <x-admin.alert variant="success" title="Berhasil!" class="mb-4">
            {{ session('success') }}
        </x-admin.alert>
    @endif

    @if (session('error'))
        <x-admin.alert variant="danger" title="Error!" class="mb-4">
            {{ session('error') }}
        </x-admin.alert>
    @endif

    <div class="row g-4">
        {{-- Profile Info Card --}}
        <div class="col-lg-4">
            <div class="modern-card text-center">
                <div class="user-avatar mx-auto mb-3" style="width: 100px; height: 100px; font-size: 2.5rem;">
                    {{ Auth::user()->initials() }}
                </div>
                <h4 style="color: var(--text-primary); font-weight: 600;">{{ Auth::user()->name }}</h4>
                <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                <x-admin.badge variant="primary" icon="fas fa-user-shield">Administrator</x-admin.badge>

                <hr style="border-color: var(--border-color); margin: 1.5rem 0;">

                <div class="text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Bergabung</span>
                        <span style="color: var(--text-primary);">{{ Auth::user()->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Terakhir diperbarui</span>
                        <span style="color: var(--text-primary);">{{ Auth::user()->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Profile Card --}}
        <div class="col-lg-8">
            {{-- Profile Information --}}
            <div class="modern-card mb-4">
                <div class="preview-title d-flex align-items-center gap-2">
                    <i class="fas fa-user-edit" style="color: var(--primary-color);"></i>
                    Informasi Profile
                </div>

                <form wire:submit="updateProfile">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                wire:model="name" placeholder="Masukkan nama lengkap">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span
                                    style="color: var(--danger-color);">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                wire:model="email" placeholder="Masukkan email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <x-admin.button type="submit" variant="primary" icon="fas fa-save">
                            Simpan Perubahan
                        </x-admin.button>
                    </div>
                </form>
            </div>

            {{-- Change Password --}}
            <div class="modern-card">
                <div class="preview-title d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-lock" style="color: var(--warning-color);"></i>
                        Ubah Password
                    </div>
                    <x-admin.button type="button" variant="{{ $showPasswordSection ? 'danger' : 'outline' }}" size="sm"
                        wire:click="togglePasswordSection">
                        {{ $showPasswordSection ? 'Batal' : 'Ubah Password' }}
                    </x-admin.button>
                </div>

                @if($showPasswordSection)
                    <form wire:submit="updatePassword" class="mt-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="current_password" class="form-label">Password Saat Ini <span
                                        style="color: var(--danger-color);">*</span></label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" wire:model="current_password"
                                    placeholder="Masukkan password saat ini">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Password Baru <span
                                        style="color: var(--danger-color);">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" wire:model="password" placeholder="Masukkan password baru">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                        style="color: var(--danger-color);">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    wire:model="password_confirmation" placeholder="Konfirmasi password baru">
                            </div>
                        </div>

                        <x-admin.alert variant="info" class="mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Password harus minimal 8 karakter dan mengandung huruf dan angka.
                        </x-admin.alert>

                        <div class="d-flex justify-content-end mt-4">
                            <x-admin.button type="submit" variant="warning" icon="fas fa-key">
                                Perbarui Password
                            </x-admin.button>
                        </div>
                    </form>
                @else
                    <p class="text-muted mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        Klik tombol "Ubah Password" untuk memperbarui password Anda.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>