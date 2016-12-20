<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Countrie;
use App\State;
use App\Citie;
use App\Perfil;
use App\Post;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use DB;

class NavigationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function nosotros(){
		return view('nosotros');
	}
	public function politicasCookie(){
		return view('cookies');
	}
	public function contratacionPremium(){
		return view('contratacion_premium');
	}
	public function politicasPrivacidad(){
		return view('privacidad');
	}
	public function condiciones(){
		return view('condiciones');
	}
	public function faq(){
		return view('faq');
	}
	public function contacto(){
		return view('contacto');
	}
	public function viewUser($name = null){
		if ($name != null) {
			$users = Perfil::where('id',$name)
								->where('active',true)->first();
			if (count($users) > 0 && count($users) < 2) {

				$id = $users->id;

				if (Auth::check()) {
					$posts = DB::select('SELECT posts.posts, posts.id as id_post, images_posts.post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile , like_posts.post_id, like_posts.profil_id as userLike, like_posts.like as likeLike, like_posts.active as likeActive,posts.profil_id as id_user, follow_posts.active as follow,share_posts.description_old_post,share_posts.post_id as old_post_id, share_posts.profil_id as creator_perfil,share_posts.active as share_active,perfils_share.img_profile as imagen_perfil_creator,perfils_share.name, perfils_share.id as user_id_creator, image_post_share.post_id as image_share_post_id,image_post_share.path AS path_share, image_post_share.active as img_share_active FROM posts LEFT JOIN images_posts on images_posts.post_id = posts.id INNER JOIN perfils ON posts.profil_id = perfils.id LEFT JOIN like_posts ON posts.id = like_posts.post_id and like_posts.profil_id = '.Auth::user()->id.' and (like_posts.active = true and like_posts.like = true) LEFT JOIN share_posts ON share_posts.new_post_id = posts.id LEFT JOIN follow_posts ON follow_posts.post_id = posts.id AND follow_posts.perfil_id = '.Auth::user()->id.' and (follow_posts.active = true) LEFT JOIN perfils AS perfils_share ON perfils_share.id = share_posts.profil_id LEFT JOIN images_posts AS image_post_share on image_post_share.post_id = share_posts.post_id  WHERE posts.active = true AND posts.profil_id = '.$id.' GROUP BY posts.id ORDER BY posts.id DESC LIMIT 10');

				}else{
					$posts = DB::select('SELECT posts.posts, posts.id as id_post, images_posts.post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile ,posts.profil_id as id_user,share_posts.description_old_post,share_posts.post_id as old_post_id, share_posts.profil_id as creator_perfil,share_posts.active as share_active,perfils_share.img_profile as imagen_perfil_creator,perfils_share.name, perfils_share.id as user_id_creator, image_post_share.post_id as image_share_post_id,image_post_share.path AS path_share, image_post_share.active as img_share_active FROM posts LEFT JOIN images_posts on images_posts.post_id = posts.id INNER JOIN perfils ON posts.profil_id = perfils.id LEFT JOIN share_posts ON share_posts.new_post_id = posts.id LEFT JOIN perfils AS perfils_share ON perfils_share.id = share_posts.profil_id LEFT JOIN images_posts AS image_post_share on image_post_share.post_id = share_posts.post_id  WHERE posts.active = true AND posts.profil_id = '.$id.' GROUP BY posts.id ORDER BY posts.id DESC LIMIT 10');
				}

			// dd($posts);
			$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];
			$streamNet = ['twitch','bambuser','livestream'];
			return view('logueado.ver_perfil',compact('users','posts','socialNet','streamNet'));
			}else{

			}
		}else{
			return view('logueado.agregar');
		}
	}
	// Funciones con Query Scope laravel return data ajax
	public function state($id){
		$state = State::stateOfCountry($id)->get();
		if (count($state) > 0) {
			foreach ($state as $data) {
				echo '<option value="'.$data->id.'">'.$data->name.'</option>';
			}
		}else{
			$state = State::select('name','id')->where('name', 'like', '%No se encontro%')->get();
			foreach ($state as $data) {
				echo '<option value="'.$data->id.'">'.$data->name.'</option>';
			}
		}
	}
	public function city($id){
		$city = Citie::cityOfState($id)->get();
		if (count($city) > 0) {
			foreach ($city as $data) {
				echo '<option value="'.$data->id.'">'.$data->name.'</option>';
			}
		}else{
			$city = Citie::select('name','id')->where('name', 'like', '%No se encontro%')->get();
			foreach ($city as $data) {
				echo '<option value="'.$data->id.'">'.$data->name.'</option>';
			}
		}
	}

}
