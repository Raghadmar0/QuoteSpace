@props(['quote', 'showOwnerActions' => false])

<div class="bg-white rounded-2xl p-6 border border-stone-200/80 shadow-sm hover:shadow-md transition flex flex-col justify-between h-full relative group">
    <!-- Decorative Quote Mark -->
    <div class="text-stone-200 font-serif text-5xl leading-none absolute top-4 right-5 select-none pointer-events-none group-hover:text-amber-200/50 transition">
        &ldquo;
    </div>

    <div>
        <!-- Quote Content -->
        <blockquote class="font-serif text-stone-800 text-lg leading-relaxed mb-6 italic relative z-10">
            &ldquo;{{ $quote->content }}&rdquo;
        </blockquote>
    </div>

    <div class="pt-4 border-t border-stone-100 flex items-center justify-between gap-4 mt-auto">
        <!-- Author & Date Metadata -->
        <div>
            <p class="text-xs font-semibold text-stone-900 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-600 inline-block"></span>
                {{ $quote->user->name ?? 'Anonymous' }}
            </p>
            <p class="text-[11px] text-stone-400 mt-0.5">
                Published {{ $quote->created_at->format('M j, Y') }}
            </p>
        </div>

        <!-- Owner Action Controls -->
        @if ($showOwnerActions || (auth()->check() && auth()->id() === $quote->user_id))
            <div class="flex items-center gap-2">
                <a href="{{ route('quotes.edit', $quote) }}" class="p-1.5 text-xs text-stone-500 hover:text-emerald-700 hover:bg-emerald-50 rounded-md transition" title="Edit Quote">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </a>

                <form method="POST" action="{{ route('quotes.destroy', $quote) }}" onsubmit="return confirm('Are you sure you want to delete this quote?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 text-xs text-stone-500 hover:text-rose-600 hover:bg-rose-50 rounded-md transition" title="Delete Quote">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
