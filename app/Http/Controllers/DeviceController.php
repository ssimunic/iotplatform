<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function showAll()
    {
        $devices = Device::where('user_id', '=', Auth::user()->id)->get();
        return view('devices')->with('devices', $devices);
    }

    public function addDevice(Request $request)
    {
        Device::create([
            'name' => $request->input('name'),
            'user_id' => Auth::user()->id,
            'api_key' => $this->generateRandomString(45)

        ]);
        
        return redirect()->route('devices')->with('success', 'Device created.');
    }

    public function showEditDevice(Request $request, $id) {
        $device = Device::find($id);
        if ($device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }
 
        return view('device')->with('device', $device);
    }

    public function editDevice(Request $request, $id) {
        $device = Device::find($id);
        if ($device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }

        $device->read_time = $request->input('read_time');
        $device->notes = $request->input('notes');
        $device->save();

        return redirect()->route('devices')->with('success', 'Device settings saved.');        
    }

    public function deleteDevice(Request $request, $id) {
        $device = Device::find($id);
        if ($device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }

        foreach($device->fields as $field) {
            foreach($field->triggers as $trigger) {
                $trigger->delete();
            }
            foreach($field->data as $d) {
                $d->delete();
            }
            foreach($field->chartFields as $chartField) {
                $chartField->delete();
            }
            
            $field->delete();
        }

        $device->delete();

        return redirect()->route('devices')->with('success', 'Device deleted.');
    }

}
