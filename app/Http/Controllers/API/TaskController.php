<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\Task; 
use Validator;

class TaskController extends Controller 
{
    public $successStatus = 200;

    /** 
     * List all Task api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function index() 
    {
        $tasks = Task::select('name','description','type')->paginate(10);
        return response()->json(['success' => $tasks], $this-> successStatus); 
    }
    /** 
     * Create Task api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function create(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|max:50', 
            'description' => 'required|max:250', 
            'image' => 'required|mimes:jpg,png,jpeg|max:2048', 
            'type' => 'required|in:1,2,3'
        ],[
            'type' => "The selected type is either 1,2 or 3."
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $image_name = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // $filename = $file->getClientOriginalName();
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images',$fileName);
            $image_name = 'images/'.$fileName;
        }
        
        $task = Task::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $image_name,
            'type' => $request['type'],
        ]);

        $result = [
            'id' => $task->id,
            'name' => $task->name,
            'description' => $task->description,
            'type' => $task->type,
        ];


        return response()->json(['success' => $result], $this-> successStatus); 
    } 

    /** 
     * Show a single Task api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function show($id) 
    {
        $task = Task::select('name','description','type','image')->find($id);
        return response()->json(['success' => $task], $this-> successStatus); 
    }
}
