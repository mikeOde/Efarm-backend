<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Farm;
use JWTAuth;
use Auth;


class FarmerController extends Controller
{
	// Needs to be rechecked once the frontend is to be implemented
	function editProfile(Request $request) {
        $user = Auth::user();
		$owner_id = $user->id;
		$owner_first_name = $user->first_name;
		$owner_last_name = $user->last_name;
		
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|between:2,100',
			'description' => 'string',
		]);

		if ($validator->fails()) {
			return response()->json(array(
				"status" => false,
				"errors" => $validator->errors()
			), 400);
		}
		//if it's the first time a farmer updates his profile, we need to create a row in the farms table
		$farm = Farm::where("owner_id", $owner_id)->get()->toArray();
		if (count($farm) == 0) {
			$create_farm = Farm::create(array_merge(
				$validator->validated(),
				['owner_id' => $owner_id,
				'owner_first_name' => $owner_first_name,
				'owner_last_name' => $owner_last_name]
			));
		}
		//if the farmer later on decides to edit their profile, the farms table will be updated
		$update_farm = Farm::where('owner_id', $owner_id)->update(array_merge(
			$validator->validated(),
			['owner_id' => $owner_id,
			'owner_first_name' => $owner_first_name,
			'owner_last_name' => $owner_last_name]
		));

		return response()->json([
			'status' => true,
			'message' => 'Profile was successfully updated',
		], 201);
    }
}