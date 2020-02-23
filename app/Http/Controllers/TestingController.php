<?php

namespace App\Http\Controllers;
use App\User;
use App\Receipe;
use App\Testing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class TestingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
    $resep = Testing::all();
    $data = DB::table('general_cooking')
        ->join('equipment_tbl', 'general_cooking.id_equipment', '=', 'equipment_tbl.id_equipment')
        ->join('how_cook_tbl', 'general_cooking.id_how_cook', '=', 'how_cook_tbl.id_how_cook')
        ->select('equipment_tbl.information', 'how_cook_tbl.description')
        ->get();

        if($data){
            return response()->json([
                'success' =>true,
                'message' =>'Receipe Found',
                'data' => ([ $resep


                ])
            ],201);
        }
        else{
            return response()->json([
                'success' =>false,
                'message' =>'Receipe Not Found',
                'data' => ''
            ],404);

        }
    }
    public function show($id)
    {
        $receipe = Receipe::find($id);

        if($receipe){
            return response()->json([
                'success' =>true,
                'message' =>'Receipe Found',
                'data' => $receipe
            ],201);
        }
        else{
            return response()->json([
                'success' =>false,
                'message' =>'Receipe Not Found',
                'data' => ''
            ],404);

        }

    }

    public function store(Request $request)
    {
      $receipe = new Receipe();
      $receipe->title = $request->input('title');
      $receipe->ingredients = $request->input('ingredients');
      $receipe->seasoning = $request->input('seasoning');
      $receipe->how_cook = $request->input('how_cook');
      $receipe->equipment = $request->input('equipment');
      $receipe->keyword = $request->input('keyword');
      $receipe->save();

      if($receipe){
          return response()->json([
              'success' =>true,
              'message' =>'data have been saved',
              'data' => $receipe
          ],201);
      }
      else{
          return response()->json([
              'success' =>false,
              'message' =>'data invalid',
              'data' => ''
          ],404);

      }
    }

    public function update(Request $request, $id)
    {
      $receipe = Receipe::where('id',$id)->first();
      $receipe->title = $request->input('title');
      $receipe->ingredients = $request->input('ingredients');
      $receipe->seasoning = $request->input('seasoning');
      $receipe->how_cook = $request->input('how_cook');
      $receipe->equipment = $request->input('equipment');
      $receipe->keyword = $request->input('keyword');
      $receipe->save();
      if($receipe){
          return response()->json([
              'success' =>true,
              'message' =>'data have been changed',
              'data' => $receipe
          ],201);
      }
      else{
          return response()->json([
              'success' =>false,
              'message' =>'data invalid',
              'data' => ''
          ],404);

      }
    }

    public function destroy($id){
        $receipe = Receipe::where('id',$id)->first();
        $receipe->delete();

        return response()->json([
            'success' =>true,
            'message' =>'data have been Deleted',
            'data' => $receipe
        ],201);
    }

    //
}
