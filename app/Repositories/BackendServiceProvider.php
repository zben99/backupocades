<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\TypepartenaireRepositoryInterface',
            'App\Repositories\TypepartenaireRepository',
        );

        $this->app->bind(
            'App\Repositories\TypeDocumentRepositoryInterface',
            'App\Repositories\TypeDocumentRepository',
        );

        $this->app->bind(
            'App\Repositories\VieOrganisationRepositoryInterface',
            'App\Repositories\VieOrganisationRepository',
        );

        $this->app->bind(
            'App\Repositories\VieOrganisationDocumentRepositoryInterface',
            'App\Repositories\VieOrganisationDocumentRepository',
        );

        $this->app->bind(
            'App\Repositories\PartenaireRepositoryInterface',
            'App\Repositories\PartenaireRepository',
        );

        $this->app->bind(
            'App\Repositories\RegionRepositoryInterface',
            'App\Repositories\RegionRepository',
        );

        $this->app->bind(
            'App\Repositories\ProgramRepositoryInterface',
            'App\Repositories\ProgramRepository',
        );

        $this->app->bind(
            'App\Repositories\CommuneRepositoryInterface',
            'App\Repositories\CommuneRepository',
        );

        $this->app->bind(
            'App\Repositories\VillageRepositoryInterface',
            'App\Repositories\VillageRepository',
        );

        $this->app->bind(
            'App\Repositories\ParoisseRepositoryInterface',
            'App\Repositories\ParoisseRepository',
        );

        $this->app->bind(
            'App\Repositories\ObjectifSpecifiqueRepositoryInterface',
            'App\Repositories\ObjectifSpecifiqueRepository',
        );

        $this->app->bind(
            'App\Repositories\SecteurRepositoryInterface',
            'App\Repositories\SecteurRepository',
        );

        $this->app->bind(
            'App\Repositories\ProvinceRepositoryInterface',
            'App\Repositories\ProvinceRepository',
        );

        $this->app->bind(
            'App\Repositories\DomaineRepositoryInterface',
            'App\Repositories\DomaineRepository',
        );

        $this->app->bind(
            'App\Repositories\ActiviteRepositoryInterface',
            'App\Repositories\ActiviteRepository',
        );

        $this->app->bind(
            'App\Repositories\ProjetRepositoryInterface',
            'App\Repositories\ProjetRepository',
        );

        $this->app->bind(
            'App\Repositories\ProjetPrevisionnelRepositoryInterface',
            'App\Repositories\ProjetPrevisionnelRepository',
        );

        $this->app->bind(
            'App\Repositories\ActivitePrevisionnelleRepositoryInterface',
            'App\Repositories\ActivitePrevisionnelleRepository',
        );

        $this->app->bind(
            'App\Repositories\HistoriqueRepositoryInterface',
            'App\Repositories\HistoriqueRepository',
        );

        $this->app->bind(
            'App\Repositories\ActivitedocumentRepositoryInterface',
            'App\Repositories\ActivitedocumentRepository',
        );

        $this->app->bind(
            'App\Repositories\DocumentRepositoryInterface',
            'App\Repositories\DocumentRepository',
        );

        $this->app->bind(
            'App\Repositories\ConfigRepositoryInterface',
            'App\Repositories\ConfigRepository',
        );

        $this->app->bind(
            'App\Repositories\IndicateurRepositoryInterface',
            'App\Repositories\IndicateurRepository',
        );

        $this->app->bind(
            'App\Repositories\VillageRepositoryInterface',
            'App\Repositories\VillageRepository',
        );

        $this->app->bind(
            'App\Repositories\IndicateurprevRepositoryInterface',
            'App\Repositories\IndicateurprevRepository',
        );
    }
}
