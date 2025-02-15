<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        $query = Translation::query();

        if ($request->has('locale')) {
            $query->where('locale', $request->locale);
        }
        if ($request->has('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }
        if ($request->has('key')) {
            $query->where('key', 'like', "%{$request->key}%");
        }

        return response()->json($query->paginate(50), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'locale' => 'required|string|max:5',
            'key' => 'required|string|max:255|unique:translations,key,NULL,id,locale,' . $request->locale,
            'value' => 'required|string',
            'tags' => 'nullable|array',
        ]);

        $translation = Translation::create($validated);
        Cache::forget("translations_{$validated['locale']}");

        return response()->json($translation, 201);
    }

    public function show(Translation $translation)
    {
        return response()->json($translation, 200);
    }

    public function update(Request $request, Translation $translation)
    {
        $validated = $request->validate([
            'value' => 'sometimes|required|string',
            'tags' => 'nullable|array',
        ]);

        $translation->update($validated);
        Cache::forget("translations_{$translation->locale}");

        return response()->json($translation, 200);
    }

    public function destroy(Translation $translation)
    {
        $translation->delete();
        Cache::forget("translations_{$translation->locale}");

        return response()->json(null, 204);
    }

    public function export(Request $request)
    {
        $locale = $request->get('locale', 'en');

        $translations = Cache::remember("translations_{$locale}", 600, function () use ($locale) {
            return Translation::where('locale', $locale)->pluck('value', 'key');
        });

        return response()->json($translations, 200);
    }
}
