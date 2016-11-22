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
     * @var null|string
     */
    public $id;

    /**
     * Article name.
     *
     * @var null|string
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
     * @var null|string
     */
    public $url;

    /**
     * Article image url.
     *
     * @var null|string
     */
    public $image_url;

    /**
     * Article quantity.
     *
     * @var null|int
     */
    public $quantity;

    /**
     * Article price (tax is not included).
     *
     * @var null|Decimal
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
}
