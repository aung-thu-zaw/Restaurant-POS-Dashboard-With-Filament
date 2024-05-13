<?php

namespace App\Filament\Cashier\Resources\OrderResource\Pages;

use App\Filament\Cashier\Resources\OrderResource;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $productQty = 0;
        $totalAmount = 0;

        foreach ($data['order_items'] as $item) {
            $productQty = $productQty + $item['qty'];
            $totalAmount = $totalAmount + $item['total_price'];
        }

        $record = static::getModel()::create([
            'cashier_id' => auth()->id(),
            'order_no' => $data['order_no'],
            'invoice_no' => 'RESTAURANT #' . $data['order_no'],
            'product_qty' => $productQty,
            'payment_method' => $data['payment_method'],
            'payment_status' => $data['payment_status'],
            'order_type' => $data['order_type'],
            'purchased_at' => $data['payment_status'] === 'completed' ? now() : null,
            'total_amount' => $totalAmount,
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'note' => $data['note'],
            'status' => 'pending',
        ]);

        foreach ($data['order_items'] as $item) {
            $product = Product::find($item['product_id']);

            OrderItem::create([
                'order_id' => $record->id,
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['total_price'],
            ]);

            if ($product) {
                $product->qty -= $item['qty'];

                $superAdmin = User::where("role", "admin")->first();

                if ($product->qty <= $product->stock_alert) {
                    Notification::make()
                        ->title('Low Stock Alert')
                        ->body("The stock for $product->name is low. Current quantity: $product->qty")
                        ->sendToDatabase($superAdmin);
                }

                if ($product->qty <= 0) {
                    $product->is_available = false;
                }

                $product->save();
            }
        }

        return $record;
    }
}
