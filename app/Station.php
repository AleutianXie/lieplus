<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    //
    public function resume()
    {
        return $this->hasOne('App\Resume', 'id', 'rid');
    }

    public function next()
    {
        if (!in_array($this->status, ['联系中', '意向中', '推荐中', '面试中', 'offer中']))
        {
            return false;
        }
        if ($this->status == '联系中')
        {
            $this->status = 2;
        }
        if ($this->status == '意向中')
        {
            $this->status = 3;
        }
        if ($this->status == '推荐中')
        {
            $this->status = 4;
        }
        if ($this->status == '面试中')
        {
            $this->status = 5;
        }
        if ($this->status == 'offer中')
        {
            $this->status = 6;
        }
        return $this->save();
    }

    public function abandon()
    {
        $this->disable = 1;
        return $this->save();
    }

    public function reactive()
    {
        $this->disable = 0;
        $this->status = 1;
        return $this->save();
    }
}
