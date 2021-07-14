<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function index()
    {
        
        $forms = Form::all()->toArray();
        return array_reverse($forms);      
    }

    public function store(Request $request)
    {
        
        if($request->file) {
            $id = rand(1,999);
            $upload_path = public_path('upload');
            $generated_new_name = time() . '-new-' . $id . '.' . $request->file->getClientOriginalExtension();
            $request->file->move($upload_path, $generated_new_name);
        } else {
            $generated_new_name = 'default-user.png';
        }
        $file_path = $generated_new_name;
        $form = new Form([
            'file_path' => $file_path,
            'category' => $request->input('category'),
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        $form->save();

        return response()->json('Post created!');
    }

    public function show($id)
    {
        $form = Form::find($id);
        return response()->json($form);
    }
public function updateImage(Request $request)
{ 
    if($request->file) {
            
    $upload_path = public_path('upload');
    $generated_new_name = time() . '-new-'. $request->id . '.' . $request->file->getClientOriginalExtension();
    $request->file->move($upload_path, $generated_new_name);
} else {
    $generated_new_name = 'default-user.png';
}

return response()->json($generated_new_name);
}
    public function update(Request $request,$id)
    {
        
        
        $form = Form::findOrFail($id);
        $form->fill($request->all())->save();
        return response()->json('Post update');
    }

    public function destroy($id)
    {
        $form = Form::find($id);
        $form->delete();

        return response()->json('Post deleted!');
    }
}
