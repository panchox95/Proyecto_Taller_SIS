<?php

namespace App;


class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice =0;

    public function __construct($oldCart){
        if ($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id_producto){
        $storedItem = ['qty'=>0, 'price' => $item->precio, 'item'=> $item];
        if ($this->items){
            if (array_key_exists($id_producto, $this->items)){
                $storedItem= $this->items[$id_producto];
            }
        }
        $storedItem['qty']++;
        $storedItem['price']=  $item->precio * $storedItem['qty'];
        $this->items[$id_producto] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->precio;
    }

    public function reduceByOne($id_producto){
        $this->items[$id_producto]['qty']--;
        $this->items[$id_producto]['price']-=$this ->items[$id_producto]['item']['price'];
        $this->totalQty--;
        $this->totalPrice-=$this->items[$id_producto]['item']['price'];

        if ($this->items[$id_producto]['qty']<= 0){
            unset($this->items[$id_producto]);
        }
    }

    public function removeItem($id_producto){
        $this->totalQty-= $this->items[$id_producto]['qty'];
        $this->totalPrice-=$this->items[$id_producto]['price'];
        unset($this->items[$id_producto]);
    }
}
