<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function index();
    public function show($id);
    public function store($data);
    public function delete($id);
    public function update($id,$data);

}
