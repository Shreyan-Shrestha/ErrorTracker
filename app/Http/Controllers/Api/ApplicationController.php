<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApplicationRequest;
use App\Repositories\Interfaces\ApplicationRepositoryInterface;

class ApplicationController extends Controller
{
    protected ApplicationRepositoryInterface $applicationRepository;

    public function __construct(ApplicationRepositoryInterface $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function index()
    {
        return response()->json($this->applicationRepository->getAll());
    }

    public function store(ApplicationRequest $request)
    {
        $data = $request->validated();

        return response()->json($this->applicationRepository->create($data), 201);
    }

    public function show( int $id)
    {
        return response()->json($this->applicationRepository->getById($id));
    }

    public function update(ApplicationRequest $request, int $id)
    {
        $data = $request->validated();

        return response()->json($this->applicationRepository->update($id, $data));
    }

    public function destroy(int $id)
    {
        return response()->json($this->applicationRepository->delete($id));
    }
}