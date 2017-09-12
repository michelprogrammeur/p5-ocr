<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticlesValidationRules;
use App\Picture;
use File;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('users.admins.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.admins.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesValidationRules $request)
    {
        $user = Auth::user();

        $article = Article::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'abstract' => $request->input('abstract'),
            'content' => $request->input('content'),
            'user_id' => $user->id
        ]);

        $files = $request->file('picture');
        //$this->uploads($files);
        $this->uploads($files, $article->id);

        return redirect('/articles');
    }

    private function uploads($files, $article_id)
    {
        if(!empty($files)) {
            foreach ($files as $im) {
                $filename_without_extention = preg_replace('/\.[^.]+$/','', $im->getClientOriginalName());
                //dd($filename_without_extention,  $im->getClientOriginalName());
                $ext = $im->getClientOriginalExtension();
                $uri = str_random(12) . '.' . $ext;

                Picture::create([
                    'title' => $filename_without_extention,
                    'url' => $uri,
                    'article_id' => $article_id,
                    'alt' => 'image ' . $filename_without_extention,
                    'type' => $ext
                ]);

                $im->move('./uploads', $uri);
            }
        }
    }

    private function updateUploads($files, $article)
    {
        if(!empty($files)) {
            if (!is_null($article->pictures)) {
                foreach ($article->pictures as $im) {
                    //dd($im->url);

                    File::delete('uploads/' . $im->url);
                    $im->delete();
                }
            }

            $this->uploads($files, $article->id);
        }
    }

/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        return view('users.admins.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $article = Article::find($id);

        $article->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'abstract' => $request->input('abstract'),
            'content' => $request->input('content'),
            'user_id' => $user->id
        ]);

        $files = $request->file('picture');
        $this->updateUploads($files, $article);

        return redirect('/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if (!is_null($article->picture)) {
            foreach ($article->picture as $im) {
                File::delete('uploads/' . $im->uri); // file
                $im->delete();  // database
            }
        }
        $article->delete();

        return back();
    }
}
