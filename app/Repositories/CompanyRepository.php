<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CompanyRepository
{
    public function getAllCompanies(){
        return Company::all();
    }
    public function getCompanyById($id)
    {
        return Company::find($id);
    }

    public  function storeCompany($request){

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        return Company::create($data);

    }

    public function updateCompany($request, $company){

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        if ($request->hasFile('logo')) {

            if ($company->logo) {
                Storage::delete('public/' . $company->logo);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
            $company->update(['logo' => $logoPath]);
        }
    }

    public function deleteCompany($id){
        $company = $this->getCompanyById($id);
        if ($company->logo) {
            Storage::delete('public/' . $company->logo);
        }
        $company->delete();
    }
}
