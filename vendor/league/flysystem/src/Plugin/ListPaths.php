<?php

namespace League\Flysystem\Plugin;

class ListPaths extends AbstractPlugin
{
    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'listPaths';
    }

    /**
     * List all paths.
     *
     * @param string $directory
     * @param bool   $recursive
     *
<<<<<<< HEAD
     * @return array paths
=======
     * @return string[] paths
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function handle($directory = '', $recursive = false)
    {
        $result = [];
        $contents = $this->filesystem->listContents($directory, $recursive);

        foreach ($contents as $object) {
            $result[] = $object['path'];
        }

        return $result;
    }
}
