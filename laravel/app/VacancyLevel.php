<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacancyLevel extends Model
{
    private $remainingCount;



    public function __construct($remainingCount) {
        $this->remainingCount = $remainingCount;
    }

    public function mark() {
        if($this->remainingCount === 0) return "×";

        if($this->remainingCount < 5) return "△";

        return "◎";
    }

    public function __toString()
{
    return $this->mark();
}
}
