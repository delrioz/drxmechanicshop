<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product; 
use App\Http\Requests\Internal\CategoryFormRequest;
use DB;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $allcategories = Category::orderByRaw('name ASC')->get();
        return view('sections.categories.index', compact('allcategories'));
        
    }

    public function create()
    {
        return view('sections.categories.create');
    }

    public function store(CategoryFormRequest $request)
    {
        Category::create($request->all());

        return redirect()
                ->route('category.index')
                ->with('success',  'The Supplier was successful added!' );
    }

    public function edit($id)
    {
        $allcategories = Category::find($id);

        return view('sections.categories.edit', compact('allcategories'));
    }


    public function destroy($id)
    {
        $deleteCategories = Category::find($id)->delete();

        if($deleteCategories){
            return redirect()
                        ->route('category.index')
                        ->with('success',  'The Supplier was successful removed !' );
            }

            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
            }

    }


    public function view($id)
    {
         $idCategory = $id;
         $findCategory = Category::find($id);
         $categoryName = $findCategory->name;
         $findProducts = Product::where('category', 'LIKE', "%{$idCategory}%")->get();

         return view('sections.categories.view', compact('idCategory', 'findProducts', 'categoryName'));

    }
    

    public function storeAjax(Request $request)
    {   


        $name =  $request->name;
        $about = $request->about;

        $request->name == null ? $name =  'standard' : $name = $name;
        $request->about == null ? $about =  'standard' : $about = $about;

        $categoryStore = new Category();    
        $categoryStore->name = $name;
        $categoryStore->about = $about;
        $categoryStore = $categoryStore->save();


        // $categoryStore = Category::create($request->all());

        if($categoryStore){
            //    return  $allcats = Category::orderByRaw('name ASC')->latest()->get();
            //    return  $allcats = DB::table('categories')->orderBy('name', 'ASC')->first();
            // $lastcat = Category::latest()->orderBy('name', 'ASC')->get();
            // return $allcategories = Category::orderByRaw('name ASC')->all();
            //    return $vars = ["allcats" => $allcategories, "thelastcategorie" => $lastcat];

            return $allcategories = Category::orderByRaw('name ASC')->get();
            
            // return  $allcats = Category::latest()->get();
        }       

    }

    public function update(Request $request, $id)
    {

        // 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email'
        
        $category = Category::find($id);
            if(isset($category)){
            $category->name = $request->input('name');
            $category->about = $request->input('about');
            $updatecategories = $category->save();

            if($updatecategories){
            return redirect()
                        ->route('category.index')
                        ->with('success',  'The Supplier was successful updated!' );
            }

            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }
    }


}

