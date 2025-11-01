<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CsvRecord;

class CsvController extends Controller
{
    public function index()
    {
        $data = CsvRecord::all();
        $viewMode = auth()->user()->view_mode ?? 'table'; // 👈 aquí
        return view('dashboard', compact('data', 'viewMode'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $rows = array_map('str_getcsv', file($file->getRealPath()));

        CsvRecord::truncate(); // Limpia la tabla para reemplazar data

        foreach ($rows as $index => $row) {
            if ($index == 0)
                continue;

            CsvRecord::create([
                'email' => $row[0] ?? null,
                'password' => $row[1] ?? null,
            ]);
        }

        return back()->with('success', '✅ Archivo cargado correctamente.');
    }

    public function store(Request $request)
    {
        CsvRecord::create([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return back()->with('success', '✅ Registro agregado con éxito.');
    }

    public function update(Request $request)
    {
        $record = CsvRecord::find($request->id);
        if (!$record)
            return response()->json(['error' => 'Not Found'], 404);

        $record->update([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return response()->json(['status' => 'updated']);
    }

    public function download()
    {
        $records = CsvRecord::all(['email', 'password']); // Campos a exportar

        $filename = "export_" . date('Ymd_His') . ".csv";

        $handle = fopen($filename, 'w');

        // Encabezados
        fputcsv($handle, ['email', 'password']);

        // Datos
        foreach ($records as $record) {
            fputcsv($handle, [$record->email, $record->password]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function delete($id)
    {
        CsvRecord::destroy($id);
        return back();
    }

}
