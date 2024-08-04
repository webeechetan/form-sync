<?php

namespace App\Http\Controllers;

use App\Models\FormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Domain;
use App\Models\User;

class FormDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formDatas = FormData::where('user_id',auth()->user()->id)->get();
        return view('admin.form-data.index',compact('formDatas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sender_info = [
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'referer' => $request->header('referer'),
            'origin' => $request->header('origin'),
            'host' => $request->header('host'),
        ];

        $domain = Domain::where('name',$sender_info['origin'])->first();
        if(!$domain){
            return response()->json(['message' => 'Unauthorized','status'=>'failed'],401);
        }

        $user = User::find($domain->user_id);
        
        if(!$user){
            return response()->json(['message' => 'Unauthorized','status'=>'failed'],401);
        }

        $data = $request->all();

        // Identify the file input dynamically
        foreach ($request->files as $key => $file) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('public/images');
                $data[$key] = Storage::url($path);
            }
        }

        $formName = $request->form_name;
        if(!$formName){
            $formName = 'default';
        }

        $formData = new FormData();
        $formData->user_id = $user->id;
        $formData->data = json_encode($data);
        $formData->sender_info = json_encode($sender_info);
        $formData->form_name = $formName;
        $formData->save();

        return response()->json([
            'message' => 'Form data saved successfully',
            'status' => 'success'
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(FormData $formData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormData $formData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormData $formData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormData $formData)
    {
        //
    }
}
