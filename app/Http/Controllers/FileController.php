<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Imports\UsersImport;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Excel;

class FileController extends Controller
{
    private $usersImport;

    public function __construct(UsersImport $usersImport)
    {
        $this->usersImport = $usersImport;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        // Check if the user has the role / permission to access this page
        abort_if(Gate::denies('import-accounts'), 403);

        return view('admin.csv.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadFileRequest $request
     * @return RedirectResponse
     */
    public function store(UploadFileRequest $request): RedirectResponse
    {
        // Get the requested file and store it
        $file = $request->file('user-file')->store('import');

        // Start the import in userImport class, with the requested file
        $this->usersImport->import($file, null, Excel::XLSX);

        // Check if there are any failures, if so then redirect with the failures, but it succeeded
        if ($this->usersImport->failures()->isNotEmpty()) {
            return redirect()->route('admin.upload.index')->with('failures', $this->usersImport->failures());
        }

        return redirect()->route('admin.upload.index')->with('success', 'Leerlingen geïmporteerd!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
