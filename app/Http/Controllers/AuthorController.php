<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Repositories\Contracts\AuthorRepositoryInterface;

class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }
    
    public function index()
    {
        $authors = $this->authorRepository->getAll()->loadcount('books');
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(AuthorRequest $request)
    {
        $this->authorRepository->store($request->validated());

        return redirect()->route('authors.index')
            ->with('success', 'Penulis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $author = $this->authorRepository->findById($id);
        return view('authors.edit', compact('author'));
    }

    public function update(AuthorRequest $request, $id)
    {
        $this->authorRepository->update($id, $request->validated());

        return redirect()->route('authors.index')
            ->with('success', 'Penulis berhasil diupdate.');
    }

    public function destroy($id)
    {
        $this->authorRepository->delete($id);

        return redirect()->route('authors.index')
            ->with('success', 'Penulis berhasil dihapus.');
    }
}