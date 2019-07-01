<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    protected $table ='shop_collect';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded =[];

    public function CollectAdd($post)
    {
        $post['addtime'] = date('Y-m-d H:i:s',time());
        return $this->create($post);
    }
}
