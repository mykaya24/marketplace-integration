<?php

namespace App\DTO;

class OrderDTO
{
    public function __construct(
        public readonly string $orderId,
        public readonly string $date,
        public readonly string $category,
        public readonly OrderShippingDTO $shipping,
        public readonly OrderBillingDTO $billing,
        public readonly string $sendType,
        public readonly string $description,
        public readonly string $barkod,
        public readonly string $invoiceNumber,
        public readonly string $orderNumber,
        public readonly string $commissionAmount,
        public readonly string $commissionRate,
        public readonly array $rows
    ) {}

    public static function fromArray($data): self
    {
        return new self(
            $data["orderId"],
            $data["orderDate"],
            "Hepsiburada_Final Price",
             OrderShippingDTO::fromArray($data),
             OrderBillingDTO::fromArray($data),
             "YENI",
             "",
             "",
             "",
             $data["orderNumber"],
             $data["commission"]["amount"],
             $data["commissionRate"],
            [new OrderRowDTO($data["sku"],$data["quantity"],$data["name"],$data["totalPrice"]["amount"],$data["vatRate"])]
        );

    }
    public static function fromArrayPackaged($data): self
    {
        return new self(
            $data["id"],
            $data["orderDate"],
            "Hepsiburada_Final Price",
             OrderShippingDTO::fromArrayPackaged($data),
             OrderBillingDTO::fromArrayPackaged($data),
             "YENI",
             "",
             "",
             "",
             self::findOrderNumber($data["items"]),
             self::resolveCommission($data["items"]),
             0,
            self::findRowProduct($data["items"])
        );

    }

    private static function resolveCommission(array $data): ?string
    {
        $commission = 0;
        foreach($data as $d){
            $commission += $d["commission"]["amount"];
        }
        return (string)$commission;
    }

    private static function findOrderNumber(array $data): ?string
    {
        $orderNumber = "";
        foreach($data as $d){
            $orderNumber = $d["orderNumber"];
        }
        return $orderNumber;
    }

    private static function findRowProduct(array $data): array
    {
        $return = [];
        foreach($data as $d){
            $return[]  = new OrderRowDTO($d["hbSku"],$d["quantity"],$d["productName"],$d["totalPrice"]["amount"],$d["vatRate"]);
        }
        return $return;
    }

    public function toArray(): array
    {
        $shipping = $this->shipping->toArray();
        $arrShipping = array();
        foreach($shipping as $key=>$s)
            $arrShipping["shipping_".$key]=$s;
        $billing = $this->billing->toArray();
        $arrBilling = array();
        foreach($billing as $key=>$b)
            $arrBilling["billing_".$key]=$b;
        $rows = array();
        foreach($this->rows as $r)
            $rows[] = $r->toArray();
        $return = [
                'order_id'=> $this->orderId,
                'date'=> $this->date,
                'category'=> $this->category,
                'send_type'=> $this->sendType,
                'description'=> $this->description,
                'barkod'=> $this->barkod,
                'invoice_number'=> $this->invoiceNumber,
                'order_number'=> $this->orderNumber,
                'commission_amount'=> $this->commissionAmount,
                'commission_rate'=> $this->commissionRate,
                'rows'=>$rows
        ];
        
        $return = array_merge($return,$arrBilling);
        $return = array_merge($return,$arrShipping);
        return $return;
    }
}