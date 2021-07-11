<?php

namespace Illuminate\Database\Eloquent\Factories;

class Sequence
{
    /**
     * The sequence of return values.
     *
     * @var array
     */
    protected $sequence;

    /**
     * The count of the sequence items.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $count;

    /**
     * The current index of the sequence.
     *
     * @var int
     */
    protected $index = 0;
=======
    public $count;

    /**
     * The current index of the sequence iteration.
     *
     * @var int
     */
    public $index = 0;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

    /**
     * Create a new sequence instance.
     *
     * @param  array  $sequence
     * @return void
     */
    public function __construct(...$sequence)
    {
        $this->sequence = $sequence;
        $this->count = count($sequence);
    }

    /**
     * Get the next value in the sequence.
     *
     * @return mixed
     */
    public function __invoke()
    {
<<<<<<< HEAD
        if ($this->index >= $this->count) {
            $this->index = 0;
        }

        return tap(value($this->sequence[$this->index]), function () {
=======
        return tap(value($this->sequence[$this->index % $this->count], $this), function () {
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            $this->index = $this->index + 1;
        });
    }
}
