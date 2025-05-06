<?php

namespace App\Http\Controllers;

use App\Filters\StatusFilter;
use App\Http\Resources\OrderResource;
use App\Jobs\CreateOrderJob;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::filter([StatusFilter::class])->with('customer')->paginate(10);
        return $this->apiResource(['orders'=>OrderResource::paginate($orders)]);
    }

    public function store(StoreOrderRequest $request)
    {
        CreateOrderJob::dispatch($request->validated());

        return $this->apiResource(null, 'Order is being processed');
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return $this->apiResource(['order'=>new OrderResource($order->fresh('customer'))], 'Order updated successfully');
    }

    public function analytics()
    {
        $totalRevenue = DB::table('orders')
            ->select(DB::raw('SUM(price * quantity) as total'))
            ->value('total');

        $statusCounts = DB::table('orders')
            ->select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(price * quantity) as total'))
            ->groupBy('status')
            ->get();

        return $this->apiResource([
            'total_revenue' => (float) $totalRevenue,
            'status_counts' => $statusCounts,
        ], 'Stats retrieved successfully');
    }
}
