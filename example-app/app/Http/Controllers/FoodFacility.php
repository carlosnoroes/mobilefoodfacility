<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FoodFacility extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getData ( Request $request)
    {
        $post_data = $request->input();

        $start       = $request->input('start');
        $pageRows    = $request->input('length');
        $search_term = $request->input('search')['value'];

        $order   = $request->input('order');
        $columns = $request->input('columns');

        $column = $columns[$order[0]['column']]['name'];
        $sort   = $order[0]['dir'];



        if($search_term)
        {
            $result= DB::table('challenge.permit')
                        ->select('*')
                        ->where( function ( $query ) use ( $search_term) {

                            $query->orWhere('locationid', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Applicant', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('FacilityType', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('cnn', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('LocationDescription', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Address', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('blocklot', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('block', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('lot', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('permit', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Status', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('FoodItems', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('X', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Y', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Latitude', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Longitude', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Schedule', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('dayshours', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('NOISent', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Approved', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Received', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('PriorPermit', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('ExpirationDate', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Location', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Fire Prevention Districts', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Police Districts', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Supervisor Districts', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Zip Codes', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Neighborhoods (old)', 'LIKE', '%'.$search_term.'%');

                        })
                        ->offset($start)
                        ->limit($pageRows)
                        ->orderBy($column, $sort)
                        ->get();


            $totalRows = DB::table('challenge.permit')
                        ->select(DB::raw('COUNT(*) AS TOTAL'))
                        ->where( function ( $query ) use ( $search_term) {

                            $query->orWhere('locationid', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Applicant', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('FacilityType', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('cnn', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('LocationDescription', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Address', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('blocklot', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('block', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('lot', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('permit', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Status', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('FoodItems', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('X', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Y', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Latitude', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Longitude', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Schedule', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('dayshours', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('NOISent', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Approved', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Received', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('PriorPermit', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('ExpirationDate', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Location', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Fire Prevention Districts', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Police Districts', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Supervisor Districts', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Zip Codes', 'LIKE', '%'.$search_term.'%')
                                    ->orWhere('Neighborhoods (old)', 'LIKE', '%'.$search_term.'%');

                        })
                        ->offset($start)
                        ->limit($pageRows)
                        ->orderBy($column, $sort)
                        ->get();
        }
        else
        {
            $result    = DB::select('SELECT * FROM permit');
            $totalRows = DB::select('SELECT COUNT(*) AS TOTAL FROM permit');
        }

        return response()->json( [  'recordsTotal'    => $pageRows,
                                    'recordsFiltered' => $totalRows[0]->TOTAL,
                                    'data'            => $result,                                   
                                 ] );
    }
}