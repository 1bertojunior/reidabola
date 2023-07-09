<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public $citie;

    public function __construct(City $citie){
        $this->citie = $citie;
    }

    public function index()
    {
        $cities = $this->citie->with('state')->get();
        return $cities;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        
        $city = new City([
            'name' => isset($data['name']) ? $data['name'] : null,
            'abb' => isset($data['abb']) ? $data['abb'] : null,
            'state_id' => isset($data['state_id']) ? $data['state_id'] : null
        ]);        

        $rules = $city->rules();
        $request->validate($rules, $city->feedback());

        $city->save();

        return response()->json([
            'msg' => 'City created successfully',
            'city' => $city
        ], 201);
    }

    public function show($id)
    {
        $result = $this->citie->with('state')->find($id);
    
        if ($result === null) $result = response()->json(['error' => "Nenhum dado encontrado."], 404);
        else $result = response()->json($result, 200);
    
        return $result;
        
    }

    public function update(Request $request, $id)
    {
        $city = $this->citie->find($id);

        if ($city === null) {
            return response()->json(['error' => "Nenhum dado encontrado."], 404);
        } else {
            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($this->citie->rules($id) as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }
                unset($rules['user_id']);
                $this->validate($request, $rules, $this->citie->feedback());
            } else {
                $rules = $this->citie->rules($id);
                unset($rules['user_id']);
                $this->validate($request, $rules, $this->citie->feedback());
            }

            $city->update($request->except('user_id'));
        }

        return response()->json(
            $city,
            200
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->citie->find($id);
        $result = ($result === null) ? 0 : $result->delete();
        return $result ? ['msg' => "Removido com sucesso"] :  response()->json([ 'error' => "Nenhum dado encontrado"], 404); ;
    }
}
