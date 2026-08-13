<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Concerns\ExportsCsv;

class CategoryController extends Controller
{
    use ExportsCsv;

    public function index()
    {
        $categories = Category::orderBy('id')->paginate(5);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        ActivityLog::create([
            'Activity'      => 'Create',
            'category_id'   => $category->id,
            'category_name' => $category->name,
            'details'       => "Category \"{$category->name}\" was created.",
        ]);

        return redirect()->route('categories.index')
            ->with('success', "Category \"{$category->name}\" was added successfully.");
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        ActivityLog::create([
            'Activity'      => 'Update',
            'category_id'   => $category->id,
            'category_name' => $category->name,
            'details'       => "Category \"{$category->name}\" was updated.",
        ]);

        return redirect()->route('categories.index')
            ->with('success', "Category \"{$category->name}\" was updated successfully.");
    }

    public function destroy(Category $category)
    {
        $name = $category->name;

        try {
            // Option A: If category_id in activity_log is not nullable, pass $category->id before deleting
            // Option B: If you've updated migration to nullable(), category_id => null works cleanly

            $category->delete();

            // Log activity AFTER successful deletion
            ActivityLog::create([
                'Activity'      => 'Delete',
                'category_id'   => null, // Requires category_id to be nullable in activity_log migration
                'category_name' => $name,
                'details'       => "Category \"{$name}\" was deleted.",
            ]);
        } catch (\Exception $e) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete: this category is linked to existing products or orders.');
        }

        return redirect()->route('categories.index')
            ->with('success', "Category \"{$name}\" deleted successfully.");
    }
}
