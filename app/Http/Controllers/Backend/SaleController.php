<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDescription;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::latest()->paginate(20);

        return view('sales.index', compact('sales'));
    }

    public function show($id)
    {
        $sale = Sale::find($id); #  select* from sales where id = $id LIMIT 1
        // $sale = Sale::findOrFail($id);   # this do it the same function but with an specially diferentiation, that if the find fail returns a notification more exactly.
        if ($sale) {
            return view('sales.show', compact("sale", "id"));

            // return view('sales.show', [
            //     "sale" => $sale,
            //     "id"    => $id
            // ]);

            // return view('sales.show')->with('sale', $sale); // <---- This method only send 1 paramether

            // return view('sales.show')->with([
            //     "sale" => $sale,
            //     "id"    => $id
            // ]);
        } else {
            return back();
        }
    }

    public function destroy($id)
    {
        // para eliminar un elemento que está relacionado con otro modelo es necesario eliminar todo lo relacionado con ese elemento 
        SaleDescription::where('sale_id', $id)->delete();   // buscar una coincidencia de los elementos que se eliminaran
        $sale = Sale::find($id);
        $sale->delete();
        return back()->with('status', 'Delete Success');
    }

    public function store(StoreSaleRequest $request)
    {
        // $validator = Validator::make($request->all(), [  # Esta es una forma de ingresar de forma manual una validación de los datos, si deseamos que laravel realize está validación lo hacemos a través del archivo creado StoreSaleRequest.
        //     'total' => 'required',
        //     "description" => "required|array|min:1",
        //     'description.*.product.id' => 'required',
        //     'description.*.product.sale_price' => 'required',
        //     'description.*.quantity' => 'required'
        // ]);

        // // dd($validator->fails());
        // if ($validator->fails()) {
        //     return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        // }

        logger()->debug(Auth::id());
        $sale = new Sale();     // De este modo instanciamos una clase...
        $sale->user_id = Auth::id();    // De este modo podemos guardar en el sale la propiedad que indica qué usuario loggeado realizo la venta...
        $sale->total = 0;
        $sale->save();

        foreach($request->description as $requestDescription){
            $product = Product::find($requestDescription["product"]["id"]);

            $saleDescription = new SaleDescription();
            $saleDescription->sale_id = $sale->id;
            $saleDescription->product_id = $requestDescription["product"]["id"];
            $saleDescription->price = $requestDescription["product"]["sale_price"];
            $saleDescription->subtotal = $product->sale_price * $requestDescription["quantity"];
            $saleDescription->quantity = $requestDescription["quantity"];
            $saleDescription->save();

            $sale->total += $saleDescription->subtotal;
        }
        
        $sale->save();

        return response()->json($sale);
    }

    public function linkCostumer($id)
    {
        $sale = Sale::find($id);
        return view('sales.linkCostumer', compact('sale', 'id'));
    }

    public function linkCostToSale(Request $request, $id)
    {
        $sale = Sale::find($id);
        
        $sale->costumer_id = $request->costumer_id;
        $sale->save();

        return response()->json($sale);
    }
}
