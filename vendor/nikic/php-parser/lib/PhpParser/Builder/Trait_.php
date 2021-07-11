<?php declare(strict_types=1);

namespace PhpParser\Builder;

use PhpParser;
use PhpParser\BuilderHelpers;
<<<<<<< HEAD
=======
use PhpParser\Node;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
use PhpParser\Node\Stmt;

class Trait_ extends Declaration
{
    protected $name;
    protected $uses = [];
    protected $properties = [];
    protected $methods = [];

<<<<<<< HEAD
=======
    /** @var Node\AttributeGroup[] */
    protected $attributeGroups = [];

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    /**
     * Creates an interface builder.
     *
     * @param string $name Name of the interface
     */
    public function __construct(string $name) {
        $this->name = $name;
    }

    /**
     * Adds a statement.
     *
     * @param Stmt|PhpParser\Builder $stmt The statement to add
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addStmt($stmt) {
        $stmt = BuilderHelpers::normalizeNode($stmt);

        if ($stmt instanceof Stmt\Property) {
            $this->properties[] = $stmt;
        } elseif ($stmt instanceof Stmt\ClassMethod) {
            $this->methods[] = $stmt;
        } elseif ($stmt instanceof Stmt\TraitUse) {
            $this->uses[] = $stmt;
        } else {
            throw new \LogicException(sprintf('Unexpected node of type "%s"', $stmt->getType()));
        }

        return $this;
    }

    /**
<<<<<<< HEAD
=======
     * Adds an attribute group.
     *
     * @param Node\Attribute|Node\AttributeGroup $attribute
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addAttribute($attribute) {
        $this->attributeGroups[] = BuilderHelpers::normalizeAttribute($attribute);

        return $this;
    }

    /**
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * Returns the built trait node.
     *
     * @return Stmt\Trait_ The built interface node
     */
    public function getNode() : PhpParser\Node {
        return new Stmt\Trait_(
            $this->name, [
<<<<<<< HEAD
                'stmts' => array_merge($this->uses, $this->properties, $this->methods)
=======
                'stmts' => array_merge($this->uses, $this->properties, $this->methods),
                'attrGroups' => $this->attributeGroups,
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
            ], $this->attributes
        );
    }
}
