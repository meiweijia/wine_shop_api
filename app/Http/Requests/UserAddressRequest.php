<?php

namespace App\Http\Requests;


class UserAddressRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'province'      => 'required',
            'province_code' => 'required',
            'city'          => 'required',
            'city_code'     => 'required',
            'district'      => 'required',
            'district_code' => 'required',
            'address'       => 'required',
            'contact_name'  => 'required',
            'contact_phone' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'province'      => '省',
            'city'          => '城市',
            'district'      => '地区',
            'address'       => '详细地址',
            'zip'           => '邮编',
            'contact_name'  => '姓名',
            'contact_phone' => '电话',
        ];
    }
}
