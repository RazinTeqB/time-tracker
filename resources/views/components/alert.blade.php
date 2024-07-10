<div
    x-data="{ show: false, message: '', type: '{{ $type }}' }"
    x-init="() => {
        @if (session()->has($type))
            message = '{{ session($type) }}';
            setTimeout(() => {
                show = true;
                setTimeout(() => { show = false; }, 3000);
            }, 800)
        @endif
    }"
    x-on:session-flash.window="() => {
        if($event.detail.type === type) {
            message = $event.detail.message;
            show = true;
            setTimeout(() => { show = false; }, 3000);
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-full"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-full"
    class="sticky top-0 inset-x-0 mt-2 p-4 mb-4 text-sm rounded-lg border dark:border-white/50"
    :class="{
        'bg-blue-50 text-blue-800 dark:bg-gray-800 dark:text-blue-400': '{{ $type }}' === 'info',
        'bg-red-50 text-red-800 dark:bg-gray-800 dark:text-red-400': '{{ $type }}' === 'danger',
        'bg-green-50 text-green-800 dark:bg-gray-800 dark:text-green-400': '{{ $type }}' === 'success',
        'bg-yellow-50 text-yellow-800 dark:bg-gray-800 dark:text-yellow-300': '{{ $type }}' === 'warning'
    }"
    role="alert"
    style="display: none;"
>
    <div x-text="message"></div>
</div>