<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateClientRequestStream extends Command
{
    protected $signature = 'update:client-request-stream';
    protected $description = 'Update the closeError method in ClientRequestStream.php to handle both Exception and Error types';

    public function handle()
    {
        $filePath = base_path('vendor/react/http/src/Io/ClientRequestStream.php');

        if (!file_exists($filePath)) {
            $this->error("File not found: $filePath");
            return;
        }

        $fileContents = file_get_contents($filePath);

        // Define the old method pattern and the new method code
        $oldMethodPattern = '/public function closeError\s*\(\s*\\\\Exception\s*\$error\s*\)\s*\{[^}]*\}/m';
        $newMethod = <<<'EOD'
/** @internal */
public function closeError($error)
{
    if ($error instanceof \Error) {
        $error = new \Exception($error->getMessage(), $error->getCode(), $error);
    }

    if (self::STATE_END <= $this->state) {
        return;
    }
    $this->emit('error', array($error));
    $this->close();
}
EOD;

        // Check if the old method exists
        if (preg_match($oldMethodPattern, $fileContents)) {
            // Replace the old method with the new method
            $updatedContents = preg_replace($oldMethodPattern, $newMethod, $fileContents);
        } else {
            $this->error("Old method not found in the file: $filePath");
            return;
        }

        // Write the updated contents back to the file
        file_put_contents($filePath, $updatedContents);

        $this->info("File updated successfully: $filePath");
    }
}
