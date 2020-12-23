<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Response|object
     */
    public function index()
    {
        $columns = Column::all();
        return response()->json($columns)->setStatusCode(200, 'Successful task lists output');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $project_id
     * @return JsonResponse|Response|object
     */
    public function store(Request $request, $project_id)//fix later
    {
        $validator = Validator::make($request->all(), [
            'column_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $column = Column::create([
            'name' => $request->column_name,
            'project_id' => $project_id
        ]);
        return response()->json($column)->setStatusCode(200, 'Successful task list creation');
    }

    /**
     * Display the specified resource.
     *
     * @param Column $column
     * @return JsonResponse|Response|object
     */
    public function show(Column $column)
    {
        return response()->json($column)->setStatusCode(200, 'Successful current task list output');
        //need to upgrade response with tasks
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Column $column
     * @return Application|ResponseFactory|JsonResponse|Response|object|void
     */
    public function update(Request $request, Project $project, Column $column)
    {
        $validator = Validator::make($request->all(), [
            'column_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        if ($column->protected){
            return response()->setStatusCode(200, 'This Column is protected');//no such validation rule
        }

        $column = Column::query()->update([
            'name' => $request->column_name,
        ]);
        return response()->json($column)->setStatusCode(200, 'Successful task list creation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Column $column
     * @return Response
     * @throws \Exception
     */
    public function destroy(Column $column)
    {
        if($column->delete()) {
            return response('Task successfully deleted', 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Column $column
     * @return JsonResponse|Response|object
     */
    public static function show_out($id)
    {
        /** @var Column $columns */
        $columns = Column::where('project_id', $id)->get();
        $columns_id = $columns->pluck('id');
        $tasks = collect(null);
        foreach ($columns_id as $id) {
            /** @var Task $tasks */
            $tasks->push(TaskController::show_out($id));
        }
        $columns->push($tasks);
        return $columns;
    }
}
