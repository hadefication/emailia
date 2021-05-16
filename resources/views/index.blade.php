<main class="grid grid-cols-12 text-base text-black">
    <div class="col-span-3 border-r h-screen sticky top-0 left-0">
        <div class="flex items-center p-4 border-b">
            <div class="flex-1">
                <input type="text" class="w-full border-gray-300 h-10 py-1" />
            </div>
            <div class="flex-grow-0 pl-4 flex items-center text-gray-600">
                <button
                    title="{{ __('Mark all emails as read') }}"
                    wire:click="markAllAsRead"
                    type="button"
                    class="w-10 h-10 mx-1 flex items-center justify-center rounded-full hover:bg-blue-500 hover:text-blue-50"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>
                </button>
                <button
                    wire:click="$emitSelf('refresh')"
                    title="{{ __('Refresh') }}"
                    type="button"
                    class="w-10 h-10 mx-1 flex items-center justify-center rounded-full hover:bg-blue-500 hover:text-blue-50"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </button>
                @if($this->emails->isNotEmpty())
                    <button
                        x-data
                        @click="return confirm('{{ __('Are you sure you want to remove all emails?') }}') ? @this.deleteAll() : false;"
                        title="{{ __('Delete all emails') }}"
                        type="button"
                        class="w-10 h-10 mx-1 flex items-center justify-center rounded-full hover:bg-red-500 hover:text-red-50"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                @endif
            </div>
        </div>

        <div wire:key="messages">
            @foreach($this->emails as $key => $email)
                <div
                    wire:click="open({{ $email->id}})"
                    class="px-4 py-2 border-b {{ $email->read ? '' : 'font-semibold' }} cursor-pointer hover:bg-gray-100"
                >
                    {{-- @dump($email->details) --}}
                    <h2>{{ $email->details['subject'] }}</h2>
                    <div class="text-sm">
                        <div>{{ __('to: <:email>', ['email' => array_keys($email->details['to'])[0]]) }}</div>
                        <div class="text-xs">{{ __('Received :time', ['time' => $email->created_at->diffForHumans()]) }}</div>
                    </div>
                </div>
            @endforeach

            @if($this->emails->isEmpty())
                <div class="flex items-center justify-center p-4">
                    <div class="text-gray-600">
                        <div class="flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        </div>
                        <div class="mt-2">{{ __('Your inbox is empty') }}</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-span-9">
        <livewire:emailia-message :id="$messageId" />
    </div>
</main>