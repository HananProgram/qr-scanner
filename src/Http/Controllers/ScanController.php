<?php
namespace Services\QrScanner\Http\Controllers;

use Illuminate\Routing\Controller;
use Services\QrScanner\Http\Requests\ScanRequest;
use Services\QrScanner\Services\QrScanner;
use Illuminate\Support\Facades\DB;

class ScanController extends Controller
{
    public function health() { return response()->json(['ok'=>true]); }

    public function scan(ScanRequest $r, QrScanner $scanner)
    {
        if ($key = config('qr.api_key')) {
            abort_unless($r->header('X-API-Key') === $key, 401);
        }
        $res = $scanner->scan($r->string('payload'));

        if ($res['valid']) {
            DB::table('qr_scans')->insert([
                'ticket_id'  => $res['ticket_id'],
                'scanned_by' => (string) $r->user()?->id,
                'scanned_at' => now(),
                'meta'       => json_encode($res['meta']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return response()->json($res);
    }
}
