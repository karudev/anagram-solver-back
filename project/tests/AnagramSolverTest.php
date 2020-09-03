<?php

namespace App\Tests;

use App\Service\AnagramSolverService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AnagramSolverTest extends KernelTestCase
{
    /**
     * @var \App\Service\AnagramSolverService
     */
    private $anagramSolverService;

    public function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->anagramSolverService = $kernel->getContainer()->get(AnagramSolverService::class);
    }

    /**
     * @param $a
     * @param $b
     * @param $result
     * @dataProvider algoProvider
     */
    public function testAlgo($a, $b, $result)
    {
        $p = $this->anagramSolverService->run($a, $b);
        $this->assertEquals($p, $result);
    }

    public function algoProvider()
    {
        return [
            ['here', 'hre', -1],
            ['here', 'here', 0],
            ['here', 'heer', 1],
            ['hero', 'heor', 1],
            ['eyssaasse', 'essayasse', 3],
            ['hare', 'hare', 0],
            ['dnolyvee', 'dolyveen', 6],
            ['edlko', 'delko', 1],
            ['edlko', 'dleko', 2],
        ];
    }

}