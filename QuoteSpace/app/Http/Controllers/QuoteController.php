<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuoteController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a paginated list of published quotes with optional search.
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $quotes = Quote::with('user')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('content', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('quotes.index', compact('quotes', 'search'));
    }

    /**
     * Display quotes authored by the authenticated user.
     */
    public function myQuotes(Request $request)
    {
        $search = trim($request->input('search', ''));

        $quotes = $request->user()
            ->quotes()
            ->with('user')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('content', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('quotes.my-quotes', compact('quotes', 'search'));
    }

    /**
     * Show the form for creating a new quote.
     */
    public function create()
    {
        return view('quotes.create');
    }

    /**
     * Store a newly created quote in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'min:3', 'max:155'],
        ], [
            'content.min' => 'A quote must contain at least 3 characters.',
            'content.max' => 'A quote cannot exceed 155 characters.',
        ]);

        $request->user()->quotes()->create([
            'content' => trim($validated['content']),
        ]);

        return redirect()->route('quotes.my-quotes')->with('success', 'Your quote was published successfully!');
    }

    /**
     * Show the form for editing the specified quote.
     */
    public function edit(Quote $quote)
    {
        $this->authorize('update', $quote);

        return view('quotes.edit', compact('quote'));
    }

    /**
     * Update the specified quote in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        $this->authorize('update', $quote);

        $validated = $request->validate([
            'content' => ['required', 'string', 'min:3', 'max:155'],
        ], [
            'content.min' => 'A quote must contain at least 3 characters.',
            'content.max' => 'A quote cannot exceed 155 characters.',
        ]);

        $quote->update([
            'content' => trim($validated['content']),
        ]);

        return redirect()->route('quotes.my-quotes')->with('success', 'Quote updated successfully!');
    }

    /**
     * Remove the specified quote from storage.
     */
    public function destroy(Quote $quote)
    {
        $this->authorize('delete', $quote);

        $quote->delete();

        return redirect()->route('quotes.my-quotes')->with('success', 'Quote deleted successfully.');
    }
}
