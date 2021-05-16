<div>
    @if($messageId)
        <div>
            <div class="sticky top-0 bg-white p-4 pb-0">
                <div class="flex justify-between">
                    <div>
                        <h2 class="text-2xl">{{ $this->email->details['subject'] }}</h2>
                        <div class="mt-2">
                            {{-- <x-emailia.contacts
                                label="From"
                                :contacts="$this->email->details['from']"
                            />

                            <x-emailia.contacts
                                label="To"
                                :contacts="$this->email->details['to']"
                            />

                            @if($this->email->details['cc'])
                                <x-emailia.contacts
                                    label="Cc"
                                    :contacts="$this->email->details['cc']"
                                />
                            @endif

                            @if($this->email->details['bcc'])
                                <x-emailia.contacts
                                    label="Bcc"
                                    :contacts="$this->email->details['bcc']"
                                />
                            @endif

                            @if($this->email->details['reply_to'])
                                <x-emailia.contacts
                                    label="Reply to"
                                    :contacts="$this->email->details['reply_to']"
                                />
                            @endif --}}
                        </div>
                    </div>
                    <div class="flex text-gray-600">
                        <button
                            x-data
                            @click="return confirm('{{ __('Are you sure you want to remove this email?') }}') ? @this.remove() : false;"
                            type="button"
                            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-red-500 hover:text-red-50"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>

                        <button
                            wire:click="close"
                            type="button"
                            class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-500 hover:text-gray-50"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center border-b mt-8">
                    @foreach($this->tabs as $key => $label)
                        <button                            
                            wire:click="$set('tab', '{{ $key }}')"
                            type="button"
                            class="h-8 px-4 border-b-[3px] {{ $key === $tab ? 'border-blue-500' : 'border-transparent' }}"
                        >
                            {{ __($label) }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="mt-4 px-4">
                @switch($tab)
                    @case('html')
                        <div
                            wire:key="html"
                            x-data="emailRenderer()"
                            x-init="init()"
                        >
                            <div class="flex items-center justify-center py-1">
                                @foreach(['phone', 'tablet', 'desktop'] as $device)
                                    <button
                                        @click.prevent="setMode('{{ $device }}')"
                                        title="{{ __(ucfirst($device)) }}"
                                        class="mx-1 border-b border-transparent h-8 text-gray-700"
                                        :class="{'border-blue-500 text-blue-500': mode == '{{ $device }}', 'border-transparent hover:border-blue-300':  mode != '{{ $device }}'}"
                                    >
                                        @switch($device)
                                            @case('phone')
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                            @break

                                            @case('tablet')
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                            @break

                                            @default
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        @endswitch
                                </button>
                                @endforeach
                            </div>
                            <div class="flex justify-center">
                                <iframe
                                    id="emailRendererElement"
                                    @load="resize()"
                                    class="w-full h-full shadow"
                                    src="{{ route('emailia.message.render', ['id' => $this->email->id]) }}" frameborder="0"
                                ></iframe>
                            </div>
                        </div>
                        @break

                    @case('html_source')
                        <pre
                            wire:key="htmlSource"
                            x-data="codeHighlighter()"
                            x-init="init($el)"
                            class="shadow p-4 bg-white"
                        >
                            <code class="language-html p-0">{{ $this->email->details['content_html'] }}</code>
                        </pre>
                        @break

                    @case('text')
                        <div class="shadow p-4 bg-white" wire:key="text">Text</div>
                        @break

                    @case('raw')
                        <pre class="shadow p-4 bg-white" wire:key="raw">{{ $this->email->details['content_text'] }}</pre>
                        @break
                @endswitch
            </div>
            

            <div class="mt-8 text-sm">
                <p class="text-center">{!! __('Made with &hearts; by Glen Bangkila') !!}</p>
            </div>
        </div>
    @else
        <div class="h-screen bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 bg-blue-600 text-blue-50 flex items-center justify-center">
            <div>
                <h1 class="text-5xl text-center">{{ __('Emailia') }}</h1>
                <h2 class="italic text-xs mt-2">{!! __('Made with &hearts; by Glen Bangkila') !!}</h2>
            </div>
        </div>
    @endif
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/a11y-light.min.css" integrity="sha512-PW96n2amVglidqEDLPUdjJ0zByhT20poSqWJYZRutR6CP2QH58k96WmorqNnC4QXnosNeqMJM8FR/93isIifDQ==" crossorigin="anonymous" />
    @endpush
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js" integrity="sha512-s+tOYYcC3Jybgr9mVsdAxsRYlGNq4mlAurOrfNuGMQ/SCofNPu92tjE7YRZCsdEtWL1yGkqk15fU/ark206YTg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/languages/yaml.min.js" integrity="sha512-w1UGeHQBy7zjHSSPA6To4w12xvKFANmA9yzShsF0k8wLoXYIVgDSTbGL+P8RwEW3ZFnibJsJsKcacTLOcyT7rQ==" crossorigin="anonymous"></script>
        <script>
            function codeHighlighter () {
                return {
                    init (el) {
                        hljs.highlightElement(el.querySelector('code'))
                    }
                }
            }

            function emailRenderer () {
                return {
                    mode: 'desktop',
                    
                    init () {
                        this.resize()

                        window.addEventListener('resize', (event) => {
                            this.resize();
                        })
                    },

                    setMode (newMode) {
                        this.mode = newMode
                        this.resize();
                    },

                    isTablet () {
                        return this.mode === 'tablet'
                    },

                    isPhone () {
                        return this.mode === 'phone'
                    },

                    isDesktop () {
                        return this.mode === 'desktop'
                    },

                    resize () {
                        const el = this.getRenderer();
                        if (this.isPhone()) {
                            el.style.height = '568px';
                            el.style.width = '320px';
                        } else if (this.isTablet()) {
                            el.style.height = '1024px';
                            el.style.width = '768px';
                        } else {
                            el.style.height = el.contentWindow.document.documentElement.scrollHeight + 'px';
                            el.style.width = '100%';
                        }
                    },

                    getRenderer () {
                        return document.getElementById('emailRendererElement');
                    }
                }
            }
        </script>
    @endpush
@endonce
