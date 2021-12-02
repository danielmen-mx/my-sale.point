<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Costumer;
use Illuminate\Http\Request;

class CostumerController extends Controller
{
    public function index()
    {
        $costumers = Costumer::oldest()->paginate(5);       // latest or oldest to order by entry

        return view('costumers.index', compact('costumers'));
    }

    public function create()
    {
        return view('costumers.create');
    }

    public function store(Request $request)
    {
        $costumers = Costumer::create([ 
            'costumer_id' => auth()->user()->id
        ] + $request->all());

        return back()->with('status', 'Create Success');
    }

    public function show($id)
    {
        //
    }

    public function edit(Costumer $costumer)
    {
        return view('costumers.edit', compact('costumer'));
    }

    public function update(Request $request, Costumer $costumer)
    {
        $costumer->update($request->all());

        return back()->with('status', 'Updated success');
    }

    public function destroy($id)
    {
        $costumer = Costumer::find($id);
        $costumer->delete();
        return back()->with('status', 'Delete Success');
    }
}
