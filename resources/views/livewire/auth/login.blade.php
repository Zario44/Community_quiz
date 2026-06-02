<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="__('Bon retour parmi nous ! 🎮')" 
            :description="__('Connecte-toi pour retrouver ton score et reprendre la partie.')" 
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="email"
                :label="__('Adresse email')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="joueur@exemple.com"
            />

            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Mot de passe')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Ton mot de passe secret')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0 text-indigo-600 hover:text-indigo-500" :href="route('password.request')" wire:navigate>
                        {{ __('Mot de passe oublié ?') }}
                    </flux:link>
                @endif
            </div>

            <flux:checkbox name="remember" :label="__('Se souvenir de moi')" :checked="old('remember')" />

            <div class="flex items-center justify-end mt-2">
                <flux:button variant="primary" type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700" data-test="login-button">
                    {{ __('Se connecter 🚀') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400 mt-2">
                <span>{{ __('Pas encore de compte ?') }}</span>
                <flux:link :href="route('register')" class="text-indigo-600 font-semibold hover:underline" wire:navigate>
                    {{ __('Rejoins-nous ici') }}
                </flux:link>
            </div>
        @endif
    </div>
</x-layouts.auth>