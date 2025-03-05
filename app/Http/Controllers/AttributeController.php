<?php

namespace App\Http\Controllers;


use App\Http\Requests\Attribute\StoreAttributeRequest;
use App\Http\Requests\Attribute\UpdateAttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use App\Services\Attribute\AttributeService;

class AttributeController extends Controller
{
    public function index()
    {
        try {
            $response = Attribute::query()->paginate(request('per_page', 10));

            return AttributeResource::collection($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function store(StoreAttributeRequest $request)
    {
        try {
            $response = AttributeService::make($request->validated())->createOrUpdate();

            return AttributeResource::make($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Attribute $attribute, UpdateAttributeRequest $request)
    {
        try {
            $response = AttributeService::make($request->validated(), $attribute)->createOrUpdate();

            return AttributeResource::make($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
