<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //all address by user
        $addresses = DB::table('addresses')->where('user_id', $request->user()->id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $addresses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //save address
        $address = DB::table('addresses')->insert([
            'name' => $request->name,
            'full_address' => $request->full_address,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code,
            'user_id' => $request->user()->id,
            'is_default' => $request->is_default,
        ]);

        if ($address) {
            return response()->json([
                'status' => 'success',
                'message' => 'address saved'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'address failed to save'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id'           => 'required|exists:addresses,id',
            'name'         => 'required|string|max:255',
            'full_address' => 'required|string',
            'phone'        => 'required|string|max:20',
            'postal_code'  => 'required|string|max:10',
            'user_id'      => 'required|exists:users,id',
        ]);

        // Ambil data alamat berdasarkan ID
        $address = Address::findOrFail($validated['id']);

        // Update data
        $address->update([
            'name'         => $validated['name'],
            'full_address' => $validated['full_address'],
            'phone'        => $validated['phone'],
            'postal_code'  => $validated['postal_code'],
            'user_id'      => $validated['user_id'],
            'updated_at'   => now(),
        ]);

        // Kembalikan response
        return response()->json([
            'status'  => 'success',
            'message' => 'Alamat berhasil diperbarui.',
            'data'    => $address,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
