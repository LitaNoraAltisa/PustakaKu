<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Borrowing;

class UpdateOverdueStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'borrowings:update-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status peminjaman yang sudah melewati batas pengembalian menjadi overdue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // cari semua peminjaman yang sudah melewati deadline dan masih berstatus borrowed
        $updated = Borrowing::where('status', 'borrowed')
            ->whereDate('return_deadline', '<', today())
            ->update(['status' => 'overdue']);

        // tampilkan jumlah data yang diupdate
        $this->info("Berhasil mengupdate {$updated} peminjaman menjadi overdue.");

        return Command::SUCCESS;
    }
}
