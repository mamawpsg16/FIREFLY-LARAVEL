<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $tags = Tag::latest()->get();
        return view('profile.index',['users' => User::pluck('first_name')->toArray(), 'tags' => $tags]);
    }

    public function show(User $user){
        // dump($user);
        return view('profile.show',compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,gif',
        ]);

        $uniqueFilename = $request->file('image')->hashName();
        $imageName = $request->file('image')->getClientOriginalName();
        $imagePath = $request->file('image')->storeAs('public/profile_pictures', $uniqueFilename);
        $user = auth()->user();
        // dump($user);
        if ($user->image_path && Storage::exists($user->image_path)) {
            Storage::delete($user->image_path);
        }
        // Get the path to the public/profile_pictures directory
        $directoryPath = public_path('storage/profile_pictures');

        // Change the directory permissions to writable and readable by everyone
        chmod($directoryPath, 0777);

        // $user = User::find(auth()->id());
        $user->update([
            'image_name' => $imageName,
            'hash_image_name' => $uniqueFilename,
            'image_path' => $imagePath
        ]);


        return view('profile.index', compact('uniqueFilename'))->with('success', 'Image uploaded successfully.');

        // return back()->with('success', 'Image uploaded successfully.')->with('updated_image',$uniqueFilename);;
    }

    public function toggleFollow(Request $request)
    {
        auth()->user()->following()->toggle($request['id']);
        $user = User::find($request['id']);
        // dump($user->first_name);
        return redirect()->route('profile.show',$user->first_name);
    }

    public function search(Request $request){
        // dd($request->all());
        $query = $request->input('search'); // Get search query from request
        $query = str_replace(['"', "'", ';'], '', $query);
        session(['query' => $query]);
        // session()->flash('query',$query);
    }

    public function searchResults(){
        $query = session('query');
        // $query = session('query');
        $results = User::where(DB::raw('CONCAT(first_name, middle_name, last_name)'), 'LIKE', '%'.$query.'%')
        ->orWhere('email', 'LIKE', '%'.$query.'%')
        ->select(['first_name', 'middle_name', 'last_name', 'email'])
        ->get()->toArray();
        if(!$query){
            $results = [];
        }

        return view('profile.search',compact('results'));
    }

}
