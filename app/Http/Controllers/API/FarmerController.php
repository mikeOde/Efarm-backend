<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;
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
	function getProfile() {
		$user = Auth::user();
		$owner_id = $user->id;
		$owner_name = $user->first_name . ' ' . $user->last_name;

		$farm_profile = Farm::where('owner_id', $owner_id)->get()->toArray();
		$farm_profile_data = array_merge(
			$farm_profile,
			['owner_name' => $owner_name]
		);
		return json_encode($farm_profile_data);
	} 

	function editProfile(Request $request) {
        $user = Auth::user();
		$owner_id = $user->id;
		$owner_first_name = $user->first_name;
		$owner_last_name = $user->last_name;
		
		$validator = Validator::make($request->all(), [
			'farm_name' => 'required|string|between:2,100',
			'description' => 'string',
			'location' => 'required|string|between:2,100',
			'image' => 'required|string',
			'lat' => 'string',
			'lng' => 'string'
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
			'price' => 'required|integer',
			'image' => 'string'
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

	function editVegetable(Request $request) {
		$vegetable_id = $request->id;
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
		$edit_vegetable = Vegetable::where('id', $vegetable_id)->update($validator->validated());

		return response()->json([
			'status' => true,
			'message' => 'Vegetable was successfully edited',
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

	function editTree(Request $request) {
		$tree_id = $request->id;
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
		$edit_tree = Tree::where('id', $tree_id)->update($validator->validated());

		return response()->json([
			'status' => true,
			'message' => 'Vegetable was successfully edited',
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

	function getCustomers() {
		$user = Auth::user();
		$owner_id = $user->id;

		$trees_ids = DB::table('trees')
			->where('owner_id','=', $owner_id)
			->pluck('id')
			->all();

		$trees_customers = DB::table('trees_adoptions')
			->whereIn('tree_id', $trees_ids)
			->pluck('user_id')
			->all();
		
		$vegetables_ids = DB::table('vegetables')
		->where('owner_id','=', $owner_id)
		->pluck('id')
		->all();

		$vegetables_customers = DB::table('vegetables_orders')
			->whereIn('vegetable_id', $vegetables_ids)
			->pluck('user_id')
			->all();
		
		$customers_ids = array_unique(array_merge($trees_customers,$vegetables_customers));

		$customers_data = DB::table('users')
			->whereIn('id', $customers_ids)
			->get()
			->toArray();

		return json_encode($customers_data);
	}

	function treesChartData() {
		$user = Auth::user();
		$owner_id = $user->id;

		$trees_ids = DB::table('trees')
			->where('owner_id','=', $owner_id)
			->pluck('id')
			->all();

		$trees_adoptions = DB::table('trees_adoptions')
			->join('trees', 'trees.id', '=', 'trees_adoptions.tree_id')
			->select('trees.name', DB::raw('count(*) as total'))
			->whereIn('tree_id', $trees_ids)
			->groupBy('trees.name')
			->get();
		return json_encode($trees_adoptions);
	}

	function vegetablesChartData() {
		$user = Auth::user();
		$owner_id = $user->id;

		$vegetables_ids = DB::table('vegetables')
			->where('owner_id','=', $owner_id)
			->pluck('id')
			->all();

		$vegetables_orders = DB::table('vegetables_orders')
			->join('vegetables', 'vegetables.id', '=', 'vegetables_orders.vegetable_id')
			->select('vegetables.name', DB::raw('count(*) as total'))
			->whereIn('vegetable_id', $vegetables_ids)
			->groupBy('vegetables.name')
			->get();
		return json_encode($vegetables_orders);
	}

	function totalAdoptionsData() {
		$user = Auth::user();
		$owner_id = $user->id;

		$trees_ids = DB::table('trees')
			->where('owner_id','=', $owner_id)
			->pluck('id')
			->all();

		$trees_adoptions = DB::table('trees_adoptions')
			->join('trees', 'trees.id', '=', 'trees_adoptions.tree_id')
			->select('trees.price')
			->whereIn('tree_id', $trees_ids)
			->get();
		return json_encode($trees_adoptions);
	}

	function totalOrdersData() {
		$user = Auth::user();
		$owner_id = $user->id;

		$vegetables_ids = DB::table('vegetables')
			->where('owner_id','=', $owner_id)
			->pluck('id')
			->all();

		$vegetables_orders = DB::table('vegetables_orders')
			->join('vegetables', 'vegetables.id', '=', 'vegetables_orders.vegetable_id')
			->select('vegetables.price')
			->whereIn('vegetable_id', $vegetables_ids)
			->get();
		return json_encode($vegetables_orders);
	}
}