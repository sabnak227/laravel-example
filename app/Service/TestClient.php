<?php

namespace App\Service;

use Illuminate\Support\Facades\Log;

class TestClient implements TestInterface
{
    protected $count;

    public function __construct()
    {
        Log::debug(get_class($this) . ':initialized');
        $this->count = 0;
    }

    public function sendReq()
    {
        $this->count++;
    }

    public function getCount()
    {
        return $this->count;
    }
}
