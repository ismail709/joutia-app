<?php

namespace App\Http\Controllers;

use App\Enums\AdStatusEnum;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {

    }

    public function show(Ad $ad)
    {
        $categories = Category::whereNull("parent_id")->limit(10)->get();
        $suggestedAds = Ad::all()->random(10);
        return view('ads.show', ['ad' => $ad, 'categories' => $categories, 'suggestedAds' => $suggestedAds]);
    }

    public function filter()
    {

    }

    public function search(Request $request)
    {
        $starttime = hrtime(true);
        $ads = Ad::search($request->query('q'))->options([
            'filter_by' => 'status:=approved',
        ])->paginate(10);
        $endtime = hrtime(true);
        return view("search.index", ["ads" => $ads, "q" => $request->query('q'), "time" => $endtime - $starttime]);
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('subCategories')->get();
        return view('ads.create', ['categories' => $categories]);
    }

    public function store(AdRequest $request)
    {
        $ad = Auth::user()->ads()->create(array_merge($request->except(['images', 'price']), ['price' => $request->integer('price'), 'status' => AdStatusEnum::PENDING]));
        $files = $request->images;
        foreach ($files as $file) {
            $img_path = $file->store('/ad-images', 'public');
            $ad->images()->create(['img_path' => $img_path]);
        }
        return to_route('home');
    }

    public function edit(Ad $ad)
    {
        $categories = Category::whereNull('parent_id')->with('subCategories')->get();
        return view('ads.edit', ['ad' => $ad, 'categories' => $categories]);
    }

    public function update(Request $request, Ad $ad)
    {
        $ad->update(array_merge($request->except(['images', 'price']), ['price' => $request->integer('price'), 'status' => AdStatusEnum::PENDING]));

        if ($request->hasFile('images')) {
            foreach ($ad->images()->get() as $image) {
                Storage::disk('public')->delete($image->img_path);
                $image->delete();
            }
            $files = $request->images;
            foreach ($files as $file) {
                $img_path = $file->store('/ad-images', 'public');
                $ad->images()->create(['img_path' => $img_path]);
            }
        }
        return to_route('myads');
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return back();
    }
}
