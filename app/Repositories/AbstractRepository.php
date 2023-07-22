<?php

    namespace App\Repositories;
    use Illuminate\Database\Eloquent\Model;

    abstract class AbstractRepository{

        protected $model;

        public function __construct(Model $model)
        {
            $this->model = $model;
        }

        public function selectAttributesRelated($att){
            $this->model = $this->model->with($att);
        }

        // public function filter($filters) {
        //     $filters = explode(';', $filters);
    
        //     foreach ($filters as $filter) {
        //         $f = explode(':', $filter);
    
        //         // Verificar se o filtro é em um atributo de relacionamento
        //         if (str_contains($f[0], '.')) {
        //             $relationFilter = explode('.', $f[0]);
        //             $this->model = $this->model->whereHas($relationFilter[0], function ($query) use ($relationFilter, $f) {
        //                 $query->where($relationFilter[1], $f[1], $f[2]);
        //             });
        //         } else {
        //             $this->model = $this->model->where($f[0], $f[1], $f[2]);
        //         }
        //     }
        // }

        // public function filter($filters) {
        //     $filters = explode(';', $filters);
        
        //     foreach ($filters as $filter) {
        //         $f = explode(':', $filter);
        
        //         // Verificar se o filtro é em um atributo de relacionamento
        //         if (str_contains($f[0], '.')) {
        //             $relationFilter = explode('.', $f[0]);
        //             $this->model = $this->model->whereHas($relationFilter[0], function ($query) use ($relationFilter, $f) {
        //                 $query->whereHas($relationFilter[1], function ($query) use ($relationFilter, $f) {
        //                     $query->where($relationFilter[2], $f[1], $f[2]);
        //                 });
        //             });
        //         } else {
        //             $this->model = $this->model->where($f[0], $f[1], $f[2]);
        //         }
        //     }
        // }

        public function filter($filters) {
            $filters = explode(';', $filters);
        
            foreach ($filters as $filter) {
                $f = explode(':', $filter);
        
                // Verificar se o filtro é em um atributo de relacionamento
                if (str_contains($f[0], '.')) {
                    $relationFilter = explode('.', $f[0]);
                    if (count($relationFilter) === 3) {
                        $this->model = $this->model->whereHas($relationFilter[0], function ($query) use ($relationFilter, $f) {
                            $query->whereHas($relationFilter[1], function ($query) use ($relationFilter, $f) {
                                $query->where($relationFilter[2], $f[1], $f[2]);
                            });
                        });
                    } elseif (count($relationFilter) === 4) {
                        $this->model = $this->model->whereHas($relationFilter[0], function ($query) use ($relationFilter, $f) {
                            $query->whereHas($relationFilter[1], function ($query) use ($relationFilter, $f) {
                                $query->whereHas($relationFilter[2], function ($query) use ($relationFilter, $f) {
                                    $query->where($relationFilter[3], $f[1], $f[2]);
                                });
                            });
                        });
                    } else {
                        // Lidar com mais níveis de relacionamento aqui, se necessário.
                        // Por exemplo, se houver um quarto nível, adicione outra condição elseif.
                    }
                } else {
                    $this->model = $this->model->where($f[0], $f[1], $f[2]);
                }
            }
        }
        
        public function selectAttributes($attributes){
            $this->model = $this->model->selectRaw($attributes);
        }

        public function getResult(){
            return $this->model->get();
        }

    }

?>

