<?php

namespace App\Http\Controllers;

use App\Data;
use App\Device;
use App\DeviceField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceFieldController extends Controller
{
    public function showDeviceFields(Request $request, $id) 
    {
        $device = Device::find($id);
        if ($device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }

        return view('fields')->with('device', $device);
    }

    public function addDeviceFields(Request $request, $id) 
    {
        $device = Device::find($id);
        if ($device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }

        DeviceField::create([
            'key' => $request->input('key'),
            'device_id' => $id
        ]);

        return redirect()->route('showDeviceFields', ['id' => $id])->with('success', 'Field added.');        
    }

    public function deleteDeviceFields(Request $request, $id) 
    {
        $deviceField = DeviceField::find($id);
        if ($deviceField->device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }
        $deviceId = $deviceField->device_id;

        //try {
        foreach($deviceField->data as $data) {
            $data->delete();
        }

        foreach($deviceField->triggers as $trigger) {
            $trigger->delete();
        }

        foreach($deviceField->chartFields as $chartField) {
            $chartField->delete();
        }

        $deviceField->delete();
        //} catch (\Illuminate\Database\QueryException $e) {
        //    return redirect()->route('showDeviceFields', ['id' => $deviceId])->with('error', 'Delete active triggers or chart fields for this field first.');        
        //}

        return redirect()->route('showDeviceFields', ['id' => $deviceId])->with('success', 'Field deleted.');        
    }

    public function resetDeviceFields(Request $request, $id) 
    {
        $deviceField = DeviceField::find($id);
        if ($deviceField->device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }
        $deviceId = $deviceField->device_id;
        
        foreach($deviceField->data as $data) {
            $data->delete();
        }

        return redirect()->route('showDeviceFields', ['id' => $deviceId])->with('success', 'Field data reseted.');        
    }

    public function dataDeviceFields(Request $request, $id) {
        $deviceField = DeviceField::find($id);
        if ($deviceField->device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }

        $data = Data::where('device_field_id', '=', $id)->orderBy('datetime', 'desc')->paginate(20);

        return view('datafield')->with([
            'data' =>  $data,
            'field' => $deviceField
        ]);
    }
}
