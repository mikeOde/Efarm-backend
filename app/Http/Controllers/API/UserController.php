<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
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
use App\Models\Farm;

class UserController extends Controller {

	function userGetFarms() {
		$farms = DB::table('farms')
			->join('users', 'farms.owner_id', '=', 'users.id')
			->get()
			->toArray();
		return json_encode($farms);
	}

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
}