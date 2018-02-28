<?php
/**
 * This file is part of ruogoo.
 *
 * Created by HyanCat.
 *
 * Copyright (C) HyanCat. All rights reserved.
 */

use PHPUnit\Framework\TestCase;
use Ruogoo\AIToy\MicrosoftCouplet;

class MicrosoftCoupletTest extends TestCase
{

    protected $couplet;

    protected function setUp()
    {
        $this->couplet = new MicrosoftCouplet();
    }

    public function testTruth()
    {
        $this->assertTrue($this->couplet->isValid('哈哈'));
        $this->assertFalse($this->couplet->isValid('什么？'));
        $this->assertFalse($this->couplet->isValid('just eat it'));
    }

    public function testCouplet()
    {
        $wells = $this->couplet->couplet('海上生明月');
        $this->assertNotEmpty($wells);

        $bad = $this->couplet->couplet('这不是对联');
        $this->assertEmpty($bad);
    }
}
