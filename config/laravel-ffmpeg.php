<?php

return [
    'ffmpeg' => [
        // Path to FFmpeg binary
        'binaries' => env('FFMPEG_BINARIES', 'C:/ffmpeg/bin/ffmpeg.exe'),

        // Number of threads for FFmpeg (set to false to disable the 'threads' filter)
        'threads' => 12,
    ],

    'ffprobe' => [
        // Path to FFprobe binary
        'binaries' => env('FFPROBE_BINARIES', 'C:/ffmpeg/bin/ffprobe.exe'),
    ],

    // Timeout for FFmpeg processes (in seconds)
    'timeout' => 3600,

    // Log channel for FFmpeg-related logs (set to false to disable logging)
    'log_channel' => env('LOG_CHANNEL', 'stack'),

    // Root directory for temporary files
    'temporary_files_root' => env('FFMPEG_TEMPORARY_FILES_ROOT', sys_get_temp_dir()),

    // Root directory for temporary encrypted HLS files
    'temporary_files_encrypted_hls' => env('FFMPEG_TEMPORARY_ENCRYPTED_HLS', env('FFMPEG_TEMPORARY_FILES_ROOT', sys_get_temp_dir())),
];
