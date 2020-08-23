<?php

namespace App\Repositories;

interface BaseRepositoryInterface {

    public function show($id);

    public function listing($condition = null);

    public function update($request, $id);

    public function create($request);

    public function destroy($id);

  
}
