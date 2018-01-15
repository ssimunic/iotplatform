<?php

namespace App\Http\Controllers;

use App\ChartField;
use App\Chart;
use App\DeviceField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartFieldController extends Controller
{
    public function addChartField(Request $request, $id)
    {
        $chart = Chart::find($id);
        $deviceFieldId = $request->input('device_field_id');
        $deviceField = DeviceField::find($deviceFieldId);

        if (($chart->user_id != Auth::user()->id) || ($deviceField->device->user_id != Auth::user()->id)) {
            return redirect()->route('charts');
        }

        ChartField::create([
            'name' => $request->input('name'),
            'device_field_id' => $deviceFieldId,
            'chart_id' => $id
        ]);

        return redirect()->route('editChart', ['id' => $id])->with('success', 'Field added.');        
    }
    
    public function deleteChartField(Request $request, $id) {
        $chartField = ChartField::find($id);

        if($chartField->chart->user_id != Auth::user()->id) {
            return redirect()->route('charts');
        }
        $chartId = $chartField->chart_id;
        $chartField->delete();
        return redirect()->route('editChart', ['id' => $chartId])->with('success', 'Field deleted.');        
    }
}
