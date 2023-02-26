<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class SubtaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubtaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $user = auth()->user();

        $subtask = $user->subtasks()->create([
            'task_id' => $id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Successfully add subtask',
            'data' => $subtask,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubtaskRequest  $request
     * @param  \App\Models\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $subtask = Subtask::find($id);
        $subtask->title = $request->title;
        $subtask->description = $request->description;
        $subtask->save();

        return response()->json([
            'message' => 'Successfully update subtask',
            'data' => $subtask,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subtask = Subtask::find($id);
        $subtask->delete();

        return response()->json([
            'message' => 'Successfully delete subtask',
            'data' => $subtask,
        ]);
    }
}
