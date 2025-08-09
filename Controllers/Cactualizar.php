<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Cactualizar extends Controller
{
    private const GITHUB_BASE_URL = 'https://github.com/leon9612/';

    public function index()
    {
        if (session('sesionUser') !== "" && session('sesionUser') !== false && session('sesionUser') !== null) {
            return view('Vdescargas');
        } else {
            return redirect()->intended('/');
        }
    }

    public function getActualizacion(Request $request)
    {


        $repo = $request->input('file');

        $fullUrl = self::GITHUB_BASE_URL . $repo;

        $this->descargarActualizacion($fullUrl, $repo);

        return response()->json([
            'success' => true,
            'message' => $repo
        ]);
    }

    private function descargarActualizacion($url, $repo)
    {
        $basePath = base_path();
        $tempDir = storage_path('app/updates/' . $repo);

        // Limpiar y crear directorio temporal
        $this->cleanDirectory($tempDir);

        // Clonar el repositorio
        $this->executeCommand('git clone ' . escapeshellarg($url) . ' ' . escapeshellarg($tempDir));

        // Copiar archivos a la aplicación
        $this->copiarArchivos($tempDir, $basePath);

        // Limpiar después de la copia
        $this->cleanDirectory($tempDir);

        // Registrar la actualización
        // $this->registrarActualizacion($version);
    }

    private function executeCommand($command)
    {
        $process = Process::fromShellCommandline($command);
        $process->setTimeout(300);

        try {
            $process->mustRun();
            return $process->getOutput();
        } catch (ProcessFailedException $exception) {
            Log::error("Error en comando: {$command} - " . $exception->getMessage());
            throw new \Exception("Error al ejecutar la actualización: " . $exception->getMessage());
        }
    }

    private function copiarArchivos($from, $to)
    {
        // Rutas específicas de Laravel que pueden necesitar actualización
        $pathsToUpdate = [
            'app\Http\Controllers' => 'app\Http\Controllers',
            'app\Models' => 'app\Models',
            'resources\views' => 'resources\views',
            'routes' => 'routes',
            'config' => 'config',
            'database\migrations' => 'database\migrations',
            'public' => 'public'
        ];

        foreach ($pathsToUpdate as $source => $destination) {
            $sourcePath = "{$from}\\{$source}";
            $destPath = "{$to}\\{$destination}";

            if (is_dir($sourcePath)) {
                $this->executeCommand('xcopy /E /Y /Q ' . escapeshellarg($sourcePath) . ' ' . escapeshellarg($destPath));
            }
        }
    }

    private function cleanDirectory($path)
    {
        if (is_dir($path)) {
            $this->executeCommand('rmdir /S /Q ' . escapeshellarg($path));
        }
        mkdir($path, 0755, true);
    }

    // private function registrarActualizacion($version)
    // {
    //     $dominio = config('app.url');
    //     $url = "http://updateapp.tecmmas.com/Actualizaciones/updateVersion?dominio={$dominio}&version={$version}";

    //     try {
    //         file_get_contents($url);
    //     } catch (\Exception $e) {
    //         Log::error("Error al registrar actualización: " . $e->getMessage());
    //     }
    // }
}
