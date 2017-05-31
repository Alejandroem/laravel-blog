<?php

namespace App;

use Carbon\Carbon;
class Post extends Model
{
    //

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){//$post->user->name
        return $this->belongsTo(User::class);
    }
    public function addComment($body){
        $this->comments()->create(compact('body')); //Esta funcion extiende a post de tal forma que post pueda agregar los comentarios que pertenecen a el 
        //OJOOOO de nuevo se llama a la relacióon de comments para crear un nuevo objeto lo que significa que popula el id de forma automática

        /* Comment::create([
            'body'=>$body,
            'post_id'=>$this->id
        ]);*/
    }

    public function scopeFilter($query, $filters){ //Acá por ejemplo recibimos el query que vamos a subfiltrar, en este caso recibimos mes y año
        if($month = $filters['month']){
            $query->whereMonth('created_at', Carbon::parse($month)->month);// si existe un mes agregamos el mes al query
        }

        if($year = $filters['year']){
            $query->whereYear('created_at', $year);// si existe un año agregamos un año al query
        }
    }

    public static function archives(){ // esta es una funcion para poder obtener un query es basicamente como pegarle este codigo a lo que se envia acá
        return static::selectRaw('year(created_at) year,monthname(created_at) month,count(*) published')
            ->groupBy('year','month')
            ->orderByRaw('min(created_at)')
            ->get()
            ->toArray();
    }

}
