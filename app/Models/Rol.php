<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rol extends Model
{
    protected $fillable=['nombre'];
    public $timestamps = false;
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }
    public function asignarMenus($menus){
        if(is_array($menus)){
            $this->menus()->sync($menus);
        }else{
            if(count($this->menus) == 0){
                $this->menus()->attach($menus);
            } else {
                foreach($this->menus as $menu){
                    if($menu->id != $menus){
                        $this->menus()->attach($menus);
                    }
                }
            }
        }
    }
}
