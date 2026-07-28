<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index()
    {
        $logo = Setting::getValue('logo', '/img/ytm.jpeg');
        
        // Banner 1
        $bannerImage1 = Setting::getValue('banner_image_1', 'https://placehold.co/1200x400');
        $bannerTitle1 = Setting::getValue('banner_title_1', 'Solusi Kesehatan Hewan Terpercaya');
        $bannerSubtitle1 = Setting::getValue('banner_subtitle_1', 'Distributor resmi obat-obatan.');
        $bannerLink1 = Setting::getValue('banner_link_1', '/');

        // Banner 2
        $bannerImage2 = Setting::getValue('banner_image_2', 'https://placehold.co/1200x400');
        $bannerTitle2 = Setting::getValue('banner_title_2', 'Grosir Peralatan Medis Hewan');
        $bannerSubtitle2 = Setting::getValue('banner_subtitle_2', 'Dapatkan penawaran harga khusus.');
        $bannerLink2 = Setting::getValue('banner_link_2', '/');

        // Banner 3
        $bannerImage3 = Setting::getValue('banner_image_3', 'https://placehold.co/1200x400');
        $bannerTitle3 = Setting::getValue('banner_title_3', 'Suplemen & Nutrisi Hewan Premium');
        $bannerSubtitle3 = Setting::getValue('banner_subtitle_3', 'Tingkatkan daya tahan ternak.');
        $bannerLink3 = Setting::getValue('banner_link_3', '/');

        return view('admin.setting.index', compact(
            'logo', 
            'bannerImage1', 'bannerTitle1', 'bannerSubtitle1', 'bannerLink1',
            'bannerImage2', 'bannerTitle2', 'bannerSubtitle2', 'bannerLink2',
            'bannerImage3', 'bannerTitle3', 'bannerSubtitle3', 'bannerLink3'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            
            // Banner 1 validations
            'banner_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'banner_title_1' => 'required|string|max:255',
            'banner_subtitle_1' => 'required|string|max:1000',
            'banner_link_1' => 'nullable|string|max:255',

            // Banner 2 validations
            'banner_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'banner_title_2' => 'required|string|max:255',
            'banner_subtitle_2' => 'required|string|max:1000',
            'banner_link_2' => 'nullable|string|max:255',

            // Banner 3 validations
            'banner_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'banner_title_3' => 'required|string|max:255',
            'banner_subtitle_3' => 'required|string|max:1000',
            'banner_link_3' => 'nullable|string|max:255',
        ]);

        $destinationPath = public_path('img/web');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        // 1. Logo Update
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = 'logo_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move($destinationPath, $logoName);
            Setting::updateOrCreate(['key' => 'logo'], ['value' => '/img/web/' . $logoName]);
        }

        // 2. Banner 1 Update
        if ($request->hasFile('banner_image_1')) {
            $file = $request->file('banner_image_1');
            $name = 'banner1_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $name);
            Setting::updateOrCreate(['key' => 'banner_image_1'], ['value' => '/img/web/' . $name]);
        }
        Setting::updateOrCreate(['key' => 'banner_title_1'], ['value' => $request->banner_title_1]);
        Setting::updateOrCreate(['key' => 'banner_subtitle_1'], ['value' => $request->banner_subtitle_1]);
        Setting::updateOrCreate(['key' => 'banner_link_1'], ['value' => $request->banner_link_1 ?? '/']);

        // 3. Banner 2 Update
        if ($request->hasFile('banner_image_2')) {
            $file = $request->file('banner_image_2');
            $name = 'banner2_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $name);
            Setting::updateOrCreate(['key' => 'banner_image_2'], ['value' => '/img/web/' . $name]);
        }
        Setting::updateOrCreate(['key' => 'banner_title_2'], ['value' => $request->banner_title_2]);
        Setting::updateOrCreate(['key' => 'banner_subtitle_2'], ['value' => $request->banner_subtitle_2]);
        Setting::updateOrCreate(['key' => 'banner_link_2'], ['value' => $request->banner_link_2 ?? '/']);

        // 4. Banner 3 Update
        if ($request->hasFile('banner_image_3')) {
            $file = $request->file('banner_image_3');
            $name = 'banner3_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $name);
            Setting::updateOrCreate(['key' => 'banner_image_3'], ['value' => '/img/web/' . $name]);
        }
        Setting::updateOrCreate(['key' => 'banner_title_3'], ['value' => $request->banner_title_3]);
        Setting::updateOrCreate(['key' => 'banner_subtitle_3'], ['value' => $request->banner_subtitle_3]);
        Setting::updateOrCreate(['key' => 'banner_link_3'], ['value' => $request->banner_link_3 ?? '/']);

        return redirect()->route('admin.setting.index')->with('success', 'Pengaturan data website berhasil diperbarui!');
    }
}
