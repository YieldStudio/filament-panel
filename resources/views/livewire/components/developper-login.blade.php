<div>
@if(count($users) > 0)
    <div class="fi-simple-header">
        <p
            @class([
                "fi-simple-header-subheading mt-0 w-full text-center",
                // Divider lines
                "relative before:content-[''] before:block before:w-full before:absolute before:h-px before:bg-gray-300 dark:before:bg-gray-700 before:top-1/2 before:-translate-y-1/2",
            ])
        >
            <span class="relative px-3 bg-gray-50 dark:bg-gray-800">
                {{ __('yield-panel::developper-login.auth.login-as') }}
            </span>
        </p>

        @if ($errors->has('developer-login-failed'))
            <div class="justify-center text-center mt-2">
                <p class="fi-fo-field-wrp-error-message text-danger-600 dark:text-danger-400">
                    {{ $errors->first('developer-login-failed') }}
                </p>
            </div>
        @endif
    </div>

    <div class="fi-ac fi-width-full mt-4">
        @php
            $panel = Filament\Facades\Filament::getCurrentPanel();
        @endphp

        @foreach ($users as $label => $credentials)
        <x-filament::button
            key="developer-login-{{ $credentials }}"
            outlined="true"
            color="gray"
            value="{{ $credentials }}"
            :icon="\Filament\Support\Icons\Heroicon::User"
            :icon-alias="\Filament\View\PanelsIconAlias::USER_MENU_PROFILE_ITEM"
            wire:click="$dispatch('loginAsDevelopper', { credentials: '{{ $credentials }}', panelID: '{{ $panel->getId() }}' })"
        >
            {{ "$label ($credentials)" }}
        </x-filament::button>
        @endforeach
    </div>
@endif
</div>
