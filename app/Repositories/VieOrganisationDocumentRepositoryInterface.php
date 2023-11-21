<?php

namespace App\Repositories;

interface VieOrganisationDocumentRepositoryInterface
{

    public function add($code_doc, $filename);

    public function delete($filename);

}
