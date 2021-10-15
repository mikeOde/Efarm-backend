<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use App\Models\User;
use App\Models\Vegetable;
use App\Models\Tree;
use App\Models\Box;
use App\Models\BoxItem;
use App\Models\TreeAdoption;
use App\Models\Order;

class UserController extends Controller {

    function userGetVegetables(Request $request) {
		$owner_id = $request->owner_id;
		$vegetables = Vegetable::where('owner_id', $owner_id)->get()->toArray();
		return json_encode($vegetables);
	}

    function userGetTrees(Request $request) {
		$owner_id = $request->owner_id;
		$vegetables = Tree::where('owner_id', $owner_id)->get()->toArray();
		return json_encode($vegetables);
	}

    function userGetBoxes(Request $request) {
        $owner_id = $request->owner_id;
        $boxes = Box::where('owner_id', $owner_id)->get()->toArray();
        return json_encode($boxes);
    }

    function userGetItems(Request $request) {
        $box_id = $request->box_id;
        $items = BoxItem::where('box_id', $box_id)->get()->toArray();
        return json_encode($items);
    }

    function userAdoptTrees(Request $request) {
        $user = Auth::user();
		$user_id = $user->id;
        $tree_id = $request->tree_id;

        $adopt_tree = TreeAdoption::create([
            'user_id' => $user_id,
            'tree_id' => $tree_id
        ]);

        return response()->json([
			'status' => true,
			'message' => 'Tree was successfully adopted',
		], 201);
    }

    function userOrderBoxes(Request $request) {
        $user = Auth::user();
		$user_id = $user->id;
        $box_id = $request->box_id;
        $address_id = $request->customer_address_id;
        $quantity = $request->quantity;
        $price = $request->price;

        $farm_data = Box::where('id', $box_id)->get()->toArray();
        $owner_id = $farm_data[0]['owner_id'];
        // return json_encode($owner_id);
        $order_box = Order::create([
            'user_id' => $user_id,
            'owner_id' => $owner_id,  
            'box_id' => $box_id,
            'customer_address_id' => $address_id,
            'quantity' => $quantity,
            'price' => $price
        ]);

        return response()->json([
			'status' => true,
			'message' => 'Box was successfully ordered',
		], 201);
    }

    function UserCreateBox(Request $request) {
		$user = Auth::user();
		$user_id = $user->id;

		$validator = Validator::make($request->all(), [
			'name' => 'required|string|between:2,100',
			'description' => 'string',
            'owner_id' => 'required|integer',
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
			$validator->validated(),['created_by_user_id' => $user_id]));

		return response()->json([
			'status' => true,
			'message' => 'Box was successfully added',
		], 201);
	}

    function userAddItems(Request $request) {
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