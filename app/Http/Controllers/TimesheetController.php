<?php

namespace App\Http\Controllers;


use App\Http\Requests\Timesheet\StoreTimesheetRequest;
use App\Http\Requests\Timesheet\UpdateTimesheetRequest;
use App\Http\Resources\TimeSheetResource;
use App\Models\Timesheet;
use App\Services\Timesheet\TimeSheetService;

class TimesheetController extends Controller
{
    public function index()
    {
        $response = Timesheet::query()->with('user')->paginate(request('per_page', 10));

        return TimeSheetResource::collection($response);
    }

    public function store(StoreTimesheetRequest $request)
    {
        try {
            $response = TimeSheetService::make($request->validated())->createOrUpdate();

            return TimeSheetResource::make($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function show(Timesheet $timesheet)
    {
        return TimeSheetResource::make($timesheet);
    }

    public function update(Timesheet $timesheet, UpdateTimesheetRequest $request)
    {
        try {
            $response = TimeSheetService::make($request->validated(), $timesheet)->createOrUpdate();

            return TimeSheetResource::make($response);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy(Timesheet $timesheet)
    {
        try {
            $timesheet->delete();

            return response()->json(['message' => 'Timesheet deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
