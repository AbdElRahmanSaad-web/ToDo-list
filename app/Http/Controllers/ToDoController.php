<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use App\Services\Data;
use App\Services\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ToDoController extends Controller
{
    private $filter;
    private $dataAccess; 
    public function __construct() {
        $this->filter = new Filter();
        $this->dataAccess = new Data();
    }

    public function create_or_update(Request $request, $id=0){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,completed',
        ]);

        $task = $this->dataAccess->create_or_update($request, $id);
        return response()->json(['task' => $task, 'message' => 'Task created or updated successfully']);
    }

    public function destroy($id){
        $task = ToDo::find($id)->delete();

        return redirect(url('/dashboard'))->with('Task Deleted Successfully');
    }


    public function filterTasks(Request $request)
    {
        $filteredTasks = $this->filter->filter_data($request);

        return response()->json($filteredTasks);
    }


    public function get_data($id)
    {
        $task = ToDo::findOrFail($id);

        return response()->json(['task' => $task]);
    }
}
