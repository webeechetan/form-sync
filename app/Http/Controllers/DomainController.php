<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domains = Domain::where('user_id',auth()->id())->get();

        // dd($domains);
        return view('admin.domains.index',compact('domains'));
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
        $request->validate([
            'name' => 'required',
        ]);

        $domain = new Domain();
        $domain->name = $request->name;
        $domain->user_id = auth()->id();
        $domain->save();

        return redirect()->back()->with('success','Domain added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domain $domain)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Domain $domain)
    {
        $domain = Domain::find($request->id);
        $domain->name = $request->name;

        try {
            $domain->save();
            return response()->json(['success'=>'domain updated successfully.']);
        } catch (\Throwable $th) {
            return response()->json(['error'=>$th->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domain $domain)
    {
        if($domain->delete()){
            return redirect()->route('domains.index');           
        }else{
            return redirect()->back();
        }
    }
}
