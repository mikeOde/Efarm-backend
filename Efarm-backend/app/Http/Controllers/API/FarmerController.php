<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Farm;
use App\Models\Vegetable;
use App\Models\Tree;
use App\Models\Box;
use App\Models\BoxItem;
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
				['owner_id' => $owner_id]
			));
		}
		//if the farmer later on decides to edit their profile, the farms table will be updated
		$update_farm = Farm::where('owner_id', $owner_id)->update(array_merge(
			$validator->validated(),
			['owner_id' => $owner_id]
		));

		return response()->json([
			'status' => true,
			'message' => 'Profile was successfully updated',
		], 201);
    }

	function addVegetables(Request $request) {
		$user = Auth::user();
		$owner_id = $user->id;

		$validator = Validator::make($request->all(), [
			'name' => 'required|string|between:2,100',
			'description' => 'string',
			'quantity' => 'required|integer',
			'price' => 'required|integer'
		]);

		if ($validator->fails()) {
			return response()->json(array(
				"status" => false,
				"errors" => $validator->errors()
			), 400);
		}

		$add_vegetable = Vegetable::create(array_merge(
			$validator->validated(),
			['owner_id' => $owner_id]
		));

		return response()->json([
			'status' => true,
			'message' => 'Vegetable was successfully added',
		], 201);
	}

	function deleteVegetable(Request $request) {
		$user = Auth::user();
		$owner_id = $user->id;
		$vegetable_id = $request->id;
		$delete_vegetable = Vegetable::where('id', $vegetable_id)->where('owner_id', $owner_id)->delete();

		return response()->json([
			'status' => true,
			'message' => 'Vegetable was successfully deleted',
		], 201);
	}

	function addTrees(Request $request) {
		$user = Auth::user();
		$owner_id = $user->id;

		$validator = Validator::make($request->all(), [
			'name' => 'required|string|between:2,100',
			'description' => 'string',
			'quantity' => 'required|integer',
			'price' => 'required|integer',
			'image' => 'string'
		]);

		if ($validator->fails()) {
			return response()->json(array(
				"status" => false,
				"errors" => $validator->errors()
			), 400);
		}

		$add_tree = Tree::create(array_merge(
			$validator->validated(),
			['owner_id' => $owner_id]
		));

		return response()->json([
			'status' => true,
			'message' => 'Tree was successfully added',
		], 201);
	}

	function deleteTree(Request $request) {
		$user = Auth::user();
		$owner_id = $user->id;
		$tree_id = $request->id;
		$delete_tree = Tree::where('id', $tree_id)->where('owner_id', $owner_id)->delete();

		return response()->json([
			'status' => true,
			'message' => 'Tree was successfully deleted',
		], 201);
	}

	function getVegetables() {
		$user = Auth::user();
		$owner_id = $user->id;
		$vegetables = Vegetable::where('owner_id', $owner_id)->get()->toArray();
		return json_encode($vegetables);
	}

	function getTrees() {
		$user = Auth::user();
		$owner_id = $user->id;
		$trees = Tree::where('owner_id', $owner_id)->get()->toArray();
		return json_encode($trees);
	}

	function createBox(Request $request) {
		$user = Auth::user();
		$owner_id = $user->id;

		$validator = Validator::make($request->all(), [
			'name' => 'required|string|between:2,100',
			'description' => 'string',
			'quantity' => 'required|integer',
			'price' => 'required|integer',
		]);

		if ($validator->fails()) {
			return response()->json(array(
				"status" => false,
				"errors" => $validator->errors()
			), 400);
		}

		$create_box = Box::create(array_merge(
			$validator->validated(),['owner_id' => $owner_id,]));

		return response()->json([
			'status' => true,
			'message' => 'Box was successfully added',
		], 201);
	}

	function addItems(Request $request) {
		$box_id = $request->box_id;
		$vegetable_id = $request->vegetable_id;
		$validator = Validator::make($request->all(), [
			'weight' => 'required|integer'
		]);

		if ($validator->fails()) {
			return response()->json(array(
				"status" => false,
				"errors" => $validator->errors()
			), 400);
		}

		$add_item = BoxItem::create(array_merge(
			$validator->validated(), [
			'box_id' => $box_id,
			'vegetable_id' => $vegetable_id
			]
		));

		return response()->json([
			'status' => true,
			'message' => 'Item was successfully added',
		], 201);
	}
}