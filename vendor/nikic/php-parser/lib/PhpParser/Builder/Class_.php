<?php declare(strict_types=1);

namespace PhpParser\Builder;

use PhpParser;
use PhpParser\BuilderHelpers;
<<<<<<< HEAD
=======
use PhpParser\Node;
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;

class Class_ extends Declaration
{
    protected $name;

    protected $extends = null;
    protected $implements = [];
    protected $flags = 0;

    protected $uses = [];
    protected $constants = [];
    protected $properties = [];
    protected $methods = [];

<<<<<<< HEAD
=======
    /** @var Node\AttributeGroup[] */
    protected $attributeGroups = [];

>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
    /**
     * Creates a class builder.
     *
     * @param string $name Name of the class
     */
    public function __construct(string $name) {
        $this->name = $name;
    }

    /**
     * Extends a class.
     *
     * @param Name|string $class Name of class to extend
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function extend($class) {
        $this->extends = BuilderHelpers::normalizeName($class);

        return $this;
    }

    /**
     * Implements one or more interfaces.
     *
     * @param Name|string ...$interfaces Names of interfaces to implement
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function implement(...$interfaces) {
        foreach ($interfaces as $interface) {
            $this->implements[] = BuilderHelpers::normalizeName($interface);
        }

        return $this;
    }

    /**
     * Makes the class abstract.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeAbstract() {
        $this->flags = BuilderHelpers::addModifier($this->flags, Stmt\Class_::MODIFIER_ABSTRACT);

        return $this;
    }

    /**
     * Makes the class final.
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function makeFinal() {
        $this->flags = BuilderHelpers::addModifier($this->flags, Stmt\Class_::MODIFIER_FINAL);

        return $this;
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

        $targets = [
            Stmt\TraitUse::class    => &$this->uses,
            Stmt\ClassConst::class  => &$this->constants,
            Stmt\Property::class    => &$this->properties,
            Stmt\ClassMethod::class => &$this->methods,
        ];

        $class = \get_class($stmt);
        if (!isset($targets[$class])) {
            throw new \LogicException(sprintf('Unexpected node of type "%s"', $stmt->getType()));
        }

        $targets[$class][] = $stmt;

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
     * Returns the built class node.
     *
     * @return Stmt\Class_ The built class node
     */
    public function getNode() : PhpParser\Node {
        return new Stmt\Class_($this->name, [
            'flags' => $this->flags,
            'extends' => $this->extends,
            'implements' => $this->implements,
            'stmts' => array_merge($this->uses, $this->constants, $this->properties, $this->methods),
<<<<<<< HEAD
=======
            'attrGroups' => $this->attributeGroups,
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        ], $this->attributes);
    }
}
