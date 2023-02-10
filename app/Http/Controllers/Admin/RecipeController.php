<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Shopping;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{

    public function allRecipe()
    {
        return view('admin.recipe.all-recipe');
    }
    public function allrecipedataTable(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data =  Recipe::join('users', 'recipes.created_by', '=', 'users.id')
                    ->join('categories', 'recipes.category_id', '=', 'categories.id')
                    ->select('recipes.*', 'users.name', 'categories.name as category_name')->latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {

                        $actionBtn = '<div class="text-center"><a href="' . route('show-recipe', $row['id']) . '"><i style="margin: 0 5px;font-size:25px;" class="fas fa-eye" title="show detals"></i></a>
                    <a href="' . route('edit-recipe', $row['id']) . '"><i style="margin: 0 5px;font-size:25px;" class="fas fa-pen" title="show detals"></i></a>
                                    <a href="' . route('delete-recipe', $row['id']) . '"><i style="margin: 0 5px;font-size:25px;" class="fas fa-trash" title="delete detals"></i></a></div>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function addRecipe()
    {
        return view('admin.recipe.add-recipe');
    }
    public function editRecipeView(Recipe $recipe)
    {
        return view('admin.recipe.edit-recipe', ['recipe' => $recipe]);
    }
    public function showRecipe(Recipe $recipe)
    {
        return view('admin.recipe.show-recipe', ['recipe' => $recipe]);
    }
    public function deleteRecipe($id)
    {
        try {
            Recipe::where('id', $id)->delete();
            return redirect()->back()->with('success_message', "Recipe has been deleted successfully!");
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }




    public function editRecipe(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        $recipe->status = $request->status;
        $recipe->title = $request->title;
        $recipe->details = $request->details;
        $recipe->serving = $request->serving;
        $recipe->set_time = $request->set_time;
        $recipe->tags = $request->tags;
        if ($request->hasFile('image')) {
            $recipe->image = $request->image->store('recipes');
        }
        if ($request->hasFile('video')) {
            $recipe->video = $request->video->store('recipes');
        }

        $ingredients = [];
        foreach ($request->ingredients as $ingredient) {
            $ingredients[] = new Ingredient($ingredient);
        }
        $recipe->ingredients()->delete();
        $recipe->ingredients()->saveMany($ingredients);

        $directions = [];
        foreach ($request->directions as $direction) {
            $directions[] = new Direction($direction);
        }
        $recipe->directions()->delete();
        $recipe->directions()->saveMany($directions);

        $shoppings = [];
        foreach ($request->shoppings as $shopping) {
            $shoppings[] = new Shopping($shopping);
        }
        
        $recipe->shoppings()->delete();
        $recipe->shoppings()->create($shoppings);

        $recipe->save();
        return redirect(route('admin.recipes'))->with('message', 'Recipe updated successfully');
    }





}
