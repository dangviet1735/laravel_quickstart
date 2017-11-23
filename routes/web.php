<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get("hello/{id}",function($id){
    echo "Hello Đặng Việt , How old are you ? <br> ".$id;
 });
Route::get("name/{name?}",function($name=""){
    echo "What your name ? <br> My name is: ".$name;
 });
Route::get('role',[
    'middleware'=> 'Role:editor',
    'uses' => 'TestController@index',
]);

Route::get('form',function(){
    return view('form');
});
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');



use App\Task;
use Illuminate\Http\Request;
Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

/**
 * Add New Task
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/')->with(['flash'=>'success','thongbao'=>'Add completed']);
});
Route::get('/tasks/list',function(){
    return view('tasks_list');
});

/**
 * Delete Task
 */
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();

    return redirect('/')->with(['flash'=>'success','thongbao'=>'Delete completed !']);
});