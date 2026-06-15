<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Promocion;
use App\Models\Producto;
use Carbon\Carbon;

class FinalizarPromocionesVencidas extends Command
{
    protected $signature = 'promociones:finalizar';
    protected $description = 'Finaliza promociones vencidas y restaura descuentos';

    public function handle() {
        $promociones = Promocion::where('estado', 'activa')
            ->whereDate('fecha_fin', '<', Carbon::today())
            ->get();
        

        foreach ($promociones as $promocion) {
            //dd($promocion->productos);
            // Quitar descuento
            Producto::whereIn('id', $promocion->productos->pluck('id'))->update(['descuento' => 0]);
            // No Eliminamos relaciones de la tabla pivote
            //$promocion->productos()->detach();
            // Cambiar estado
            $promocion->update(['estado' => 'finalizada']);
        }

        $this->info(
            $promociones->count() .
            ' promociones finalizadas.'
        );

        return Command::SUCCESS;
    }
}
