<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {

        return view('content.admin.barang.manage-barang');
    }

    public function datatable(request $request){
        $data = Product::where('type', 'barang');

        return DataTables::of($data)->make();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['provider'] = Provider::get();
        return view('content.admin.barang.manage-barang-create', $data);
    }

    public function store(Request $request)
    {
    Product::create([
        'provider_id' => $request->provider_id,
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'type' => 'barang',
        'image' => null,
    ]);
    return redirect()->back()->with('success', 'Berhasil membuat data!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['barang'] = Product::findOrFail($id);

        return view('content.admin.manage-barang-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Product::findOrFail($id)->update([
            'provider_id' => $request->provider_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'type' => 'barang',
            'image' => null,
        ]);
        return redirect()->back()->with('success', 'Berhasil membuat data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
