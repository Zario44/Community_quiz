<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header 
            :title="__('Rejoins le Quiz ! 🎉')" 
            :description="__('Remplis ces quelques infos pour commencer à jouer et enregistrer tes scores.')" 
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="name"
                :label="__('Ton pseudo')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Ex: QuizMaster99')"
            />

            <flux:input
                name="email"
                :label="__('Adresse email')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="joueur@exemple.com"
            />

            <flux:input
                name="password"
                :label="__('Mot de passe')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Ton mot de passe secret')"
                viewable
            />

            <flux:input
                name="password_confirmation"
                :label="__('Confirme ton mot de passe')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Retape ton mot de passe')"
                viewable
            />

            <div class="flex items-center justify-end mt-2">
                <flux:button type="submit" variant="primary" class="w-full bg-indigo-600 hover:bg-indigo-700">
                    {{ __('C\'est parti ! 🚀') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400 mt-2">
            <span>{{ __('Tu as déjà un compte ?') }}</span>
            <flux:link :href="route('login')" class="text-indigo-600 font-semibold hover:underline" wire:navigate>
                {{ __('Connecte-toi ici') }}
            </flux:link>
        </div>
    </div>
</x-layouts.auth>
