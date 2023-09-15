<?php

namespace App\Services;


use App\Repositories\CompanyRepository;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getAllCompanies(){
        return $this->companyRepository->getAllCompanies();
    }

    public function getCompanyById($id)
    {
        return $this->companyRepository->getCompanyById($id);
    }

    public function storeCompany($request){
        return $this->companyRepository->storeCompany($request);
    }

    public function updateCompany($request, $company){
        return $this->companyRepository->updateCompany($request, $company);
    }

    public function deleteCompany($id){
        return $this->companyRepository->deleteCompany($id);
    }

}
