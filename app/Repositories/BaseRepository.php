<?php

namespace App\Repositories;

class BaseRepository implements BaseRepositoryInterface {

    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function show($id) {
        return $this->model->findOrFail($id);
    }

    public function destroy($id) {
        return $this->model->destroy($id);
    }

    public function listing($condition = null) {
        $result = $this->model;
        if ($condition) {
            $result = $result->where($condition);
        }
        return $result->orderBy('id', 'DESC')->get();
    }

    public function create($request) {

        return $this->model->create($request);
    }

    public function update($request, $id) {

       return $this->model->where('id', '=', $id)->update($request);

    }

}
