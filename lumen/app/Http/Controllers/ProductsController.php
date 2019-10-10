<?php


namespace App\Http\Controllers;


use App\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductsController
{
    public function create(Request $request)
    {
        $pro = new Products();
        $expl = explode(',', $request->input('image'));
        $decode = base64_decode($expl[1]);

        if (Str::contains($expl[0], 'png')) {
            $ext = 'png';
        } else {
            $ext = 'jpg';
        }
        $currentTime = Carbon::now()->timestamp;
        $fileName = $currentTime . '.' . $ext;

        file_put_contents('products/' . $fileName, $decode);
        $pro->name = $request->input('name');
        $pro->quantity = $request->quantity;
        $pro->price = $request->price;
        $pro->image = $fileName;
        $pro->save();
        return response()->json(['message' => $pro], 201);
    }

    public function view($id)
    {
        $data = Products::find($id);
        if ($data == null) {
            return response()->json(['message' => 'Item Not Found'], 404);
        }
        return response()->json(['message' => $data->toArray()], 200);
    }

    public function list(Request $request)
    {
        $data = Products::all();
        if ($data == null) {
            return response()->json(['message' => 'Item Not Found'], 404);
        }
        return response()->json(['allItems' => $data->toArray()], 200);
    }

    public function update(Request $request)
    {
        $pro = Products::find($request->id);
        if ($pro == null) {
            return response()->json(['message' => 'Item Not Found'], 404);
        }

        $pro->name = $request->name;
        $pro->quantity = $request->quantity;
        $pro->price = $request->price;
        $pro->save();
        return response()->json(['message' => $pro], 200);
    }

    public function delete(Request $request)
    {
        $product = Products::find($request->id);
        if ($product != null) {
            $product->delete();
            return response()->json(['message' => 'Deleted Success'], 201);
        } else {
            return response()->json(['message' => 'Item Not Found'], 404);
        }
    }
}
