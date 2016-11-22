<?php

namespace Aplazame\BusinessModel;

/**
 * @covers Aplazame\BusinessModel\Article
 */
class ArticleTest extends AbstractModelTestCase
{
    public function testAllFields()
    {
        $article = new Article();
        $article->id = 'id1234';
        $article->name = 'name lorem ipsum';
        $article->url = 'http://url.foo';
        $article->image_url = 'http://url_image.foo';
        $article->quantity = 1;
        $article->price = Decimal::fromFloat(2);
        $article->description = 'description lorem ipsum';
        $article->tax_rate = Decimal::fromFloat(3);
        $article->discount = Decimal::fromFloat(4);
        $article->discount_rate = Decimal::fromFloat(5);

        $expected = <<<JSON
{
  "id": "id1234",
  "name": "name lorem ipsum",
  "url": "http://url.foo",
  "image_url": "http://url_image.foo",
  "quantity": 1,
  "price": 200,
  "description": "description lorem ipsum",
  "tax_rate": 300,
  "discount": 400,
  "discount_rate": 500
}
JSON;

        self::assertEquals(json_decode($expected, true), $article->jsonSerialize());
    }
}
