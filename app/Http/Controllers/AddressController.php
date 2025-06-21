<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function showOrForm($userId)
    {
        $address = Address::where('user_id', $userId)->first();
        $user = User::findOrFail($userId);

        return view('pages.user.address', compact('address', 'user'));
    }

    public function storeOrUpdate(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'full_address' => 'required|string',
            'phone' => 'required|string|max:20',
            'postal_code' => 'required|string|max:10',
        ]);

        Address::updateOrCreate(
            ['user_id' => $userId],
            [
                'name' => $request->name,
                'full_address' => $request->full_address,
                'phone' => $request->phone,
                'postal_code' => $request->postal_code,
            ]
        );

        return redirect()->back()->with('success', 'Alamat berhasil disimpan.');
    }
}
