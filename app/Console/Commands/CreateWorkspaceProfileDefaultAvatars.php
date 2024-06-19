<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Laravel\Facades\Image;

class CreateWorkspaceProfileDefaultAvatars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-workspace-profile-default-avatars';

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
        $profile_avatar_sizes = [20, 36, 72, 96, 192, 256];

        for ($i = 0; $i <= 26; $i++) {
            if ($i < 10) {
                $number = "0$i";
            } else {
                $number = $i;
            }
            $response = Http::get("https://i1.wp.com/a.slack-edge.com/df10d/img/avatars/ava_00$number-512.png?ssl=1");
            $body = $response->body();

            $file = tempnam(sys_get_temp_dir(), 'image');
            file_put_contents($file, $body);

            foreach ($profile_avatar_sizes as $size) {
                $image = Image::read($file)->resize(
                    width: $size,
                    height: $size,
                )->encode(encoder: new PngEncoder);

                Storage::put(
                    path: "public/workspace_profile_avatars/default/$number/$size.png",
                    contents: $image
                );
            }
        }
    }
}
