<?php

namespace Faker\Provider;

class Address extends Base
{
    protected static $citySuffix = ['Ville'];
    protected static $streetSuffix = ['Street'];
    protected static $cityFormats = [
        '{{firstName}}{{citySuffix}}',
    ];
    protected static $streetNameFormats = [
        '{{lastName}} {{streetSuffix}}',
    ];
    protected static $streetAddressFormats = [
        '{{buildingNumber}} {{streetName}}',
    ];
    protected static $addressFormats = [
        '{{streetAddress}} {{postcode}} {{city}}',
    ];

    protected static $buildingNumber = ['%#'];
    protected static $postcode = ['#####'];
    protected static $country = [];

    /**
     * @example 'town'
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public static function citySuffix()
    {
        return static::randomElement(static::$citySuffix);
    }

    /**
     * @example 'Avenue'
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public static function streetSuffix()
    {
        return static::randomElement(static::$streetSuffix);
    }

    /**
     * @example '791'
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public static function buildingNumber()
    {
        return static::numerify(static::randomElement(static::$buildingNumber));
    }

    /**
     * @example 'Sashabury'
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function city()
    {
        $format = static::randomElement(static::$cityFormats);

        return $this->generator->parse($format);
    }

    /**
     * @example 'Crist Parks'
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function streetName()
    {
        $format = static::randomElement(static::$streetNameFormats);

        return $this->generator->parse($format);
    }

    /**
     * @example '791 Crist Parks'
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function streetAddress()
    {
        $format = static::randomElement(static::$streetAddressFormats);

        return $this->generator->parse($format);
    }

    /**
     * @example 86039-9874
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public static function postcode()
    {
        return static::toUpper(static::bothify(static::randomElement(static::$postcode)));
    }

    /**
     * @example '791 Crist Parks, Sashabury, IL 86039-9874'
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public function address()
    {
        $format = static::randomElement(static::$addressFormats);

        return $this->generator->parse($format);
    }

    /**
     * @example 'Japan'
<<<<<<< HEAD
=======
     *
     * @return string
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public static function country()
    {
        return static::randomElement(static::$country);
    }

    /**
<<<<<<< HEAD
=======
     * Uses signed degrees format (returns a float number between -90 and 90)
     *
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * @example '77.147489'
     *
     * @param float|int $min
     * @param float|int $max
     *
<<<<<<< HEAD
     * @return float Uses signed degrees format (returns a float number between -90 and 90)
=======
     * @return float
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public static function latitude($min = -90, $max = 90)
    {
        return static::randomFloat(6, $min, $max);
    }

    /**
<<<<<<< HEAD
=======
     * Uses signed degrees format (returns a float number between -180 and 180)
     *
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     * @example '86.211205'
     *
     * @param float|int $min
     * @param float|int $max
     *
<<<<<<< HEAD
     * @return float Uses signed degrees format (returns a float number between -180 and 180)
=======
     * @return float
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public static function longitude($min = -180, $max = 180)
    {
        return static::randomFloat(6, $min, $max);
    }

    /**
     * @example array('77.147489', '86.211205')
     *
<<<<<<< HEAD
     * @return array | latitude, longitude
=======
     * @return float[]
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
     */
    public static function localCoordinates()
    {
        return [
            'latitude' => static::latitude(),
            'longitude' => static::longitude(),
        ];
    }
}
