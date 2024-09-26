<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index(){

        $departments = Department::all();
        return view('admin.department.index', compact('departments'));
    }

    public function store(Request $request){

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:departments|max:255',
                'description' => 'nullable',
                'image' => 'nullable|image',
                'status' => 'nullable',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $request->all();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('department_images', 'public');
                $data['image'] = 'storage/'.$imagePath;
            }
            Department::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Department created successfully.'
            ]);
        }
        catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }

    }
    public function show($id){
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    public function update(Request $request, $id){

        try {
            $request->validate([
                'name' => 'required|unique:departments,name,'.$id,
                'image' => 'nullable|image',
            ]);

            $department = Department::findOrFail($id);

            if ($request->hasFile('image')) {
                if (file_exists(public_path($department->image))) {
                    unlink(public_path($department->image));
                }
                $imagePath = $request->file('image')->store('department_images', 'public');
                $department->image = 'storage/'.$imagePath;
            }

            $department->name = $request->name;
            $department->description = $request->description;
            $department->status = $request->status;
            $department->save();

            return response()->json([
                'success' => true,
                'message' => 'Department updated successfully.'
            ]);
        }
        catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
    public function destroy($id){
        $department = Department::findOrFail($id);
        if (file_exists(public_path($department->image))) {
            unlink(public_path($department->image));
        }
        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully.'
        ]);
    }
}
