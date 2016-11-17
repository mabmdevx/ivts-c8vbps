<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class CustomersController extends Controller
{
    
    public function index(Request $request)
    {
	
		//Fields parameter
		$fieldsParam = $request->input('fields');
		$selectFields = "*";
		if(strlen($fieldsParam) > 0){
			$selectFields = explode(",", $fieldsParam);
		}
		
		// Results per page parameter
        $perPageParam = $request->input('perpage');
        $perPage = "10";
        if (strlen($perPageParam) > 0) {
            $perPage = $perPageParam;
        }
		
		//Search parameter
		$searchParam = $request->input('search');
		if(strlen($searchParam) > 0){
			$match = "%$searchParam%";
			$query = $query->where('customer_name','like', $match)
						   ->orWhere('customer_email','like', $match);
		}
		
		$query = CustomerModel::select($selectFields);
		
		if ($perPage != "all") {
            $result = $query->paginate($perPage);
        } else {
            $result = $query->get();
        }
		
		return $result;
    }
	
	public function show($customerId) {

		// Get object from database
        $query = CustomerModel::where('customer_id', '=', $customerId);

        $result = $query->firstOrFail();

        return $result;
    }
	
	public function store(Request $request) {

        $dateTimeNow = Carbon::now();
		
		$customer = new CustomerModel();
        $customer->customer_name = $request->input('customer_name');
		$customer->customer_email = $request->input('customer_email');
        $customer->created_at = $dateTimeNow;
		$customer->updated_at = $dateTimeNow;

		// Save
		try {
			DB::transaction(function() use ($request, $customer){
				$customer->save();
			});
		}
		catch (Exception $e) {
			$errorMessage = "Error saving: " . $e->getMessage();
			return response($errorMessage, 400);
		}

        $customer = $this->show($customer->customer_id);
        return $customer;
    }

    public function update(Request $request, $customerId) {

        $dateTimeNow = Carbon::now();

		// Get object from database
        $customer = CustomerModel::where('customer_id', '=', $customerId)->first();

        if($customer != null)
        {

            $customer->customer_name = $request->input('customer_name');
			$customer->customer_email = $request->input('customer_email');
			$customer->updated_at = $dateTimeNow;

            // Save
            try {
                DB::transaction(function() use ($request, $customer){
                    $customer->save();
                });
            }
            catch (Exception $e) {
                $errorMessage = "Error saving: " . $e->getMessage();
                return response($errorMessage, 400);
            }

        }

        $customer = $this->show($customer->customer_id);
        return $customer;
    }
	
	
	public function destroy(Request $request, $customerId) {

        $dateTimeNow = Carbon::now();

        // Get object from database
        $customer = CustomerModel::where('customer_id', '=', $customerId)->first();

        // Save
        try {
            DB::transaction(function() use ($request, $customer){
                $customer->delete();
            });
        }
        catch (Exception $e) {
            $errorMessage = "Error saving: " . $e->getMessage();
            return response($errorMessage, 400);
        }

        $responseArr = array();
        $responseArr['message'] = 'CustomerId-'.$customerId.' has been removed.';

        return response(json_encode($responseArr), 200); // 200 = OK response code
    }
}