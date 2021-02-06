<?php

namespace Tests\Unit\Models;
use App\User;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCanReserve ()
    {
        $user = new User();

        //pattern1
        $user->plan = "regular";
        $remainingCount = 1;
        $reservationCount = 4;
        $this->assertTrue($user->canReserve($remainingCount, $reservationCount));

        //pattern2
        $user->plan = "regular";
        $remainingCount = 1;
        $reservationCount = 5;
        $this->assertTrue($user->canReserve($remainingCount, $reservationCount));
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
