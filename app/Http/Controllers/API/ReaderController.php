<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reader\StoreRequest;
use App\Http\Resources\Reader\ReaderResource;
use App\Models\Reader;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $reader = Reader::create($data);
        return ReaderResource::make($reader)
            ->response()
            ->setStatusCode(ResponseAlias::HTTP_CREATED);
    }
}
