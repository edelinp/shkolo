<div>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-gray-900 font-bold">{{ __('Shkolo Assignment') }}</h1>
        </div>

        <!-- Buttons -->
        @if($buttons->isEmpty())
            <div class=" text-center py-8">
                <p class="text-gray-600">No buttons were found.</p>
            </div>
        @else
            <div class="grid grid-cols-12 gap-6">
                @foreach ($buttons as $button)
                    <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-sm rounded-xl p-2">
                        <div class="relative p-8">
                            <div class="absolute top-0 right-0 inline-flex" x-data="{ open: false, showModal: false }">
                                <button
                                    class="rounded-full"
                                    :class="open ? 'bg-gray-100 text-gray-500': 'text-gray-400 hover:text-gray-500'"
                                    aria-haspopup="true"
                                    @click.prevent="open = !open"
                                    :aria-expanded="open"
                                >
                                    <span class="sr-only">Menu</span>
                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                                        <circle cx="16" cy="16" r="2" />
                                        <circle cx="10" cy="16" r="2" />
                                        <circle cx="22" cy="16" r="2" />
                                    </svg>
                                </button>
                                <div
                                    class="origin-top-right z-10 absolute top-full right-0 min-w-36 bg-white border border-gray-200 py-1.5 rounded-lg shadow-lg overflow-hidden mt-1"
                                    @click.outside="open = false"
                                    @keydown.escape.window="open = false"
                                    x-show="open"
                                    x-transition:enter="transition ease-out duration-200 transform"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-out duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    x-cloak
                                >
                                    <ul>
                                        <li>
                                            <a class="font-medium text-sm text-gray-600 hover:text-gray-800 flex py-1 px-3" href="{{ route('button.configure', $button->id)  }}" @click="open = false" @focus="open = true" @focusout="open = false">Edit button</a>
                                        </li>
                                        <li>
                                            <button
                                                class="font-medium text-sm text-red-500 hover:text-red-600 flex py-1 px-3"
                                                wire:click="clearButton({{ $button->id }})">
                                                Clear
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <a
                                class="block text-gray-900 border border-gray-500 text-center rounded-xl min-h-6"
                                href="{{ $button->hyperlink ?? route('button.configure', $button->id) }}"
                                style="background-color: {{ $button->color }}"
                            >
                                {{ $button->title ?? '+' }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
