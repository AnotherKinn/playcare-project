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
        try {
            // ✅ Validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|numeric|min:1',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'allergy' => 'nullable|string|max:255',
                'notes' => 'nullable|string|max:500',
            ], [
                'name.required' => 'Nama anak wajib diisi.',
                'name.string' => 'Nama anak harus berupa teks.',
                'name.max' => 'Nama anak tidak boleh lebih dari 255 karakter.',

                'age.required' => 'Usia anak wajib diisi.',
                'age.numeric' => 'Usia harus berupa angka.',
                'age.min' => 'Usia minimal 1 tahun.',

                'gender.required' => 'Jenis kelamin wajib dipilih.',
                'gender.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',

                'allergy.max' => 'Keterangan alergi terlalu panjang (maksimal 255 karakter).',
                'notes.max' => 'Catatan terlalu panjang (maksimal 500 karakter).',
            ]);


            // ✅ Simpan ke database
            Child::create([
                'parent_id' => Auth::id(),
                'name' => $validated['name'],
                'age' => $validated['age'],
                'gender' => $validated['gender'],
                'allergy' => $validated['allergy'] ?? 'Tidak ada',
                'notes' => $validated['notes'] ?? null,
            ]);

            // ✅ Notifikasi sukses
            return redirect()->route('parent.data-children.index')
                ->with('success', 'Data anak berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // ❌ Error validasi (Laravel akan redirect otomatis ke create)
            throw $e;
        } catch (\Exception $e) {
            // ❌ Error lain seperti DB error
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $child = Child::where('parent_id', Auth::id())->findOrFail($id);
        return view('parent.data-children.edit', compact('child'));
    }

    public function update(Request $request, $id)
    {
        try {
            $child = Child::where('parent_id', Auth::id())->findOrFail($id);

            $validated = $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'age' => 'required|numeric|min:1',
                    'gender' => 'required|in:Laki-laki,Perempuan',
                    'allergy' => 'nullable|string|max:255',
                    'notes' => 'nullable|string|max:500',
                ],
                [
                    'name.required' => 'Nama anak wajib diisi.',
                    'name.string' => 'Nama anak harus berupa teks.',
                    'name.max' => 'Nama anak tidak boleh lebih dari 255 karakter.',

                    'age.required' => 'Usia anak wajib diisi.',
                    'age.numeric' => 'Usia harus berupa angka.',
                    'age.min' => 'Usia minimal 1 tahun.',

                    'gender.required' => 'Jenis kelamin wajib dipilih.',
                    'gender.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',

                    'allergy.max' => 'Keterangan alergi terlalu panjang (maksimal 255 karakter).',
                    'notes.max' => 'Catatan terlalu panjang (maksimal 500 karakter).',
                ]
            );

            $child->update($validated);

            return redirect()->route('parent.data-children.index')
                ->with('success', 'Data anak berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $child = Child::where('parent_id', Auth::id())->findOrFail($id);
        $child->delete();

        return redirect()->route('parent.data-children.index')
            ->with('success', 'Data anak berhasil dihapus!');
    }
}
