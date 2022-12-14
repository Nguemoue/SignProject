<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class ListBlogComment extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $blog = null;

    function __construct($blog)
    {
        $this->blog = $blog;
    }

    public $message = "";

    public $nbComment = 0;
    
    function mount(){
        $this->nbComment = $this->blog->comments->count();
    }

    
    public function render()
    {
        return view('livewire.list-blog-comment',[
            'comments'=>Comment::where("post_id",$this->blog->id)->get()
        ]);
    }

}
