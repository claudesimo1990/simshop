<div class="fixed {{$positionCss}} @if($hideOnClick) cursor-pointer @endif"
    x-data="{show: false, timeout: null, duration: null}"
    @if($message)
        x-init="() => { duration = @this.duration; clearTimeout(timeout); show = true;
                if( duration > 0 ) {timeout = setTimeout(() => { show = false }, duration); }}"
    @endif
    @new-toast.window="duration = @this.duration; clearTimeout(timeout); show = true;
                if( duration > 0 ) { timeout = setTimeout(() => { show = false }, duration); }"
    @click="if(@this.hideOnClick) { show = false; }"
    x-show="show" x-transition>
    @if($message)
        <div class="rounded-md bg-{{$bgColorCss}}-50 p-4 border-l-4 border-{{$bgColorCss}}-700 py-2 px-3 shadow-md mb-2">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-{{$textColorCss}} max-w-xs">{{$message}}</h3>
                </div>
            </div>
        </div>
    @endif
</div>