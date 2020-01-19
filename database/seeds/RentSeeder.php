<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RentSeeder extends Seeder
{
    private $readers;
    private $copiesCount;

    public function __construct()
    {
        $this->readers     = \DB::table('readers')->get();
        $this->copiesCount = \DB::table('copies')->count();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $copies = [];
        foreach ($this->readers as $reader) {
            for ($i = 0; $i < 5; $i++) {
                $copyId = rand(1, $this->copiesCount);
                if (isset($copies[$copyId])) {
                    continue;
                }

                $copy = \DB::table('copies')->where('id', '=', $copyId)->first();

                $copies[$copyId] = 0;
                if (!$copy) {
                    continue;
                }

                $days       = rand(0, 1000);
                $issuedDate = $this->getDate($days);
                $status     = $copy->status === 0 ? rand(0, 1) : 2;
                if ($status === 0) {
                    $expireAt   = $this->getDate(rand(0, $days));
                    $returnedAt = null;
                } elseif ($status === 1) {
                    $expiredDays = rand(0, $days);
                    $expireAt    = $this->getDate($expiredDays);
                    $returnedAt  = $this->getDate(rand($expiredDays, $days));
                } else {
                    $expireAt   = $this->getDate(rand(1, $days));
                    $returnedAt = null;
                }


                DB::table('rents')->insert([
                    'reader_id'   => $reader->id,
                    'copy_id'     => $copy->id,
                    'status'      => $status,
                    'issued_at'   => $issuedDate,
                    'expire_at'   => $expireAt,
                    'returned_at' => $returnedAt,
                    'created_at'  => $issuedDate
                ]);
            }
        }
    }

    private function getDate($days) {
        $now = Carbon::now();
        $now->subDays($days);
        return $now;
    }
}
