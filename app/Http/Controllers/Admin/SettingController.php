<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Setting;
use App\Traits\UploadUtilsTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use UploadUtilsTrait;

    public function __construct(Request $request, Administrator $admin)
    {
        $this->request = $request;
        $this->admin = $admin;
    }

    public function edit()
    {
        $admin = $this->request->admin;

        return view('admin.settings.edit', compact('admin'));
    }

    public function update()
    {
        try {
            $setting = Setting::first();

            $setting->update([
                'title'   => $this->request->input('title'),
                'email'   => $this->request->input('email'),
                'address' => $this->request->input('address'),
                'phone'   => $this->request->input('phone'),
            ]);

//            logo-------------------------
            if ($this->request->input('deleted_image_logo')) {
                $logo = $setting->logoModel;
                if ($logo) {
                    $this->mediaRemove($logo, 'assetsStorage');
                }
            }
            if ($this->request->hasFile('logo')) {
                $logo = $this->request->file('logo');
                $this->imageUpload($logo, 'logo', 'assetsStorage', $setting);
            }

            //            icon-------------------------

            if ($this->request->input('deleted_image_icon')) {
                $icon = $setting->iconModel;
                if ($icon) {
                    $this->mediaRemove($icon, 'assetsStorage');
                }
            }
            if ($this->request->hasFile('icon')) {
                $icon = $this->request->file('icon');
                $this->imageUpload($icon, 'icon', 'assetsStorage', $setting);
            }

            if ($this->request->input('deleted_image_background_image')) {
                $backgroundImage = $setting->backgroundImageModel;
                if ($backgroundImage) {
                    $this->mediaRemove($backgroundImage, 'assetsStorage');
                }
            }
            if ($this->request->hasFile('background_image')) {
                $backgroundImage = $this->request->file('background_image');
                $this->imageUpload($backgroundImage, 'backgroundImage', 'assetsStorage', $setting);
            }

            if ($this->request->input('deleted_video')) {
                $video = $setting->backgroundVideoModel;
                if ($video) {
                    $this->mediaRemove($video, 'assetsStorage');
                }
            }

            if ($this->request->hasFile('video')) {
                $video = $this->request->file('video');
                $this->videoUpload($video, $setting, 'backgroundVideo', 'assetsStorage');
            }

            return redirect(route('admin.settings'));

        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['error' => trans('trs.changed_unsuccessfully')]);
        }
    }

}
