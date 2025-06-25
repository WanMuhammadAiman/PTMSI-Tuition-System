<section>
    <header class="mb-2">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="-mt-10 text-xl text-black-600 font-semibold dark:text-black-400">
            {{ __("Account information") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @php
            $inputClasses = 'mt-1 block w-full bg-white border border-yellow-400 rounded-md shadow-sm focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400 focus:ring-offset-0';
        @endphp

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="{{ $inputClasses }}" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="{{ $inputClasses }}" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" name="phone" type="text" class="{{ $inputClasses }}" value="{{ old('phone', auth()->user()->phone) }}" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <textarea id="address" name="address" rows="3" class="{{ $inputClasses }}">{{ old('address', auth()->user()->address) }}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Identification Number -->
        <div class="mt-4">
            <x-input-label for="ic" :value="__('Identification Number')" />
            <x-text-input id="ic" name="ic" type="text" class="{{ $inputClasses }}" value="{{ old('ic', auth()->user()->ic) }}" />
            <x-input-error :messages="$errors->get('ic')" class="mt-2" />
        </div>

        <!-- School Level and Year -->
        <div class="mt-4" x-data="{ level: '{{ old('level', auth()->user()->level) }}' }">
            <x-input-label for="level" :value="__('School Level')" />
            <select id="level" name="level" x-model="level" class="{{ $inputClasses }}">
                <option value="">Select level</option>
                <option value="Primary">Primary School</option>
                <option value="Secondary">Secondary School</option>
            </select>
            <x-input-error :messages="$errors->get('level')" class="mt-2" />

            <div x-show="level === 'Primary'" class="mt-4">
                <x-input-label for="standard" :value="__('Which Standard?')" />
                <select name="standard" class="{{ $inputClasses }}">
                    <option value="">Select standard</option>
                    @for ($i = 1; $i <= 6; $i++)
                        <option value="Standard {{ $i }}" {{ old('standard', auth()->user()->standard) === 'Standard '.$i ? 'selected' : '' }}>Standard {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div x-show="level === 'Secondary'" class="mt-4">
                <x-input-label for="form" :value="__('Which Form?')" />
                <select name="form" class="{{ $inputClasses }}">
                    <option value="">Select form</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="Form {{ $i }}" {{ old('form', auth()->user()->form) === 'Form '.$i ? 'selected' : '' }}>Form {{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
