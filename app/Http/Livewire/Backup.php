<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;

class Backup extends Component
{
    use WithPagination;

    public function render()
    {
        $disk = \Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => Carbon::createFromTimestamp($disk->lastModified($f)),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
        return view('livewire.backups.view', compact('backups'));
    }

    public function copiaParcial()
    {
        
        $url = 'http://localhost/proyecto_cursos_libres/public/backup-partial';
 
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        
        $data = curl_exec($curl);
        
        curl_close($curl);
      
        session()->flash('message', 'Copia de seguridad completada');
      
        
    }

    
    public function copiaCompleta()
    {
        
        $url = 'http://localhost/proyecto_cursos_libres/public/backup';
 
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        session()->flash('message', 'Copia de seguridad completada');
      
        
    }

    public function download($file_name)
    {

        $file = config('backup.backup.name') . "\\" . $file_name;
        $disk =  \Storage::disk(config('backup.backup.destination.disks')[0]);
        $fs = \Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
        return \Response::download($fs->getAdapter()->getPathPrefix() . $file);

    }
}
