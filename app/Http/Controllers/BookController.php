<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Repositories\Contracts\AuthorRepositoryInterface;   
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\BookService;

class BookController extends Controller
{
    protected $bookRepository;
    protected $categoryRepository;
    protected $authorRepository;
    protected $bookService;

    public function __construct(
        BookRepositoryInterface $bookRepository,
        CategoryRepositoryInterface $categoryRepository,
        AuthorRepositoryInterface $authorRepository,
        BookService $bookService,
    ) {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookRepository->getAll()->load(['category', 'author']);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        $authors = $this->authorRepository->getAll();
        return view('books.create', compact('categories', 'authors'));
    }

    public function store(BookRequest $request)
    {
        $this->bookService->store(
            $request->validated(),
            $request->hasFile('cover') ? $request->file('cover') : null
        );

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(string $slug)
    {
        $book = $this->bookRepository->findBySlug($slug);
        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = $this->bookRepository->findById($id);
        $categories = $this->categoryRepository->getAll();
        $authors = $this->authorRepository->getAll();
        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    public function update(BookRequest $request, $id)
    {
        $this->bookService->update(
            $id,
            $request->validated(),
            $request->hasFile('cover') ? $request->file('cover') : null
        );

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diupdate.');
    }

    public function destroy($id)
    {
        $this->bookRepository->delete($id);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
