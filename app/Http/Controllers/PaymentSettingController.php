<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentSetting;

class PaymentSettingController extends Controller
{

    public function index()
    {
        $setting = PaymentSetting::first();

        return view('payment_settings.index', compact('setting'));
    }


    public function edit()
    {
        $setting = PaymentSetting::first();

        return view('payment_settings.edit', compact('setting'));
    }


    public function update(Request $request)
    {

        $setting = PaymentSetting::first();

        if (!$setting) {
            $setting = new PaymentSetting();
        }

        $setting->bank_name = $request->bank_name;
        $setting->account_number = $request->account_number;
        $setting->account_name = $request->account_name;
        $setting->admin_whatsapp = $request->admin_whatsapp;

        // upload qris
        if ($request->hasFile('qris_image')) {

            $file = $request->file('qris_image');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads/qris'), $filename);

            $setting->qris_image = 'uploads/qris/'.$filename;
        }

        $setting->save();

        return redirect()
            ->route('payment.settings.index')
            ->with('success','Pengaturan pembayaran berhasil disimpan');
    }

}