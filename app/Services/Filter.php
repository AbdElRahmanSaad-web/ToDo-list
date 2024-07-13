<?php

namespace App\Services;

use App\Models\ToDo;
use Illuminate\Http\Request;

class Filter{

    public function filter_data(Request $request)
    {
        $status = $request->input('status');
        $dueDate = $request->input('due_date');
    
        $tasks = ToDo::where('user_id', auth()->id());
    
        if ($status != 'all') {
            $tasks->where('status', $status);
        }
    
        if ($dueDate) {
            $tasks->whereDate('due_date', $dueDate);
        }
    
        return $tasks->get();
    }
    
}