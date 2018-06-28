<?php

if (!function_exists('flatten_array')) {
    /**
     * Flatten array with users notation like "keyOne.0.keyTwo.0.keyThree...".
     * @param array $data
     * @param string $notation
     * @return array
     */
    function flatten_array(array $data, string $notation) : array
    {
        $result = [];

        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($data));

        foreach ($iterator as $leafValue) {
            $keys = [];

            foreach (range(0, $iterator->getDepth()) as $depth) {
                $keys[] = $iterator->getSubIterator($depth)->key();
            }

            $result[ join($notation, $keys) ] = $leafValue;
        }

        return $result;
    }
}