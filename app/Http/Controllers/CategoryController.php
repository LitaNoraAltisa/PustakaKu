<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll()->loadCount('books');
        $totalBooks = $categories->sum('books_count');
        $maxCount = $categories->max('books_count');
        $topCategory = $categories->where('books_count', $maxCount)->pluck('name')->join(', ');

        return view('categories.index', compact('categories', 'totalBooks', 'maxCount', 'topCategory'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);

        $this->categoryRepository->store($data);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->findById($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);

        $this->categoryRepository->update($id, $data);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
