<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Laravel\Facades\Image;

class CreateWorkspaceDefaultIcons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-workspace-default-icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $workspace_icon_sizes = [36, 44];

        for ($i = 0; $i <= 24; $i++) {
            if ($i < 10) {
                $number = "0$i";
            } else {
                $number = $i;
            }

            $response = Http::get("https://a.slack-edge.com/80588/img/avatars-teams/ava_00$number-34.png");
            $body = $response->body();

            $file = tempnam(sys_get_temp_dir(), 'image');
            file_put_contents($file, $body);

            foreach ($workspace_icon_sizes as $size) {
                $image = Image::read($file)->resize(
                    width: $size,
                    height: $size,
                )->encode(encoder: new PngEncoder);

                Storage::put(
                    path: "public/workspace_icons/default/$number/$size.png",
                    contents: $image
                );
            }
        }
    }
}
