<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Perfil;
use App\Friend;
class FriendsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Al users
		$users = Perfil::select("*","perfils.id AS user_id")
				->leftJoin('friends',function($join){
			$join->on('friends.user1','=','perfils.id')->orOn('friends.user2','=','perfils.id');
		})->where('perfils.id','<>',Auth::id())
			->where('perfils.active',true)
			->groupBy('perfils.id')
			->orderBy('perfils.id','DESC')
			->paginate(20);
		return view('logueado.add_users',compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id = null)
	{
		if ($id != null) {
			$count = Perfil::where('id',$id)->where('active',true)->count();
			if ($count>0) {
				if ($id != Auth::id()) {
					$relation = Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->get();
					if (count($relation)>0) {
						if ($relation[0]->status == 1) {
							Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->update(['status'=>2]);
						}elseif($relation[0]->status == 2){
							Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->update(['status'=>0]);
						}elseif($relation[0]->status == 0){
							Friend::where('user1',$id)->where('user2',Auth::id())
										->orWhere('user1',Auth::id())->where('user2',$id)
										->update(['status'=>2]);
						}
					}else{
						$newF = new Friend();
							$newF->user1 = Auth::id();
							$newF->user2 = $id;
							$newF->status = 0;
						$newF->save();
					}
					return redirect('amigos');
				}else{
					return redirect('all_users');
				}
			}else{
				return redirect('all_users');
			}
		}else{
			return redirect('all_users');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
