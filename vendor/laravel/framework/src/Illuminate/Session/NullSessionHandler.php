<?php

namespace Illuminate\Session;

<<<<<<< HEAD
=======
use ReturnTypeWillChange;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
use SessionHandlerInterface;

class NullSessionHandler implements SessionHandlerInterface
{
    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
=======
    #[ReturnTypeWillChange]
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
=======
    #[ReturnTypeWillChange]
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function close()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
=======
    #[ReturnTypeWillChange]
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function read($sessionId)
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
=======
    #[ReturnTypeWillChange]
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function write($sessionId, $data)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
=======
    #[ReturnTypeWillChange]
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function destroy($sessionId)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
=======
    #[ReturnTypeWillChange]
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    public function gc($lifetime)
    {
        return true;
    }
}
