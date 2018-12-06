<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getById($id)
    {
        $task = DB::table('task')->where('id', $id)->first();
        
        if (!$task) {
            return success_response([
                'message' => 'task is not exists'
            ]);
        }

        $task->operators = json_decode($task->operators);

        return (array) $task;
    }

    public function search()
    {
        $text = $this->get('query', 'nullable');
        $page = $this->get('page', 'nullable', 1);
        $perPage = $this->get('perPage', 'nullable', 50);

        $getQuery = function () use ($text) {
            $query = DB::table('task');

            if ($text) {
                $query->where(function ($query) use ($text) {
                    foreach (['description', 'plant', 'area', 'cost_center'] as $field) {
                        $query->orWhere($field, 'like', "%$text%");
                    }
                });
            }

            return $query;
        };

        $query = $getQuery()
            ->select(DB::raw('count(*)'));
        $total = $query->pluck('count')->first();

        $result = $getQuery()
            ->select('*')->limit($perPage)
            ->offset($perPage * ($page - 1))
            ->orderBy('id', 'desc')
            ->get();

        foreach ($result as &$item) {
            $item->operators = json_decode($item->operators);
        }

        return [
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'data' => $result
        ];
    }

    public function create()
    {
        $data = $this->get('data', 'required');

        $params = [
            'plant' => $data['plant'],
            'area' => $data['area'],
            'type' => $data['type'],
            'cost_center' => $data['cost_center'],
            'description' => $data['description'],

            'setup_time' => $data['setup_time'],
            'welding_time' => $data['welding_time'],
            'turning_time' => $data['turning_time'],
            'operators' => json_encode($data['operators'])
        ];

        $id = DB::table('task')->insertGetId($params);

        return success_response([
            'message' => 'success to create task',
            'id' => $id
        ]);
    }

    public function update()
    {
        $id = $this->get('id', 'required');
        $data = $this->get('data', 'required');

        $params = [
            'plant' => $data['plant'],
            'area' => $data['area'],
            'type' => $data['type'],
            'cost_center' => $data['cost_center'],
            'description' => $data['description'],

            'setup_time' => $data['setup_time'],
            'welding_time' => $data['welding_time'],
            'turning_time' => $data['turning_time'],
            'operators' => json_encode($data['operators'])
        ];

        DB::table('task')->where('id', $id)->update($params);

        return success_response([
            'message' => 'success to update task'
        ]);
    }

    public function delete()
    {
        $ids = $this->get('ids', 'required');
        
        DB::table('task')->whereIn('id', $ids)->delete();

        return success_response([
            'message' => 'success to delete task;'
        ]);
    }
}
