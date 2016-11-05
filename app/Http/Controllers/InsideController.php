<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Post;
use App\Images_post;
use App\Category_post;
use App\Trend;
use App\Like_post;
use App\Perfil;
use Auth;
use Illuminate\Http\Request;
use Validator;

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

		$posts = DB::select('
			SELECT posts.posts, posts.id as id_post, images_posts.post_id as image_post_id,images_posts.path, images_posts.active as image_active, posts.description, posts.qualification, posts.like, posts.share, posts.active as post_active, posts.profil_id, like_posts.post_id, like_posts.profil_id, like_posts.like as likeLike, like_posts.active as likeActive, posts.profil_id as id_user,share_posts.description_old_post,share_posts.post_id as old_post_id, share_posts.profil_id as creator_perfil, perfils.name, perfils.id as user_id_creator, perfils.img_profile as imagen_perfil_creator,share_posts.active as share_active, follow_posts.active as follow FROM posts LEFT JOIN images_posts on images_posts.post_id = posts.id LEFT JOIN like_posts ON posts.id = like_posts.post_id and like_posts.profil_id = '.$id.' and (like_posts.active = true and like_posts.like = true) LEFT JOIN share_posts ON share_posts.new_post_id = posts.id LEFT JOIN perfils ON share_posts.profil_id = perfils.id LEFT JOIN follow_posts ON follow_posts.post_id = posts.id WHERE posts.profil_id = '.$id.' and posts.active = true ORDER BY posts.id DESC LIMIT 3 ');

		$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];

		$streamNet = ['twitch','bambuser','livestream'];

		$streams = "";
		if (isset(Auth::user()->streamings)) {
			$streams = json_decode(Auth::user()->streamings,true);
		}

		$socials = "";
		if (isset(Auth::user()->redes)) {
			$socials = json_decode(Auth::user()->redes,true);
		}
		return view('logueado.perfil',compact('category','posts','socialNet','streamNet','streams','socials'));
	}

	public function tendencias(){
		$trends = DB::select('SELECT post_trends.trend_id,posts.posts, posts.id as id_post, images_posts.post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile , like_posts.post_id, like_posts.profil_id, like_posts.like as likeLike, like_posts.active as likeActive FROM posts INNER JOIN post_trends on posts.id = post_trends.post_id LEFT JOIN images_posts on images_posts.post_id = posts.id INNER JOIN perfils ON posts.profil_id = perfils.id LEFT JOIN like_posts ON posts.id = like_posts.post_id and like_posts.profil_id = '.Auth::user()->id.' and (like_posts.active = true and like_posts.like = true) WHERE posts.active = true GROUP BY post_trends.post_id ORDER BY posts.id DESC LIMIT 10');

		$topTrends = DB::select('SELECT `post_trends`.`trend_id`, count(`post_trends`.`trend_id`) AS `TOTAL`,`trends`.`name` FROM `post_trends` LEFT JOIN `trends` ON `trends`.`id` = `post_trends`.`trend_id` GROUP BY `trend_id` ORDER BY `TOTAL` DESC LIMIT 0 , 10 ');
		// dd($trends);
		return view('logueado.tendencias',compact('trends','topTrends'));
	}

	public function tendencia($name){
		$id = Trend::whereRaw('name = "'.$name.'" and active = "1"')->get();
		if (count($id) > 0) {
			
			$id = $id[0]['attributes']['id'];
			$trends = DB::select('SELECT post_trends.trend_id, posts.id as id_post,posts.posts, images_posts.post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile, like_posts.post_id, like_posts.profil_id, like_posts.like as likeLike, like_posts.active as likeActive FROM posts INNER JOIN post_trends on post_trends.trend_id = "'.$id.'" INNER JOIN perfils ON posts.profil_id = perfils.id LEFT JOIN images_posts on images_posts.post_id = posts.id LEFT JOIN like_posts ON posts.id = like_posts.post_id and like_posts.profil_id = '.Auth::user()->id.' and (like_posts.active = true and like_posts.like = true) WHERE posts.active = true and posts.id = post_trends.post_id GROUP BY post_trends.post_id ORDER BY posts.id DESC LIMIT 10');

			$name_trends = Trend::find($id);
			$images = [];
			foreach ($trends as $trend) {
				if (count($images) == 9) {
					break;
				}
				if (!empty($trend->path)) {
					
					array_push($images,$trend->path );
				}
			}
			return view('logueado.tendencia', compact('trends','images','name_trends'));													
		}else{
			return redirect('tendencias');
		}
	}

	public function typeaSearch(Request $request)
	{
        $search = $request->input('searching');

        $users = DB::select('SELECT * FROM perfils WHERE active = true and name LIKE "%'.$search.'%"');
        $data = [];
        if (count($users) > 0) {
        	foreach ($users as $user) {
        		array_push($data,["name" => $user->name, "img" => $user->img_profile, "id" => $user->id]);
        	}
        	return response()->json(['error' => false, 'data' => $data]);
        }else{
        	return response()->json(['error' => true]);
        }

        
	}

}
