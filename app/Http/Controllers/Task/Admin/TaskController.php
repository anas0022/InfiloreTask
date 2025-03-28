<?php

namespace App\Http\Controllers\Task\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {   
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'due_date' => 'required|date',
                'status' => 'required|in:Pending,In Progress,Completed',
                'priority' => 'required|in:Low,Medium,High',
                'user_id' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            
            // Format the date properlya
            $dueDate = date('Y-m-d', strtotime($request->input('due_date')));

            if($request->filled('id')) {
                $task = Task::findOrFail($request->input('id'));
                $task->update([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'due_date' => $dueDate,
                    'status' => $request->input('status'),
                    'priority' => $request->input('priority'),
                    'user_id' => $request->input('user_id'),
                ]);
                $message = 'Task updated successfully';
            } else {
                Task::create([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'due_date' => $dueDate,
                    'status' => $request->input('status'),
                    'priority' => $request->input('priority'),
                    'user_id' => $request->input('user_id'),
                ]);
                $message = 'Task created successfully';
            }

            return response()->json([
                'success' => true, 
                'message' => $message
            ]);

        } catch(\Exception $e) {
            \Log::error('Task creation failed: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Task operation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function list(){
        $tasks = Task::with('user')->get();
        
        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }
    public function delete($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
            ]);
        }
}