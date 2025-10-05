<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('qr_scans', function (Blueprint $t) {
      $t->id();
      $t->uuid('ticket_id')->index();
      $t->string('scanned_by')->nullable();
      $t->timestamp('scanned_at');
      $t->json('meta')->nullable();
      $t->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('qr_scans'); }
};
