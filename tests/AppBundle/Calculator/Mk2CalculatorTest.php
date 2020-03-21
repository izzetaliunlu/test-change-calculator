<?php

namespace Tests\AppBundle\Calculator;

use AppBundle\Calculator\CalculatorInterface;
use AppBundle\Model\Change;
use AppBundle\Calculator\Mk2Calculator;
use PHPUnit\Framework\TestCase;

class Mk2CalculatorTest extends TestCase
{
    /**
     * @var CalculatorInterface
     */
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Mk2Calculator();
    }

    public function testGetSupportedModel(): void
    {
        $this->assertEquals('mk2', $this->calculator->getSupportedModel());
    }

    public function testGetChangeEasy(): void
    {
        $change = $this->calculator->getChange(2);
        $this->assertInstanceOf(Change::class, $change);
        $this->assertEquals(1, $change->coin2);
    }

    public function testGetChangeImpossible(): void
    {
        $change = $this->calculator->getChange(1);
        $this->assertNull($change);
    }

    /**
     * @dataProvider provider
     */
    public function testGetChangeHard($amount, ?Change $changeResult): void
    {
        $change = $this->calculator->getChange($amount);

        if (null === $changeResult) {
            $this->assertNull($change);
        } else {
            $this->assertSame($change->bill10, $changeResult->bill10);
            $this->assertSame($change->bill5, $changeResult->bill5);
            $this->assertSame($change->coin2, $changeResult->coin2);
        }
    }

    public function provider(): array
    {
        $change1 = new Change();
        $change1->bill10 = 1;
        $change1->bill5 = 1;
        $change1->coin2 = 1;

        $change2 = new Change();
        $change2->bill10 = 78;
        $change2->bill5 = 1;
        $change2->coin2 = 2;


        return [
            [17, $change1],
            [18, null],
            [789, $change2],
        ];
    }
}
