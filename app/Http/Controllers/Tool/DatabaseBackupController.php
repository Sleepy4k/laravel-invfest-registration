<?php

namespace App\Http\Controllers\Tool;

use App\DataTables\Admin\DatabaseBackupDataTable;
use App\Facades\DbBackup;
use App\Foundations\Controller;

class DatabaseBackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DatabaseBackupDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.database-backup.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            DbBackup::createBackup();

            toast('Database berhasil di backup', 'success');
            return back();
        } catch (\Throwable $th) {
            toast('Database gagal di backup', 'error');
            return $this->redirectError($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name)
    {
        try {
            // Get latest value when split by - and get the last value
            $name = explode('-', $name);
            $name = end($name);
            $response = DbBackup::downloadFile($name);

            if (!$response) {
                toast('Database tidak ditemukan', 'error');
                return back();
            }

            return $response;
            // return Storage::download('backup/db/'.$name.'.sql');
        } catch (\Throwable $th) {
            toast('Gagal mendownload database', 'error');
            return $this->redirectError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $name)
    {
        try {
            $name = explode('-', $name);
            $name = end($name);
            $response = DbBackup::deleteFile($name);

            if (!$response) {
                toast('Database tidak ditemukan', 'error');
            } else {
                toast('Database berhasil dihapus', 'success');
            }

            return back();
        } catch (\Throwable $th) {
            toast('Database gagal dihapus', 'error');
            return $this->redirectError($th);
        }
    }
}
