<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects)->setStatusCode(200, 'Successful task lists output');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function store(Request $request)
    {
        /**
         * @var Validator $validator
         */
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string',
            //'project_description' => 'string'
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        /**
         * @var Project $project
         * @var Column $prot_column
         */
        $project = Project::create([
            'name' => $request->project_name,
            //'project_descr' => $request->project_description
        ]);

        $prot_column1 = Column::create([
            'name' => ('Done'),
            'project_id' => $project->id,
            'protected' => true
        ]);

        $prot_column2 = Column::create([
            'name' => ('To Do'),
            'project_id' => $project->id,
            'protected' => false
        ]);

        $prot_column3 = Column::create([
            'name' => ('Work in progress'),
            'project_id' => $project->id,
            'protected' => false
        ]);
        return response()->json(['status' => 'Project successfully created', 'data' => [$project, $prot_column1, $prot_column2, $prot_column3]], 200)->setStatusCode(200, 'Successful task list creation');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function show(Project $project)
    {
        $columns = ColumnController::show_out($project->id);
        return response()->json(['status' => 'Successful project extraction', 'data' => [$project, $columns]], 200)->setStatusCode(200, 'Successful project extraction');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function update(Request $request, Project $project)
    {
        /**
         * @var Validator $validator
         */
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string',
            //'project_descr' => 'string'
        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 200);
        }

        $project->update([
            'name' => $request->project_name,
            //'project_descr' => $request->project_description
            ]);
        return response()->json($project)->setStatusCode(200,'Successful task list update');// json_encode
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        if($project->delete()) {
            return response(null, 200);
        }
    }
}
