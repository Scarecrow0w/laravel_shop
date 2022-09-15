<div {{ $attributes->merge(['class'=>'bg-gray-100 border-l-8 border-gray-200'])->except(['title', 'price', 'action']) }}>
    <div class="flex items-center p-4 border border-gray-100">
        <div class="flex items-center justify-center w-16 h-16 bg-white border border-gray-300">
            <x-logo-outline class="w-8 h-8"/>
        </div>

        <div class="flex-grow ml-4">
            <h3 class="flex justify-between text-lg font-semibold">
                <span>{{ $title ?? '' }} id: {{ $product }}</span>
                @isset($amount)
                    {{ $amount }} &times;
                @endisset
            </h3>
            <div class="text-green-500 font-display">{{ $price ?? '' }}</div>
        </div>
    </div>
    @php
        use Illuminate\Support\Facades\Auth;
    @endphp

    @isset($actionUrl)
        <div class="flex justify-end px-4 pb-4">
            <a href="{{ Auth::user() ? $actionUrl : route('login') }}">
                <x-button type="button">
                    {{ Auth::user() ? $actionLabel ?? 'Add to cart' : 'Log in' }}
                </x-button>
            </a>
        </div>
    @endisset
</div>
