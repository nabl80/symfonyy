<?php

namespace App\Tests\Unit;

use App\Entity\Agency;
use App\Manager\AgencyManager;
use App\Repository\AgencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AgencyManagerTest extends TestCase
{
    private AgencyManager $agencyManager;
    private MockObject $em;

    public function setUp(): void
    {
        parent::setUp();

        $this->em = $this->createMock(EntityManagerInterface::class);

        $this->agencyManager = new AgencyManager($this->em);
    }

    #[NoReturn]
    public function testGetsagencyByName(): void
    {
        $agencyName = 'Bandymas';
        $agency = new Agency();
        $agency->setName($agencyName);

        $repository = $this->createMock(AgencyRepository::class);
        $this->em->method('getRepository')->with(Agency::class)->willReturn($repository);
        $repository->method('findOneBy')->willReturn($agency);

        $agency = $this->agencyManager->getOneByName($agencyName);

        $this->assertSame($agencyName, $agency->getName());
    }
}
