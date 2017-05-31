<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    // se puede crear una función dentro del modelo de tal forma que popule automáticamente los querys con el id del modelo
    //en este caso al llamar a la relación posts() se popula el metodo
    public function publish(Post $post){
        $this->posts()->save($post);//aca no se especifican parametros como en el comentario de abajo por que se tiene una instancia de post y como se llama a la relación posts() automáticamente se popula el id_user
        /*Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);*/
    }
}
