<?php

namespace CodeCommerce;

class Cart
{
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add($id, $name, $price)
    {
        $this->items += [
            $id => [
                'name' => $name,
                'qtd' => isset($this->items[$id]) ? $this->items[$id]['qtd']++ : 1,
                'price' => $price,
            ]
        ];

        return $this;
    }

    public function update($items)
    {
        foreach ($items as $k => $value) {
            $this->items[$k]['qtd'] = $value;
        }

        return $this;
    }

    public function remove($id)
    {
        unset($this->items[$id]);

        return $this;
    }

    public function all()
    {
        return $this->items;
    }

    public function getTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item['qtd'] * $item['price'];
        }

        return $total;
    }
}
