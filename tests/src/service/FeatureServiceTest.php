<?php

namespace Tests\PedroResende\SymfonyFeatureToggleBundle\Service;

use PedroResende\SymfonyFeatureToggleBundle\Entity\Feature;
use PedroResende\SymfonyFeatureToggleBundle\Repository\FeatureRepository;
use PedroResende\SymfonyFeatureToggleBundle\Service\FeatureService;

it('isEnabled returns false', function () {
    $feature = new Feature();
    $feature->setEnabled(false);
    $featureRepository = $this->createMock(FeatureRepository::class);
    $featureRepository->expects($this->once())->method('findBy')->with(['name' => 'new-feature'])->willReturn($feature);

    $featureService = new FeatureService($featureRepository);

    $this->assertFalse($featureService->isEnabled('new-feature'));
});

it('isEnabled returns true', function () {
    $feature = $this->createMock(Feature::class);
    $feature->method('getId')->willReturn(1);
    $feature->method('getEnabled')->willReturn(true);

    $featureRepository = $this->createMock(FeatureRepository::class);
    $featureRepository->expects($this->once())->method('findBy')->with(['name' => 'new-feature'])->willReturn($feature);

    $featureService = new FeatureService($featureRepository);

    $this->assertTrue($featureService->isEnabled('new-feature'));
});
