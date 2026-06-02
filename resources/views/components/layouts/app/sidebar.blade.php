<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">


            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Navigation')" class="grid">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Tableau de bord') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            @if(Auth::user()->is_admin)
                <flux:sidebar.nav>
                    <flux:sidebar.item icon="shield-check" :href="route('admin.questions')" :current="request()->routeIs('admin.questions')" wire:navigate>
                        {{ __('Espace Admin') }}
                    </flux:sidebar.item>
                </flux:sidebar.nav>
            @endif

            <flux:sidebar.nav>
                <flux:sidebar.item icon="plus" :href="route('questions-form')" :current="request()->routeIs('questions-form')" wire:navigate>
                    {{ __('Créer une question') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            <flux:sidebar.nav>
                <flux:sidebar.item icon="user" :href="route('user.questions')" :current="request()->routeIs('user.questions')" wire:navigate>
                    {{ __('Mes questions') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            <flux:sidebar.nav>
                <flux:sidebar.item icon="play" :href="route('quiz')" :current="request()->routeIs('quiz')" wire:navigate>
                    {{ __('Lancer le Quiz') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            <flux:spacer />

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />


                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                            data-test="logout-button"
                        >
                            {{ __('Se déconnecter') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>