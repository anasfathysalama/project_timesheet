<?php

namespace App\Http\Controllers;


use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\Project\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        try {
            $response = Project::query()
                ->byName($request->input('filters.name'))
                ->byStatus($request->input('filters.status'))
                ->byDynamicFilters($request->input('filters', []))
                ->with(['attributeValues.attribute', 'users'])
                ->paginate(request('per_page', 10));

            return ProjectResource::collection($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function store(StoreProjectRequest $request)
    {
        try {
            $response = ProjectService::make($request->validated())->createOrUpdate();

            return ProjectResource::make($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show(Project $project)
    {
        return ProjectResource::make(
            $project->load(['attributeValues.attribute', 'users'])
        );
    }

    public function update(Project $project, UpdateProjectRequest $request)
    {
        try {
            $response = ProjectService::make($request->validated(), $project)->createOrUpdate();

            return ProjectResource::make($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy(Project $project)
    {
        try {
            $project->delete();

            return response()->json(['message' => 'Project deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
