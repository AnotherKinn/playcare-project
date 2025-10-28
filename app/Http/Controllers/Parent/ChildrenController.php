<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    public function index()
    {
        $children = Child::where('parent_id', Auth::id())->get();
        return view('parent.data-children.index', compact('children'));
    }

    public function create()
    {
        return view('parent.data-children.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'allergy' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        Child::create([
            'parent_id' => Auth::id(),
            'name' => $validated['name'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'allergy' => $validated['allergy'] ?? 'Tidak ada',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('parent.data-children.index')
            ->with('success', 'Data anak berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $child = Child::where('parent_id', Auth::id())->findOrFail($id);
        return view('parent.data-children.edit', compact('child'));
    }

    public function update(Request $request, $id)
    {
        $child = Child::where('parent_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric|min:1',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'allergy' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $child->update($validated);

        return redirect()->route('parent.data-children.index')
            ->with('success', 'Data anak berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $child = Child::where('parent_id', Auth::id())->findOrFail($id);
        $child->delete();

        return redirect()->route('parent.data-children.index')
            ->with('success', 'Data anak berhasil dihapus!');
    }
}
