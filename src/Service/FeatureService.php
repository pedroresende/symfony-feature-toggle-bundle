<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Feature;
use App\Repository\FeatureRepository;

class FeatureService
{
    /**
     * @var FeatureRepository
     */
    private FeatureRepository $featureRepository;

    public function __construct(FeatureRepository $featureRepository)
    {
        $this->featureRepository = $featureRepository;
    }

    public function isEnabled(string $featureName): bool
    {
        /** @var Feature $feature */
        $feature = $this->featureRepository->findBy(['name' => $featureName]);

        if ($this->isFeatureEnabled($feature)) {
            return true;
        }

        return false;
    }

    private function isFeatureEnabled(Feature $feature): bool
    {
        return !is_null($feature->getId()) && $feature->getEnabled();
    }
}
