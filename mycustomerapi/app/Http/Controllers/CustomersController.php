<?php

namespace App\Http\Controllers;

use App\Customers;
use App\Telephone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * View all Customer data
     */
    public function index()
    {
     
     $Customers = Customers::all();
     foreach($Customers AS &$customer){
        $customer['telephone'] = Telephone::where('customerid',$customer->id)->get();
     }
     return response()->json($Customers);

    }

    /**
     * Create new customer
     */
    public function create(Request $request)
    {
        $Customers = new Customers;

        $Customers->name= $request->name;
        $Customers->nic = $request->nic;
        $Customers->address= $request->address;
        $Customers->save();
        $customerId = $Customers->id;

        foreach($request->telephone AS $item){
            $Telephone = new Telephone;
            $Telephone->customerid =  $customerId;
            $Telephone->telephone= $item;
            $Telephone->save();
        }

        return response()->json(true);
    }

    /**
     * Show Customer by Id
     */
    public function show($id)
    {
        $Customers = DB::table('customers')
                        ->join('telephone', 'telephone.customerid', '=', 'customers.id')
                        ->where('customers.id', $id)
                        ->get();

        return response()->json($Customers);
    }

    /**
     * Search Customer by input key term
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('term');
        $Customers = DB::table('customers')
                        ->select('customers.id','customers.name','customers.nic','customers.address','telephone.telephone')
                        ->join('telephone', 'telephone.customerid', '=', 'customers.id')
                        ->where('customers.name','like', "%{$searchTerm}%")
                        ->orWhere('customers.nic','like', "%{$searchTerm}%")
                        ->orWhere('customers.address','like', "%{$searchTerm}%")
                        ->orWhere('telephone.telephone','like', "%{$searchTerm}%")
                        ->get();

        $responseArray = array();
        foreach($Customers AS $customer){
            array_push($responseArray, array(
                'id'=>$customer->id,
                'name'=>$customer->name,
                'nic'=>$customer->nic,
                'address'=>$customer->address,
                'telephone'=>Telephone::where('customerid',$customer->id)->get()
            ));            
        }

        return response()->json($responseArray);
    }

    /**
     * Update Customer data
     */
    public function update(Request $request, $id)
    { 
        $Customers= Customers::find($id);
        
        $Customers->name = $request->input('name');
        $Customers->nic = $request->input('nic');
        $Customers->address = $request->input('address');
        $Customers->save();
        return response()->json($Customers);
    }

    /**
     * Remove customer
     */
    public function destroy($id)
    {
        $Customers = Customers::find($id);
        $Customers->delete();

        
        $Telephone = Telephone::find(['customerid'=>$id]);
        $Telephone->delete();

        return response()->json('Customer removed successfully');
    }

}
