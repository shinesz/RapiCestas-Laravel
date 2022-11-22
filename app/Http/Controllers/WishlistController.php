<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wishlist;
use App\Models\Produtos;
use App\Models\ProdutosAp;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;



class WishlistController extends Controller

{

    public function addToWishlist($produto_id){
    $wishlist = Wishlist::all();
    if (Auth::check()){
                    Wishlist::insert([

                    
                        'user_id' => Auth::id(),

                        'produto_id' => $produto_id,

                    ]);

                    return Redirect::route('desejos');
               
    }

    else{
         return Redirect::route('register');
    }


}
    public function mostrarWishlist(){
        $produtos = Produtos::all();
        $produtosAp = ProdutosAp::all();
        $user = auth()-> user();
        $wishlist = Wishlist::all();
        return view('desejos', ['wishlist'=>$wishlist, 'produtos' => $produtos, 'produtosAp' => $produtosAp, 'user' => $user]);
    }

    public function destroyWishlist($id){

        Wishlist::findOrFail($id) -> delete();
        
        return redirect('desejos');
 
    }
   



}