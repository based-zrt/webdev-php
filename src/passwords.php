<?php
/**
 * @param string $file the path to the password
 * @return array of byte arrays containing raw lines
 */
function get_line_bytes(string $file): array {
    $handle = fopen($file, 'rb');
    $size = filesize($file);
    $contents = fread($handle, $size);
    fclose($handle);
    $unpack = unpack(sprintf('C%d', $size), $contents);
    $unpack = array_values($unpack);

    $result = array();
    $current = array();

    foreach ($unpack as $byte) {
        if ($byte == 0x0A) {
            $result[] = $current;
            $current = array();
        } else {
            $current[] = $byte;
        }
    }
    return $result;
}

/**
 * @param array $input The encrypted byte array
 * @return string The decrypted string
 */
function decrypt(array $input): string {
    $key = [5, -14, 31, -9, 3];
    $index = 0;
    $result = '';
    foreach ($input as $byte) {
        $result = $result . chr($byte - $key[$index]);
        $index = ($index + 1) % count($key);
    }
    return $result;
}

function get_users(): array {
    $raw = get_line_bytes('password.txt');
    $result = array();
    foreach ($raw as $bytes) {
        $line = decrypt($bytes);
        $data = explode('*', $line);
        $result[$data[0]] = $data[1];
    }
    return $result;
}
