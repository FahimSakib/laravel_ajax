<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use App\Traits\Uploadable;
use Illuminate\Http\Request;

class CrudIndexController extends Controller
{
    use Uploadable;
     
    public function index(){

        $roles = Role::get();

        $districts = Location::where('parent_id', 0)->orderBy('location_name','asc')->get();

        return view('ajax-crud',compact('roles', 'districts'));
    }

    public function store(UserFormRequest $request){

        $data = $request->validated();

        $collection = collect($data)->except(['avatar','password_confirmation']);
        
        if(request()->file('avatar')){

            $user_avatar_name = str_replace(' ', '', request()->name).'_'.uniqid();

            $avatar = $this->upload_file(request()->file('avatar'),'User',$user_avatar_name);
            
            $collection = $collection->merge(compact('avatar'));
        }

        $result = User::updateOrCreate(['id' => $request->update_id],$collection->all());

        if ($result) {
            $output = ['status' => 'success', 'message' => 'data has been saved successfully'];
        }else{
            $output = ['status' => 'error', 'message' => 'data can not save'];
        }
        return response()->json($output);
        
    }

    public function upazila_lsit(Request $request){
        if ($request->ajax()) {
            if($request->district_id){
                $output = '<option value="">Select Please</option>';
                $upazilas = Location::where('parent_id', $request->district_id)->orderBy('location_name','asc')->get();
                if($upazilas){
                    foreach ($upazilas as $upazila) {
                        $output .= '<option value="'.$upazila->id.'">'.$upazila->location_name.'</option>';
                    }
                }
                return response()->json($output);
            }
        }
    }
}
