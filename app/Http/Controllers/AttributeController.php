<?php

namespace App\Http\Controllers;


use App\Http\Requests\Attribute\StoreAttributeRequest;
use App\Http\Requests\Attribute\UpdateAttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use App\Services\Attribute\AttributeService;
use Illuminate\Http\JsonResponse;

class AttributeController extends Controller
{
    public function create(StoreAttributeRequest $request)
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
