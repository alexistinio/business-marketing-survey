@if ($paginator->hasPages())
<div class="grid px-4 py-3 text-xs font-light tracking-wide text-[#8a82a1] uppercase border-t border-[#8a82a1] sm:grid-cols-9 ">
    <span class="flex items-center col-span-3">
        Showing 
        <span class="font-medium mx-1">{{ $paginator->firstItem() }}</span> 
        to
        <span class="font-medium mx-1">{{ $paginator->lastItem() }}</span> 
        <span class="mr-1">of</span>
        <span class="font-medium">{{ $paginator->total() }}</span>
    </span>
    <span class="col-span-2"></span>
    <!-- Pagination -->
    <span class="flex col-span-4 mt-2 justify-center md:mt-auto md:justify-end">
        <nav aria-label="Table navigation">
            <ul class="inline-flex items-center">
                <li>
                    @if ($paginator->onFirstPage())
                    <span
                        class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                        >
                        <svg aria-hidden="true" class="w-4 h-4 fill-current"
                            viewBox="0 0 20 20">
                            <path
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </span>
                    @else
                    <button
                        class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                        aria-label="Previous"
                        wire:key='previousButton' wire:click.prevent="previousPage" wire:loading.attr="disabled" rel="prev"
                        >
                        <svg aria-hidden="true" class="w-4 h-4 fill-current"
                            viewBox="0 0 20 20">
                            <path
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                    @endif
                </li>
                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if (is_string($element))
                            <li class="page-item disabled px-3 py-2 bg-gray-200 text-gray-600 d-none d-md-block" aria-disabled="true">
                                <span class="page-link">{{ $element }}
                                </span>
                            </li>
                            @endif

                            @if ($page == $paginator->currentPage())
                                <li>
                                    <span
                                        class="px-3 py-1 text-white transition-colors duration-150 bg-[#00c2cb] border border-r-0 border-[#00c2cb] rounded-md focus:outline-none focus:shadow-outline-purple">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                            <li>
                                <button wire:key='{{$page}}' wire:click="setPage('{{ $page }}')"
                                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                    {{ $page }}
                                </button>
                            </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
              

                <li>
                    @if ($paginator->hasMorePages())
                        <button
                            wire:key='nextButton' wire:click.prevent="nextPage" wire:loading.attr="disabled" rel="next"
                            class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                            aria-label="Next">
                            <svg class="w-4 h-4 fill-current" aria-hidden="true"
                                viewBox="0 0 20 20">
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    @else
                        <span
                            class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                            aria-label="Next">
                            <svg class="w-4 h-4 fill-current" aria-hidden="true"
                                viewBox="0 0 20 20">
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </span>
                    @endif
                    
                </li>
            </ul>
        </nav>
    </span>
</div>
@endif