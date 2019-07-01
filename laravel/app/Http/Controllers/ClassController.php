<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classify;


class ClassController extends Controller
{
    public function classList()
    {
        $classes = Classify::orderBy('catSort', 'asc')->get()->toArray();
        if ($classes) {
            $classes = $this->getTree($classes);
            return response()->json(['code' => 0, 'data' => $classes, 'msg' => '郭群大傻子']);
        }

        return response()->json(['code' => 1, 'data' => '错误']);

    }

    protected function getTree($data, $pid = 0)
    {
        $list = [];
        foreach ($data as $val) {
            if ($val['parentId'] == $pid) {
                $val['children'] = $this->getTree($data, $val['catId']);
                $list[] = $val;
            }
        }
        return $list;
    }
}
