<?php 

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait CanLoadRelationships {
  public function loadRelationships(Model|Builder $for,array $relations = null) : Model|Builder{
    $relations ??= $this->relations ?? []; 

    foreach($relations as $relation){ 
      $for->when(
          $this->shouldIncludeRelation($relation),
          fn($q) => $for instanceof Model ? $for->load($relation) : $q->with($relation));
    }
    return $for;
  }
}