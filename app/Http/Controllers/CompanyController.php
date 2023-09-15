<?php

namespace App\Http\Controllers;

use App\DataTables\CompanyDataTable;
use App\Http\Requests\CompanyAddUpdateRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{

    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CompanyDataTable $dataTable)
    {
        return $dataTable->render('pages.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.companies.create-update');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyAddUpdateRequest $request)
    {
        DB::beginTransaction();
        try{

            $company = $this->companyService->storeCompany($request);

            DB::commit();

            Session::flash('success', 'Company added successfully');
            return redirect()->route('companies.index');
        }catch (QueryException $e){
            DB::rollback();
            Session::flash('error', 'Something Went Wrong');
            return redirect()->route('companies.index');
        }catch (\Exception $e){
            DB::rollback();

            Session::flash('error', $e->getMessage());
            return redirect()->route('companies.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('pages.companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('pages.companies.create-update',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyAddUpdateRequest $request, Company $company)
    {
        DB::beginTransaction();
        try{

            $this->companyService->updateCompany($request,$company);

            DB::commit();

            Session::flash('success', 'Company updated successfully');
            return redirect()->route('companies.index');
        }catch (QueryException $e){
            DB::rollback();
            Session::flash('error', 'Something Went Wrong');
            return redirect()->route('companies.index');
        }catch (\Exception $e){
            DB::rollback();

            Session::flash('error', $e->getMessage());
            return redirect()->route('companies.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        DB::beginTransaction();
        try{
            $this->companyService->deleteCompany($company->id);

            DB::commit();

            Session::flash('success', 'Company updated successfully');
            return redirect()->route('companies.index');
        }catch (QueryException $e){
            DB::rollback();
            Session::flash('error', 'Something Went Wrong');
            return redirect()->route('companies.index');
        }catch (\Exception $e){
            DB::rollback();

            Session::flash('error', $e->getMessage());
            return redirect()->route('companies.index');
        }
    }
}
