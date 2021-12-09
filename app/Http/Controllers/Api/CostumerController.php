<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CostumerController extends Controller
{
    public function index(Request $request)
    {
        $searchCostumer = $request->searchCostumer;
        if ($searchCostumer == null) {
            $costumers = Costumer::oldest()->get();       // latest or oldest to order by entry
        } else {
            $costumers = Costumer::where('first_name', "LIKE", "%$searchCostumer%")->get();
        }

        // return view('costumers.index', compact('costumers', 'searchCostumer'));
        return response()->json($costumers);
    }

    /** 
     * Store a new customer
     * @param Request $request
     * @return Response 
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=>'required',
            'last_name'=>'required',
            'birthday'=>'required',
            'email'=>['required','unique:costumers'],
            'phone'=>['required','unique:costumers']
        ]);

        if(! $validator->passes()) {     // use this to validate that the data is sending is like the format that we declare
            return response()->json(["error" => $validator->errors() ], 417);   // error 417 is the data not containt the format that is declared
        }

        // $costumer = Costumer::create($request->all());  // this is one form to create the costumer entry, save on a variable and then response that
        // return response($costumer); // this is what you sent...

        return response(Costumer::create($request->all())); // this is the same code up, but with minus code...
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {        
        $costumer=Costumer::find($id);
        $costumer->update($request->all());
        return response()->json($costumer);
    }

    public function destroy($id)
    {
        Costumer::destroy($id);
        return response()->json(["message" => "Customer with id $id deleted"]);
    }
}
