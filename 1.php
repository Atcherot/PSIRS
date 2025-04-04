<?php
$command = 'ffmpeg -rtsp_transport tcp -i rtsp://192.168.1.12/live/ch00_1 -c:v libx264 -f mp4 /path/to/output2.mp4 2>&1';
exec($command, $output, $return_var);

// Log the output and error for further troubleshooting
file_put_contents('ffmpeg_log.txt', implode("\n", $output), FILE_APPEND);

if ($return_var === 0) {
    echo "Video processed successfully!";
} else {
    echo "Error processing video:\n";
    echo implode("\n", $output); // Display the error output
}

?>
