<?php

namespace App\Http\Controllers;

use App\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function showAll()
    {
        $charts = Auth::user()->charts;
        return view('charts')->with('charts', $charts);
    }

    public function addChart(Request $request) {
        Chart::create([
            'user_id' => Auth::user()->id,
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'public' => $request->input('public')
        ]);

        return redirect()->route('charts')->with('success', 'Chart created.');
    }

    public function deleteChart(Request $request, $id) 
    {
        $chart = Chart::find($id);
        if ($chart->user_id != Auth::user()->id) {
            return redirect()->route('charts');
        }

        foreach($chart->fields as $field) {
            $field->delete();
        }

        $chart->delete();
        return redirect()->route('charts')->with('success', 'Chart deleted.');
    }

    public function showEditChart(Request $request, $id)
    {
        $chart = Chart::find($id);
        if ($chart->user_id != Auth::user()->id) {
            return redirect()->route('charts');
        }
 
        $fields = array();

        $devices = Auth::user()->devices;
        
        foreach($devices as $device) {
            foreach($device->fields as $field) {
                array_push($fields, $field);
            }
        }

        return view('editchart', [
            'chart' => $chart,
            'fields' => $fields
        ]);
    }

    public function editChart(Request $request, $id)
    {
        $chart = Chart::find($id);
        if ($chart->user_id != Auth::user()->id) {
            return redirect()->route('charts');
        }
 
        $chart->name = $request->input('name');
        $chart->type = $request->input('type');
        $chart->public = $request->input('public');
        $chart->save();

        return redirect()->route('charts')->with('success', 'Chart edited.');
    }

    public function viewChart(Request $request, $id)
    {
        $chart = Chart::find($id);

        if (!$chart->public) {
            if (!Auth::check()) {
                return redirect()->route('charts');
            }
            if($chart->user_id != Auth::user()->id) {
                return redirect()->route('charts');
            } 
        }

        $data = array();

        foreach($chart->fields as $chartField) {
            $deviceFieldData = array();
            $deviceFieldData['data'] = array();
            $deviceFieldData['chartField'] = $chartField->name;
            foreach($chartField->deviceField->data as $d) {
                array_push($deviceFieldData['data'], $d);
            }
            $data[] = $deviceFieldData;
        }

        return view('chart', [
            'chart' => $chart,
            'data' => $data
        ]);
    }
}
