<?php

namespace App\Repositories\OutgoingGoods;

use LaravelEasyRepository\Repository;

interface OutgoingGoodsRepository extends Repository{

    public function generateCode();
}
