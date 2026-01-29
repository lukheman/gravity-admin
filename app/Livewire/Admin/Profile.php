<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.admin.livewire-layout')]
#[Title('Profile - AdminPro')]
class Profile extends Component
{
    public string $name = '';
    public string $email = '';
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public bool $showPasswordSection = false;

    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    protected function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ];

        if ($this->showPasswordSection && $this->password) {
            $rules['current_password'] = ['required', 'current_password'];
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        return $rules;
    }

    protected $messages = [
        'current_password.current_password' => 'Password saat ini tidak sesuai.',
    ];

    public function togglePasswordSection(): void
    {
        $this->showPasswordSection = !$this->showPasswordSection;
        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->resetValidation(['current_password', 'password', 'password_confirmation']);
    }

    public function updateProfile(): void
    {
        $validated = $this->validate();

        $user = Auth::user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        session()->flash('success', 'Profile berhasil diperbarui.');
    }

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->save();

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->showPasswordSection = false;

        session()->flash('success', 'Password berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.profile');
    }
}
