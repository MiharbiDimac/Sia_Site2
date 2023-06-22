<?php

namespace App\Http\Controllers;
use App\Models\UserJob;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Traits\ApiResponser;

Class UserController extends Controller {
    use ApiResponser;

    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getUsers(){
        $users = User::all();
        return response()->json($users, 200);
    }
    public function index(){
        $users = User::all();
        return $this->successResponse($users);
    }
    
    public function add(Request $request ){
        
        $rules = [
            'EmployeeID' => 'max:20',
            'EmployeeName' => 'required|max:20',
            'JobID' => 'required|numeric|min:1|not_in:0',
        ];
        
        $this->validate($request,$rules);
        $userjob = UserJob::findOrFail($request->JobID);
        $user = User::create($request->all());

        return $this->successResponse($user,Response::HTTP_CREATED);
    }

    public function show($EmployeeID){

        $user = User::findOrFail($EmployeeID);
        return $this->successResponse($user);
    }

    public function update(Request $request,$EmployeeID){

        $rules = [
            'EmployeeID' => 'max:20',
            'EmployeeName' => 'max:20',
            'JobID' => 'required|numeric|min:1|not_in:0',
        ];
    
        $this->validate($request, $rules);
        $userjob = UserJob::findOrFail($request->JobID);
        $user = User::findOrFail($EmployeeID);
        $user->fill($request->all());
        
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must
            change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $user->save();
        return $this->successResponse($user);
    }

    public function delete($EmployeeID){
        
        $user = User::findOrFail($EmployeeID);
        $user->delete();
        
        return $this->successResponse($user);
    }
}