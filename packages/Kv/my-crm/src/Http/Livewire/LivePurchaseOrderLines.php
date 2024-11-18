<?php

namespace Kv\MyCrm\Http\Livewire;

use Livewire\Component;
use Kv\MyCrm\Models\Organisation;
use Kv\MyCrm\Models\Product;
use Kv\MyCrm\Models\TaxRate;
use Kv\MyCrm\Services\SettingService;
use Kv\MyCrm\Traits\NotifyToast;

class LivePurchaseOrderLines extends Component
{
    use NotifyToast;

    private $settingService;

    public $purchaseOrder;

    public $purchaseOrderLines;

    public $order_product_id;
    public $purchase_order_line_id;

    public $product_id;

    public $name;

    public $order_quantities;

    public $price;

    public $quantity;

    public $tax_amount;

    public $tax_rate;

    public $amount;

    public $comments;

    public $inputs = [];

    public $i = 0;

    public $sub_total = 0;

    public $tax = 0;

    public $total = 0;

    public $fromOrder;

    public $organisation_id;

    public $organisation_name;

    protected $listeners = ['loadPurchaseOrderLineDefault'];

    public function boot(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function mount($purchaseOrder, $purchaseOrderLines, $old = null, $fromOrder = false)
    {
        $this->purchaseOrder = $purchaseOrder;
        $this->purchaseOrderLines = $purchaseOrderLines;
        $this->old = $old;
        $this->fromOrder = $fromOrder;

        if ($this->old) {
            foreach ($this->old as $old) {
                $this->add($this->i);
                $this->order_product_id[$this->i] = $old['order_product_id'] ?? null;
                $this->purchase_order_line_id[$this->i] = $old['purchase_order_line_id'] ?? null;
                $this->product_id[$this->i] = $old['product_id'] ?? null;
                $this->name[$this->i] = Product::find($old['product_id'])->name ?? null;
                $this->organisation_id[$this->i] = $old['organisation_id'] ?? null;
                $this->organisation_name[$this->i] = (isset($old['organisation_id'])) ? Organisation::find($old['organisation_id'])->name ?? null : null;
                $this->quantity[$this->i] = $old['quantity'] ?? null;

                if ($this->fromOrder) {
                    foreach ($this->purchaseOrderLines as $purchaseOrderLine) {
                        for ($i = 0; $i <= $this->getRemainOrderQuantity($purchaseOrderLine); $i++) {
                            $this->order_quantities[$this->i][$i] = $i;
                        }
                    }
                }

                $this->price[$this->i] = $old['price'] ?? null;
                $this->tax_amount[$this->i] = $old['tax_amount'] ?? null;
                $this->amount[$this->i] = $old['amount'] ?? null;
                $this->comments[$this->i] = $old['comments'] ?? null;
            }
        } elseif ($this->purchaseOrderLines && $this->purchaseOrderLines->count() > 0) {
            foreach ($this->purchaseOrderLines as $purchaseOrderLine) {
                $this->add($this->i);

                if ($this->fromOrder) {
                    $this->order_product_id[$this->i] = $purchaseOrderLine->id;
                } else {
                    $this->purchase_order_line_id[$this->i] = $purchaseOrderLine->id;
                }

                $this->product_id[$this->i] = $purchaseOrderLine->product->id ?? null;
                $this->name[$this->i] = $purchaseOrderLine->product->name ?? null;
                $this->quantity[$this->i] = $purchaseOrderLine->quantity;

                if ($this->fromOrder) {
                    for ($i = 0; $i <= $this->getRemainOrderQuantity($purchaseOrderLine); $i++) {
                        $this->order_quantities[$this->i][$i] = $i;
                        $this->quantity[$this->i] = $i;
                    }
                }

                $this->price[$this->i] = $purchaseOrderLine->price / 100;
                $this->tax_amount[$this->i] = $purchaseOrderLine->tax_amount / 100;
                $this->amount[$this->i] = $purchaseOrderLine->amount / 100;
                $this->comments[$this->i] = $purchaseOrderLine->comments;
            }
        } elseif (! $this->fromOrder) {
            $this->add($this->i);
        }

        $this->calculateAmounts();
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        $this->price[$i] = null;
        $this->quantity[$i] = null;
        $this->tax_rate[$i] = null;
        array_push($this->inputs, $i);

        $this->dispatchBrowserEvent('addedItem', ['id' => $this->i]);
    }

    public function loadPurchaseOrderLineDefault($id)
    {
        if ($product = \Kv\MyCrm\Models\Product::find($this->product_id[$id])) {
            $this->price[$id] = ($product->getDefaultPrice()->unit_price / 100);
            $this->quantity[$id] = 1;
        } else {
            $this->price[$id] = null;
            $this->quantity[$id] = null;
            $this->amount[$id] = null;
        }

        $this->calculateAmounts();
    }

    public function calculateAmounts()
    {
        $this->sub_total = 0;
        $this->tax = 0;
        $this->total = 0;

        for ($i = 1; $i <= $this->i; $i++) {
            if (isset($this->product_id[$i])) {
                $product = \Kv\MyCrm\Models\Product::find($this->product_id[$i]);

                if($product && $product->taxRate) {
                    $taxRate = $product->taxRate->rate;
                } elseif($product && $product->tax_rate) {
                    $taxRate = $product->tax_rate;
                } elseif($taxRate = TaxRate::where('default', 1)->first()) {
                    $taxRate = $taxRate->rate;
                } elseif($taxRate = $this->settingService->get('tax_rate')) {
                    $taxRate = $taxRate->value;
                } else {
                    $taxRate = 0;
                }

                $this->tax_rate[$i] = $taxRate;

                if (is_numeric($this->price[$i]) && is_numeric($this->quantity[$i])) {
                    $this->amount[$i] = $this->price[$i] * $this->quantity[$i];
                    $this->price[$i] = $this->currencyFormat($this->price[$i]);
                    $this->tax_amount[$i] = $this->currencyFormat($this->amount[$i] * ($taxRate / 100));
                } else {
                    $this->amount[$i] = 0;
                }

                $this->sub_total += round($this->amount[$i], 2);
                $this->tax += round($this->amount[$i] * ($taxRate / 100), 2);
                $this->amount[$i] = $this->currencyFormat($this->amount[$i]);
            }
        }

        $this->total = $this->sub_total + $this->tax;

        $this->sub_total = $this->currencyFormat($this->sub_total);
        $this->tax = $this->currencyFormat($this->tax);
        $this->total = $this->currencyFormat($this->total);
    }

    public function remove($id)
    {
        unset($this->inputs[$id - 1], $this->product_id[$id], $this->name[$id]);

        $this->dispatchBrowserEvent('removedItem', ['id' => $id]);

        $this->calculateAmounts();
    }

    protected function currencyFormat($number)
    {
        return number_format($number, 2, '.', '');
    }

    public function getRemainOrderQuantity($orderProduct)
    {
        $quantity = $orderProduct->quantity;
        /*foreach ($this->fromOrder->purchaseOrders as $purchaseOrder) {
            if ($purchaseOrderProduct = $purchaseOrder->purchaseOrderLines()->where('order_product_id', $orderProduct->id)->first()) {
                $quantity -= $purchaseOrderProduct->quantity;
            }
        }*/

        return $quantity;
    }

    public function render()
    {
        return view('my-crm::livewire.purchase-order-lines');
    }
}
