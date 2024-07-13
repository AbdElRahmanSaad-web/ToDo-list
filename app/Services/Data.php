<?php


namespace App\Services;

use App\Models\ToDo;
use Illuminate\Http\Request;

class Data{
    public function create_or_update(Request $request, $id){
        $task = new ToDo();
        if($id > 0){
            $task = ToDo::find($id);
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->status = $request->status;
        $task->user_id = auth()->id();

        $task->save();

        return $task;
    }
}