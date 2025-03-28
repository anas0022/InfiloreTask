<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Task\Admin\TaskController;
use App\Http\Controllers\Task\User\UserTaskController;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = User::where('type', null)->get();
        $task = Task::all();
        if(Auth::user()->type != "admin"){
            return view('user.dashboard');
        }
        return view('dashboard', compact('user'));
    })->name('dashboard');

   
        Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/tasks/list', [TaskController::class, 'list'])->name('tasks.list');
        Route::delete('/tasks/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
});


Route::group(['middleware' => ['auth', 'verified']], function(){
Route::get('/user/dashboard', function () {
    if(Auth::user()->type != null){
        return view('dashboard');
    }
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('user.dashboard');
Route::get('/user/tasks/list', [UserTaskController::class, 'list'])->name('user.tasks.list');
Route::put('/tasks/{id}/status', [UserTaskController::class, 'updateStatus'])->name('tasks.updateStatus');

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
