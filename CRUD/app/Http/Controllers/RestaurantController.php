<?php
 
namespace App\Http\Controllers;
use App\Models\Restaurant;
use Illuminate\Http\Request;
 
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::latest()->paginate(5);
     
        return view('index',compact('restaurants'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
   
        $input = $request->all();
   
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
     
        Restaurant::create($input);
      
        return redirect()->route('index')
                        ->with('success','Restaurant created successfully.');
    }
 
    public function show(Restaurant $restaurant)
    {
  
        return view('show',compact('restaurant'));
    }
 

    public function edit(Restaurant $restaurant)
    {
        return view('edit',compact('restaurant'));
    }
 

    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
            'detail' => 'required'
        ]);
   
        $input = $request->all();
   
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
           
        $restaurant->update($input);
     
        return redirect()->route('index')
                        ->with('success','Product updated successfully');
    }
 

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
      
        return redirect()->route('index')
                        ->with('success','Product deleted successfully');
    }
}