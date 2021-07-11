<?php

namespace League\Flysystem\Plugin;

use InvalidArgumentException;
use League\Flysystem\FileNotFoundException;

class GetWithMetadata extends AbstractPlugin
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'getWithMetadata';
    }

    /**
     * Get metadata for an object with required metadata.
     *
<<<<<<< HEAD
     * @param string $path     path to file
     * @param array  $metadata metadata keys
=======
     * @param string   $path     path to file
     * @param string[] $metadata metadata keys
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     *
     * @throws InvalidArgumentException
     * @throws FileNotFoundException
     *
     * @return array|false metadata
     */
    public function handle($path, array $metadata)
    {
        $object = $this->filesystem->getMetadata($path);

        if ( ! $object) {
            return false;
        }

        $keys = array_diff($metadata, array_keys($object));

        foreach ($keys as $key) {
            if ( ! method_exists($this->filesystem, $method = 'get' . ucfirst($key))) {
                throw new InvalidArgumentException('Could not fetch metadata: ' . $key);
            }

            $object[$key] = $this->filesystem->{$method}($path);
        }

        return $object;
    }
}
