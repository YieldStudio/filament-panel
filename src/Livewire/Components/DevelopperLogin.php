<?php

declare(strict_types=1);

namespace YieldStudio\FilamentPanel\Livewire\Components;

use Exception;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class DevelopperLogin extends Component
{
    public array $users = [];

    public string $modelClass;

    public function mount(array $users, string $modelClass): void
    {
        $this->users = $users;
        $this->modelClass = $modelClass;
    }

    #[On('loginAsDevelopper')]
    public function loginAsDevelopper(string $credentials, string $panelID): void
    {
        try {
            $modelClass = $this->modelClass;
            $panel = Filament::getPanel($panelID);
            $guard = $panel->getAuthGuard();

            if (! in_array($credentials, $this->users)) {
                $this->addError('developer-login-failed', __('yield-panel::developper-login.errors.user-not-found'));

                return;
            }

            $user = $modelClass::where(
                'email',
                $credentials
            )->first();

            if ($user) {
                Auth::guard($guard)->login($user);
                session()->regenerate();
                redirect()->intended($panel->getUrl());

                return;
            }

            $this->addError('developer-login-failed', __('yield-panel::developper-login.errors.user-not-found'));

        } catch (Exception $exception) {
            $this->addError('developer-login-failed', __('yield-panel::developper-login.errors.login-failed', ['message' => $exception->getMessage()]));
        }
    }

    public function render(): \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\View\View
    {
        return view('yield-panel::livewire.components.developper-login', [
            'users' => $this->users,
        ]);
    }
}
