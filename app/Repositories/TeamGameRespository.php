<?php

    namespace App\Repositories;
    use Illuminate\Database\Eloquent\Model;

    class TeamGameRepository{
        protected $model;

        public function __construct(Model $model)
        {
            $this->model = $model;
        }
    }

?>
