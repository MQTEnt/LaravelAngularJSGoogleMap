<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Place;
use Request;
class PlacesController extends Controller
{
	public function getList()
	{
		$places=Place::all();
		return $places;
	}
	public function index()
	{
		return view('googlemap.list');
	}
	public function create()
	{
		return view('googlemap.create');
	}
	public function store()
	{
		if(Request::ajax())
		{
			Place::create([
				'name'=>Request::get('name'),
				'lat'=>Request::get('lat'),
				'lon'=>Request::get('lon'),
				'description'=>Request::get('description'),
				'status'=>1,
				'votes'=>0,
				'user_id'=>1
			]);
			return 1;
		}
		return 0;
	}
	public function update($id)
	{
		$place=Place::findOrFail($id);
		//Kiểm tra tọa độ mới (nếu có) có trùng với điểm nào đã có trước đó không... (Update sau)
		$place->update([
			'name' => Request::get('name'),
			'lat' =>Request::get('lat'),
			'lon' =>Request::get('lon'),
			'description' => Request::get('description'),
			'votes' => Request::get('votes')
		]);
		return "Update Success";
	}
}
