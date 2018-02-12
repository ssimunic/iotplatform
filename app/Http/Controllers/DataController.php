<?php

namespace App\Http\Controllers;

use App\Device;
use App\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function addData(Request $request) 
    {
        $api_key = $request->input('api_key');
        $datetime = $request->input('datetime');

        if(empty($api_key)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Missing api key.'
            ]);
        }

        if(empty($datetime)) {
            $datetime = date("Y-m-d H:i:s");
        }

        $values = $request->except(['api_key', 'datetime']);
        if(empty($values)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No values.'
            ]);
        }
        
        $device = Device::where('api_key', '=', $api_key)->first();
        if(empty($device)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Non existing api key.'
            ]);
        }

        $fieldsFound = array();
        $fieldsNotFound = array();
        $triggers_activated = array();

        foreach($values as $key => $value) {
            $foundField = 0;
            foreach($device->fields as $field) {
                if($field->key == $key) {
                    $foundField = 1;
                    Data::create([
                        'value' => $value,
                        'datetime' => $datetime,
                        'device_field_id' => $field->id
                    ]);
                    array_push($fieldsFound, $key); 

                    foreach($field->triggers as $trigger) {
                        if (($value > $trigger->max_value) || ($value < $trigger->min_value)) {
                            array_push($triggers_activated, array(
                                'min_value' => $trigger->min_value,
                                'max_value' => $trigger->max_value,
                                'email' => $trigger->email,
                                'webhook_url' => $trigger->webhook_url
                            ));

                            // todo: send email, call webhook
                        } 
                    }
                }
            }
            if (!$foundField) {
                array_push($fieldsNotFound, $key); 
            }
        }

        $device->last_check = $datetime;
        $device->save();

        return response()->json([
            'status' => 'success',
            'read_every' => $device->read_every,
            'added' => $fieldsFound,
            'not_added' => $fieldsNotFound,
            'triggers_activated' => $triggers_activated
        ]);
    }
}
