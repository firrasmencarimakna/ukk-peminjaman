<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Category;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::with('category')->get();
        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.tools.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);
        // Note: Image upload logic can be added here if needed
        Tool::create($request->all());
        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
    }

    public function edit(Tool $tool)
    {
        $categories = Category::all();
        return view('admin.tools.edit', compact('tool', 'categories'));
    }

    public function update(Request $request, Tool $tool)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);
        $tool->update($request->all());
        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->route('admin.tools.index')->with('success', 'Tool deleted successfully.');
    }
}
