<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class NodebbImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sb:nodebb:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import NodeBB User data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $row = 0;
        $header = [];
        $data = [];
        $result = [];
        if (($handle = fopen(__DIR__ . "/data.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
                
                $row++;
                if ($row == 1) { 
                    $header = $data;
                    continue; 
                }
                $row = [];
                foreach ($data as $i => $col) {
                    $row[$header[$i]] = $col;
                }
                $result[] = $row;
            }
            fclose($handle);
        }
        dump($result[0]);

        foreach ($result as $user) {
            try {
                User::create([
                    "name" => $user["username"],
                    "email" => $user["email"],
                    "email_verified_at" => $user["email:confirmed"] == 1 ? now() : null,
                    "password" => $user["password"],
                    "created_at" => Carbon::createFromTimestampMs($user["joindate"]),
                    "updated_at" => now(),
                    "slug" => $user["userslug"],
                    "picture" => !empty($user["picture"]) ? $user["picture"] : null,
                    "picture_legacy" => !empty($user["picture"]),
                    "location" => !empty($user["location"]) ? $user["location"] : null,
                    "aboutme" => !empty($user["aboutme"]) ? $user["aboutme"] : null,
                    "birthday" => !empty($user["birthday"]) ? $user["birthday"] : null,
                    "signature" => !empty($user["signature"]) ? $user["signature"] : null,
                    "website" => !empty($user["website"]) ? $user["website"] : null,
                    "nodebb_uid" => $user["uid"],
                ]);
            } catch (\Throwable $th) {
                dump("failed: " . $user["username"]);
            }
            
        }
        return 0;
    }
}
