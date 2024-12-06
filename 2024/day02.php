<?php

// Advent of Code 2024 Day 2
// Martin Diekhoff

$start_time = microtime(true);
$start_memory = memory_get_usage(true);

$input = file('input02.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$safeReports = 0;
$part2SafeReports = 0;

foreach ($input as $line) {
    $levels = array_map('intval', explode(' ', $line));

    if (isValid($levels)) {
        $safeReports++;
    }

    foreach ($levels as $j => $level) {
        $newLevels = array_merge(array_slice($levels, 0, $j), array_slice($levels, $j + 1));

        if (isValid($newLevels)) {
            $part2SafeReports++;
            break;
        }
    }
}

echo "Number of safe reports (Part 1): $safeReports" . PHP_EOL;
echo "Number of safe reports (Part 2): $part2SafeReports" . PHP_EOL;

$end_time = microtime(true);
$end_memory = memory_get_usage(true);

echo "Time elapsed: " . ($end_time - $start_time) . " seconds" . PHP_EOL;
echo "Memory usage: " . ($end_memory - $start_memory) . " bytes" . PHP_EOL;

function isValid($levels): bool
{
    $isIncreasing = true;
    $isDecreasing = true;

    for ($i = 1; $i < count($levels); $i++) {
        $diff = abs($levels[$i] - $levels[$i - 1]);

        if ($diff < 1 || $diff > 3) {
            return false;
        }

        if ($levels[$i] > $levels[$i - 1]) {
            $isDecreasing = false;
        } elseif ($levels[$i] < $levels[$i - 1]) {
            $isIncreasing = false;
        }
    }

    return $isIncreasing || $isDecreasing;
}
