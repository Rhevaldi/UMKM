<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentSetting;

class PaymentSettingController extends Controller
{

public function edit()
{
    $setting = PaymentSetting::first();

    return view('payment_settings.edit',compact('setting'));
}

public function update(Request $request)
{
    $setting = PaymentSetting::first();

    if(!$setting){
        $setting = new PaymentSetting();
    }

    if($request->hasFile('qris_image')){

        $file = $request->file('qris_image');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'),$filename);

        $setting->qris_image = 'uploads/'.$filename;
    }

    $setting->bank_name = $request->bank_name;
    $setting->account_number = $request->account_number;
    $setting->account_name = $request->account_name;

    $setting->save();

    return back()->with('success','Pengaturan pembayaran diperbarui');
}

}