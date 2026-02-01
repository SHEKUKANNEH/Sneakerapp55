<?php

namespace App\Http\Controllers;

use App\Models\Sneaker;
use Illuminate\Http\Request;

class SneakerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $query = Sneaker::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('color', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Filter by color
        if ($request->filled('color')) {
            $query->where('color', 'like', "%{$request->color}%");
        }

        $sneakers = $query->latest()->paginate(9)->withQueryString();

        // Get unique brands and colors for filter dropdowns
        $brands = Sneaker::distinct()->pluck('brand')->sort()->values();
        $colors = Sneaker::distinct()->pluck('color')->filter()->sort()->values();

        return view('sneakers.index', compact('sneakers', 'brands', 'colors'));
    }

    public function create()
    {
        return view('sneakers.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateSneaker($request);

        Sneaker::create($data);

        return redirect()
            ->route('sneakers.index')
            ->with('status', 'Sneaker created.');
    }

    public function show(Sneaker $sneaker)
    {
        return view('sneakers.show', compact('sneaker'));
    }

    public function edit(Sneaker $sneaker)
    {
        return view('sneakers.edit', compact('sneaker'));
    }

    public function update(Request $request, Sneaker $sneaker)
    {
        $data = $this->validateSneaker($request);

        $sneaker->update($data);

        return redirect()
            ->route('sneakers.show', $sneaker)
            ->with('status', 'Sneaker updated.');
    }

    public function destroy(Sneaker $sneaker)
    {
        $sneaker->delete();

        return redirect()
            ->route('sneakers.index')
            ->with('status', 'Sneaker deleted.');
    }

    public function updatePrice(Request $request, Sneaker $sneaker)
    {
        $data = $request->validate([
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $sneaker->update($data);

        return redirect()
            ->route('sneakers.index')
            ->with('status', 'Price updated.');
    }

    private function validateSneaker(Request $request): array
    {
        return $request->validate([
            'brand' => ['required', 'string', 'max:80'],
            'model' => ['required', 'string', 'max:80'],
            'color' => ['nullable', 'string', 'max:80'],
            'price' => ['required', 'numeric', 'min:0'],
            'image_url' => ['required', 'url', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);
    }
}

