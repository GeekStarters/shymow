<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Post;
use App\Images_post;
use App\Category_post;
use App\Trend;
use Auth;
use Illuminate\Http\Request;

class InsideController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function amigos()
	{
		$id = Auth::user()->id;
		$friends = DB::select('SELECT * FROM perfils INNER JOIN friends on friends.user2 = perfils.id where user1 = '.$id.' AND friend = true UNION SELECT * FROM perfils INNER JOIN friends on friends.user1 = perfils.id where user2 = '.$id.' AND friend = true');
		
		return view('logueado.amigos')->withFriends($friends);
	}

	public function perfil(){
		$category = Category_post::lists('name','id');
		$id = Auth::user()->id;

		$posts = DB::select('SELECT * FROM posts LEFT JOIN images_posts on images_posts.post_id = posts.id WHERE posts.profil_id = "'.$id.'" ORDER BY posts.id DESC LIMIT 3 ');

		return view('logueado.perfil',compact('category','posts'));
	}

	public function tendencias(){
		$trends = DB::select('SELECT post_trends.trend_id, posts.id, images_posts.post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile FROM posts INNER JOIN post_trends on posts.id = post_trends.post_id LEFT JOIN images_posts on images_posts.post_id = posts.id INNER JOIN perfils ON posts.profil_id = perfils.id GROUP BY post_trends.post_id ORDER BY posts.id DESC LIMIT 10');

		$topTrends = DB::select('SELECT `post_trends`.`trend_id`, count(`post_trends`.`trend_id`) AS `TOTAL`,`trends`.`name` FROM `post_trends` LEFT JOIN `trends` ON `trends`.`id` = `post_trends`.`trend_id` GROUP BY `trend_id` ORDER BY `TOTAL` DESC LIMIT 0 , 10 ');

		return view('logueado.tendencias',compact('trends','topTrends'));
	}

	public function tendencia($name){
		$id = Trend::whereRaw('name = "'.$name.'" and active = "1"')->get();
		$id = $id[0]['attributes']['id'];
		$trends = DB::select('SELECT post_trends.trend_id, posts.id, images_posts.post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile FROM posts INNER JOIN post_trends on post_trends.trend_id = "'.$id.'" INNER JOIN perfils ON posts.profil_id = perfils.id LEFT JOIN images_posts on images_posts.post_id = posts.id WHERE posts.id = post_trends.post_id GROUP BY post_trends.post_id ORDER BY posts.id DESC LIMIT 10');

		$images = [];
		foreach ($trends as $trend) {
			if (count($images) == 9) {
				break;
			}
			array_push($images, $trend->path);
		}
		return view('logueado.tendencia', compact('trends','images'));
	}

}
