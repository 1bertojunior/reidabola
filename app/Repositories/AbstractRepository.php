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

        // public function filter($filters)
        // {
        //     $filters = explode(';', $filters);

        //     foreach ($filters as $filter) {
        //         $f = explode(':', $filter);

        //         if (str_contains($f[0], '.')) {
        //             $relationFilter = explode('.', $f[0]);

        //             if (str_contains($relationFilter[0], '|')) {
        //                 // Relacionamento de relacionamento
        //                 $dephRelationFilter = explode('|', $relationFilter[0]);
        //                 $this->model = $this->applyRecursiveWhereHas($this->model, $dephRelationFilter, $relationFilter, $f);
        //             } else {
        //                 // Relacionamento simples
        //                 $this->model = $this->model->whereHas($relationFilter[0], function ($query) use ($relationFilter, $f) {
        //                     $query->where($relationFilter[1], $f[1], $f[2]);
        //                 });
        //             }
        //         } else {
        //             // Sem relacionamento
        //             $this->model = $this->model->where($f[0], $f[1], $f[2]);
        //         }
        //     }
        // }

        // private function applyRecursiveWhereHas($model, $dephRelationFilter, $relationFilter, $f)
        // {
        //     $relation = array_shift($dephRelationFilter);

        //     $model = $model->whereHas($relation, function ($query) use ($dephRelationFilter, $relationFilter, $f) {
        //         if (count($dephRelationFilter) > 0) {
        //             // Chamada recursiva para o próximo nível de relacionamento
        //             $this->applyRecursiveWhereHas($query, $dephRelationFilter, $relationFilter, $f);
        //         } else {
        //             // Último nível - aplicar o filtro
        //             $query->where($relationFilter[1], $f[1], $f[2]);
        //         }
        //     });

        //     return $model;
        // }

        public function selectAttributes($attributes){
            $this->model = $this->model->selectRaw($attributes);
        }

        public function getResult(){
            return $this->model->get();
        }

        public function joinRelated($table, $localKey, $foreignKey, array $withRelations = [])
        {
            // $this->model = $this->model->join($table, $localKey, '=', $foreignKey)
            //     ->select($this->model->getTable() . '.*', $table . '.*');
            $this->model = $this->model->join($table, $localKey, '=', $foreignKey)
                ->select($this->model->getTable() . '.*', $table . '.*')
                ->with($withRelations);
        }

        // public function joinAndLoad($table, $localKey, $foreignKey, array $withRelations = [])
        // {
        //     $this->model = $this->model->join($table, $localKey, '=', $foreignKey)
        //         ->select($this->model->getTable() . '.*', $table . '.*')
        //         ->with($withRelations);
        // }
    
        public function leftJoin($relatedTable, $localKey, $foreignKey)
        {
            $this->model = $this->model->leftJoin($relatedTable, $localKey, '=', $foreignKey)
                ->select($this->model->getTable() . '.*', $relatedTable . '.*');
        }


        public function filter($filters, $tableName = null)
        {
            $filters = explode(';', $filters);

            foreach ($filters as $filter) {
                $f = explode(':', $filter);

                if (str_contains($f[0], '.')) {
                    $relationFilter = explode('.', $f[0]);

                    if (str_contains($relationFilter[0], '|')) {
                        // Relacionamento de relacionamento
                        $dephRelationFilter = explode('|', $relationFilter[0]);
                        $this->model = $this->applyRecursiveWhereHas($this->model, $dephRelationFilter, $relationFilter, $f);
                    } else {
                        // Relacionamento simples
                        $this->model = $this->model->whereHas($relationFilter[0], function ($query) use ($relationFilter, $f) {
                            $query->where($relationFilter[1], $f[1], $f[2]);
                        });
                    }
                } else {
                    if ($tableName !== null && $f[0] === 'id') {
                        $this->applyFilterToTable($tableName, $f[0], $f[1], $f[2]);
                    } else {
                        $this->model = $this->model->where($f[0], $f[1], $f[2]);
                    }
                }
            }
        }

        private function applyFilterToTable($tableName, $column, $operator, $value)
        {
            $this->model = $this->model->where("$tableName.$column", $operator, $value);
        }

        private function applyRecursiveWhereHas($model, $dephRelationFilter, $relationFilter, $f)
        {
            $relation = array_shift($dephRelationFilter);

            $model = $model->whereHas($relation, function ($query) use ($dephRelationFilter, $relationFilter, $f) {
                if (count($dephRelationFilter) > 0) {
                    // Chamada recursiva para o próximo nível de relacionamento
                    $this->applyRecursiveWhereHas($query, $dephRelationFilter, $relationFilter, $f);
                } else {
                    // Último nível - aplicar o filtro
                    $query->where($relationFilter[1], $f[1], $f[2]);
                }
            });

            return $model;
        }

    }

?>

