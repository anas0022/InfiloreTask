<?php

namespace App\Http\Controllers\Task\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    public function list(){
        $tasks = Task::with('user')
            ->where('user_id', auth()->user()->id)
            ->get();
        
        return response()->json([
            'data' => $tasks
        ]);
    }
    public function updateStatus(Request $request, Task $task)
    {
      
    
        $task->update(['status' => $request->status]);
    
    
        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $task->status
        ]);
    }
    

}
