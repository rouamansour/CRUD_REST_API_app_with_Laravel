<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::with('categories','scategories')->get()->toArray();
        return array_reverse($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $article = new Article([
            'caracteristiques' => $request->input('caracteristiques'),
            'designation' => $request->input('designation'),
            'marque' => $request->input('marque'),
            'reference' => $request->input('reference'),
            'qtestock' => $request->input('qtestock'),
            'prixAchat' => $request->input('prixAchat'),
            'prixVente' => $request->input('prixVente'),
            'prixSolde' => $request->input('prixSolde'),
            'imageartpetitf' => $request->input('imageartpetitf'),
            'imageartgrandf' => $request->input('imageartgrandf'),
            'categorieID' => $request->input('categorieID'),
            'scategorieID' => $request->input('scategorieID')
            ]);
            $article->save();
            
            return response()->json('Article créé !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $article= Article::find($id);
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //
        $article = Article::find($id);
        $article->update($request->all());
        return response()->json('Article MAJ !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $article = Article::find($id);
        $article->delete();
        return response()->json('Article supprimé !');
    }
}
