<?php

namespace App\Http\Controllers;

use App\Models\Grandson;
use App\Models\Son;
use Illuminate\Http\Request;

class GrandsonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sonId = \request()->has('son_id') && \request()->input('son_id') !== '' ? \request()->input('son_id') : null;
        if (!$sonId) {
            $grandsons = collect([]);
            auth()->user()->sons()->each(function ($son) use ($grandsons) {
                $grandsons->add($son->grandsons);
            });

            $grandsons = collect($grandsons->flatten())->paginate(5);

        }else {
            $grandsons = auth()->user()->sons()->with('grandsons')
                ->where('_id', $sonId)->first()->grandsons->paginate(5);
        }
        return view('grandsons.index', compact('grandsons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sons = auth()->user()->sons;
        return view('grandsons.create', compact('sons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
                
        $request->validate([
            'son_id' => 'required',
            'name' => 'required',
            'birth_date' => 'required|date_format:Y-m-d'
        ]);

       // dd($request->all());

       Grandson::insert([
           'son_id' => $request->input('son_id'),
           'name' => $request->input('name'),
           'birth_date' => $request->input('birth_date')
       ]);
        
        return back()->with('status', 'GrandSon is Inserted');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Grandson $grandson) // Because use resource
    {
        $sons = auth()->user()->sons;
        return view('grandsons.edit',compact('sons','grandson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grandson $grandson)
    {
        $request->validate([
            'son_id' => 'required',
            'name' => 'required',
            'birth_date' => 'required|date_format:Y-m-d'
        ]);

        $grandson->update([
            'son_id' => $request->input('son_id'),
            'name' => $request->input('name'),
            'birth_date' => $request->input('birth_date'),
        ]);

        return back()->with('status', 'Grandson is updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grandson $grandson)
    {
        $grandson->delete();
        return back()->with('status', 'Grandson is Deleted');
    }
}
