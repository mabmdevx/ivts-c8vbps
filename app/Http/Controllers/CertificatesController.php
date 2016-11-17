<?php

namespace App\Http\Controllers;

use App\Models\CertificateModel;
use App\Http\Controllers\Controller;
use App\Http\Utils\CommonUtils;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class CertificatesController extends Controller
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
			$query = $query->where('certificate_name','like', $match)
						   ->orWhere('certificate_email','like', $match);
		}
		
		$query = CertificateModel::select($selectFields);
		
		if ($perPage != "all") {
            $result = $query->paginate($perPage);
        } else {
            $result = $query->get();
        }
		
		return $result;
    }
	
	public function show($certificateId) {

		// Get object from database
        $query = CertificateModel::where('certificate_id', '=', $certificateId);

        $result = $query->firstOrFail();

        return $result;
    }
	
	public function store(Request $request) {

        $dateTimeNow = Carbon::now();
		
		$certificate = new CertificateModel();
        $certificate->certificate_customer_id = $request->input('certificate_customer_id');
		$certificate->certificate_key = $request->input('certificate_key');
		$certificate->certificate_body = $request->input('certificate_body');
		$certificate->certificate_status = 1;
        $certificate->created_at = $dateTimeNow;
		$certificate->updated_at = $dateTimeNow;

		// Save
		try {
			DB::transaction(function() use ($request, $certificate){
				$certificate->save();
			});
		}
		catch (Exception $e) {
			$errorMessage = "Error saving: " . $e->getMessage();
			return response($errorMessage, 400);
		}

        $certificate = $this->show($certificate->certificate_id);
        return $certificate;
    }

    public function update(Request $request, $certificateId) {

        $dateTimeNow = Carbon::now();

		// Get object from database
        $certificate = CertificateModel::where('certificate_id', '=', $certificateId)->first();

        if($certificate != null)
        {

            $certificate->certificate_customer_id = $request->input('certificate_customer_id');
			$certificate->certificate_key = $request->input('certificate_key');
			$certificate->certificate_body = $request->input('certificate_body');
			$certificate->certificate_status = $request->input('certificate_status');
			$certificate->updated_at = $dateTimeNow;

            // Save
            try {
                DB::transaction(function() use ($request, $certificate){
                    $certificate->save();
                });
            }
            catch (Exception $e) {
                $errorMessage = "Error saving: " . $e->getMessage();
                return response($errorMessage, 400);
            }

        }

        $certificate = $this->show($certificate->certificate_id);
        return $certificate;
    }
	
	
	public function destroy(Request $request, $certificateId) {

        $dateTimeNow = Carbon::now();

        // Get object from database
        $certificate = CertificateModel::where('certificate_id', '=', $certificateId)->first();

        // Save
        try {
            DB::transaction(function() use ($request, $certificate){
                $certificate->delete();
            });
        }
        catch (Exception $e) {
            $errorMessage = "Error saving: " . $e->getMessage();
            return response($errorMessage, 400);
        }

        $responseArr = array();
        $responseArr['message'] = 'CertificateId-'.$certificateId.' has been removed.';

        return response(json_encode($responseArr), 200); // 200 = OK response code
    }
	
	
	public function getCertificatesByCustomer(Request $request, $customerId)
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
		
		// Get object from database
		$query = CertificateModel::select($selectFields)->where('certificate_customer_id', '=', $customerId);
		
		if ($perPage != "all") {
            $result = $query->paginate($perPage);
        } else {
            $result = $query->get();
        }
		
		return $result;
    }
	
	
	public function getActiveCertificatesByCustomer(Request $request, $customerId)
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

		// Get object from database
		$query = CertificateModel::select($selectFields)
					->where('certificate_customer_id', '=', $customerId)
					->where('certificate_status', '=', '1');
		
		if ($perPage != "all") {
            $result = $query->paginate($perPage);
        } else {
            $result = $query->get();
        }
		
		return $result;
    }
	
	
	public function activateCertificate(Request $request, $certificateId) {

        $dateTimeNow = Carbon::now();

		// Get object from database
        $certificate = CertificateModel::where('certificate_id', '=', $certificateId)->first();

        if($certificate != null)
        {
		
			$certificate->certificate_status = 1;
			$certificate->updated_at = $dateTimeNow;

            // Save
            try {
                DB::transaction(function() use ($request, $certificate){
                    $certificate->save();
					
					//CURL POST
					$url = "http://localhost:81/";
					$body = "test";
					$response = CommonUtils::do_curl_post($url, $body);
					//return response($response, 200);
					
                });
            }
            catch (Exception $e) {
                $errorMessage = "Error saving: " . $e->getMessage();
                return response($errorMessage, 400);
            }

        }

        $certificate = $this->show($certificate->certificate_id);
        return $certificate;
    }
	
	
	public function deactivateCertificate(Request $request, $certificateId) {

        $dateTimeNow = Carbon::now();

		// Get object from database
        $certificate = CertificateModel::where('certificate_id', '=', $certificateId)->first();

        if($certificate != null)
        {
		
			$certificate->certificate_status = 0;
			$certificate->updated_at = $dateTimeNow;

            // Save
            try {
                DB::transaction(function() use ($request, $certificate){
                    $certificate->save();
					
					//CURL POST
					$url = "http://localhost:81/";
					$body = "test";
					$response = CommonUtils::do_curl_post($url, $body);
					//return response($response, 200);
					
                });
            }
            catch (Exception $e) {
                $errorMessage = "Error saving: " . $e->getMessage();
                return response($errorMessage, 400);
            }

        }

        $certificate = $this->show($certificate->certificate_id);
        return $certificate;
    }
	
	
}