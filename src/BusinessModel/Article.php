<?php

namespace Aplazame\BusinessModel;

/**
 * Article.
 */
class Article extends AbstractModel
{
    /**
     * The article ID.
     *
     * @var string
     */
    public $id;

    /**
     * Article name.
     *
     * @var string
     */
    public $name;

    /**
     * Article description.
     *
     * @var null|string
     */
    public $description;

    /**
     * Article url.
     *
     * @var string
     */
    public $url;

    /**
     * Article image url.
     *
     * @var string
     */
    public $image_url;

    /**
     * Article quantity.
     *
     * @var int
     */
    public $quantity;

    /**
     * Article price (tax is not included).
     *
     * @var Decimal
     */
    public $price;

    /**
     * Article tax_rate.
     *
     * @var null|Decimal
     */
    public $tax_rate;

    /**
     * The discount amount of the article.
     *
     * @var null|Decimal
     */
    public $discount;

    /**
     * The rate discount of the article.
     *
     * @var null|Decimal
     */
    public $discount_rate;

    /**
     * @param string $id
     * @param string $name
     * @param string $url
     * @param string $image_url
     * @param int $quantity
     * @param Decimal $price
     */
    public function __construct($id, $name, $url, $image_url, $quantity, Decimal $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->image_url = $image_url;
        $this->quantity = $quantity;
        $this->price = $price;
    }
}
