<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Http\Resources\Document\DocumentCollection;
use App\Http\Resources\Document\DocumentResource;
use App\Models\Document;
use App\Service\DocumentService;

class DocumentController extends Controller
{
    public function __construct(protected DocumentService $documentService){}

    public function index()
    {
        try {
            $documents = $this->documentService->getAll();
            return new DocumentCollection($documents);
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    public function store(DocumentRequest $request)
    {
        try {
            $document = $this->documentService->create($request);
            return new DocumentResource($document);
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }    }

    public function show(Document $document)
    {
        try {
            return new DocumentResource($this->documentService->getOne($document->id));
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    public function update(DocumentRequest $request, Document $document)
    {
        try {
            $document = $this->documentService->update($request, $document->id);
            return new DocumentResource($document);
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy(Document $document)
    {
        try {
            $this->documentService->delete($document->id);
            return $this->successResponse(null, 204);
        } catch (\Throwable $e) {
            return $this->errorResponse($e);
        }
    }
}
