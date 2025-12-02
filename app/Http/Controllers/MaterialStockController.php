<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialStockController extends Controller
{
    /**
     * Admin/Super Admin can increase stock.
     * Logs into stock_logs.
     */
    public function add(Request $request, Material $material)
    {
        $data = $request->validate([
            'qty' => ['required', 'numeric', 'gt:0'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $user = $request->user();

        DB::transaction(function () use ($material, $user, $data) {
            $locked = Material::whereKey($material->id)->lockForUpdate()->firstOrFail();

            $before = (float) $locked->stock;
            $qty = (float) $data['qty'];
            $after = $before + $qty;

            $locked->stock = $after;
            $locked->save();

            StockLog::create([
                'material_id' => $locked->id,
                'user_id' => $user->id,
                'type' => 'add',
                'qty' => $qty,
                'before_stock' => $before,
                'after_stock' => $after,
                'order_id' => null,
                'reason' => $data['reason'] ?: 'Manual stock add',
            ]);
        });

        return redirect()->route('materials.show', $material)->with('success', 'Stock added successfully.');
    }
}
