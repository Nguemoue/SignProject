<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Comment;
class PostCommentController extends Controller
{
   function comment(Request $request){
        $data = $request->only(['userId','message','postId']);
      // je comment en base de donnees
      $comment = Comment::query()->create([
          'user_id'=>$data['userId'],
          'contenu'=>$data['message'],
          'post_id'=>$data['postId']
      ]);

        $nbComment = Comment::query()->selectRaw("count(id) as nb")->where("post_id",$data['postId'])->pluck("nb")->first();
      $data['comment'] = Comment::query()->where("id",$comment->id)->with("user")->get()->toJson();
        $data['nbComment'] = $nbComment;
            return response()->json($data);
   }
}
