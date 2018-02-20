<?php

namespace App\Http\Controllers;

use App\Device;
use App\DeviceField;
use App\Trigger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TriggerController extends Controller
{
    public function showDeviceTriggers(Request $request, $id) 
    {
        $device = Device::find($id);
        if ($device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }

        $triggers = array();

        foreach($device->fields as $field) {
            foreach($field->triggers as $trigger) {
                array_push($triggers, $trigger);
            }
        }

        return view('triggers', [
            'device' => $device,
            'triggers' => $triggers
        ]);
    }

    public function addDeviceTriggers(Request $request, $id) 
    {
        $device = Device::find($id);
        if ($device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }

        Trigger::create([
            'device_field_id' => $request->input('device_field_id'),
            'max_value' => $request->input('max_value'),
            'min_value' => $request->input('min_value'),
            'email' => $request->input('email'),
            'webhook_url' => $request->input('webhook_url')
        ]);

        return redirect()->route('showDeviceTriggers', ['id' => $id])->with('success', 'Trigger added.');        
    }    

    public function deleteDeviceTrigger(Request $request, $id) 
    {
        $trigger = Trigger::find($id);
        if ($trigger->deviceField->device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }
        $deviceId = $trigger->deviceField->device_id;
        $trigger->delete();

        return redirect()->route('showDeviceTriggers', ['id' => $deviceId])->with('success', 'Trigger deleted.');
    }

    public function showEditDeviceTrigger(Request $request, $id)
    {
        $trigger = Trigger::find($id);
        if ($trigger->deviceField->device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }

        return view('edittrigger')->with('trigger', $trigger);
    }    
    
    public function editDeviceTrigger(Request $request, $id)
    {
        $trigger = Trigger::find($id);
        if ($trigger->deviceField->device->user_id != Auth::user()->id) {
            return redirect()->route('devices');
        }
        
        $deviceId = $trigger->deviceField->device_id;
        
        $trigger->device_field_id = $request->input('device_field_id');
        $trigger->max_value = $request->input('max_value');
        $trigger->min_value = $request->input('min_value');
        $trigger->email = $request->input('email');
        $trigger->webhook_url = $request->input('webhook_url');
        $trigger->save();
        
        return redirect()->route('showDeviceTriggers', ['id' => $deviceId])->with('success', 'Trigger edited.');
    }
}
