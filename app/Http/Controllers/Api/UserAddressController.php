<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends ApiController
{
    public function index(Request $request)
    {
        return $this->success($request->user()->addresses);
    }

    public function store(UserAddressRequest $request)
    {
        $result = $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));
        return $this->success($result);
    }

    public function update(UserAddressRequest $request, UserAddress $userAddress)
    {
        $this->authorize('own', $userAddress);
        $result = $userAddress->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));
        return $this->success($result);
    }

    public function destroy(UserAddress $userAddress)
    {
        $this->authorize('own', $userAddress);
        $result = $userAddress->delete();
        return $this->success($result);
    }
}
